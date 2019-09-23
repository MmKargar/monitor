<?php

use Rakit\Validation\Validator;

class person extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        $this->view('persons/index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $this->view('persons/create');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // validate inputs 
            $validator = new Validator;
            // make it
            $validation = $validator->make($_POST + $_FILES, [
                'first_name' => 'required|max:190',
                'last_name'  => 'required|max:190',
                'email'      => 'required|email|max:190',
                'user_name'  => 'required|min:8|max:190',
                'password'   => 'required|min:8|max:190',
                'avatar'     => 'uploaded_file:0,2000K,png,jpeg,jpg,gif,bmp'
            ]);

            // then validate
            $validation->validate();

            if ($validation->fails()) {
                // handling errors
                $errors = $validation->errors();
                // call_user_func_array([$this ,  'create' ] ,  ['errors' => $errors] );
                $this->view('persons/create', [
                    'errors' => $errors,
                    'validate-error' => true
                ]);
                die();
            }

            // check user_name , email unique
            $this->unique();

            $file_name = null;
            // check file uploaded or not
            if (file_exists($_FILES['avatar']['tmp_name']) || is_uploaded_file($_FILES['avatar']['tmp_name'])) {
                if (isset($_FILES['avatar'])) {
                    $storage = new \Upload\Storage\FileSystem('storage/users');
                    $file = new \Upload\File('avatar', $storage);

                    // Optionally you can rename the file on upload
                    $new_filename = uniqid();
                    $file->setName($new_filename);

                    // Validate file upload
                    // MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
                    $file->addValidations(array(
                        // Ensure file is of type "image/png"
                        new \Upload\Validation\Mimetype(['image/png', 'image/jpg', 'image/jpeg']),

                        //You can also add multi mimetype validation
                        //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

                        // Ensure file is no larger than 5M (use "B", "K", M", or "G")
                        new \Upload\Validation\Size('2M')
                    ));

                    // Access data about the file that has been uploaded
                    $data = array(
                        'name'       => $file->getNameWithExtension(),
                        'extension'  => $file->getExtension(),
                        'mime'       => $file->getMimetype(),
                        'size'       => $file->getSize(),
                        'md5'        => $file->getMd5(),
                        'dimensions' => $file->getDimensions()
                    );
                    // Try to upload file
                    try {
                        // Success!
                        $file->upload();
                        $file_name = 'users/' . $data['name'];
                    } catch (\Exception $e) {
                        // Fail!
                        $errors = $file->getErrors();
                        $this->view('persons/create', [
                            'error-upload' => true,
                            'errors' => $errors
                        ]);
                        die();
                    }
                }
            }
            if (!$file_name) {
                $file_name = 'users/avatar.jpg';
            }
            User::create([
                'first_name' => $_POST['first_name'],
                'last_name'  => $_POST['last_name'],
                'user_name'  => $_POST['user_name'],
                'password'   =>   password_hash($_POST['password'], PASSWORD_ARGON2I),
                'email'      => $_POST['email'],
                'avatar'     => $file_name
            ]);
            $success = [
                'message' => 'New User Added Successfully.'
            ];
            $users = User::all();
            $this->view('persons/index', [
                'success' => $success,
                'users' => $users
            ]);
            die();
        } else {
            call_user_func_array([$this,  'create'], []);
        }
    }

    public function unique()
    {
        $email = User::where('email', $_POST['email'])->count();
        $user_name = User::where('user_name', $_POST['user_name'])->count();
        $errors = [];
        $have_error  = false;
        if ($email > 0) {
            array_push($errors, 'Email is Duplicate');
            $have_error = true;
        }
        if ($user_name > 0) {
            array_push($errors, 'UserName is Duplicate');
            $have_error = true;
        }
        if ($have_error) {
            $this->view('persons/create', [
                'errors' => $errors,
                'unique_error' => true
            ]);
            die();
        }
    }

    public function edit($id = '')
    {
        if (empty($id)) {
            $users = User::all();
            $this->view('persons/index', [
                'users' => $users
            ]);
            die();
        }

        try {
            $user = User::findOrFail($id);
            $this->view('persons/edit', [
                'user' => $user
            ]);
            die();
        } catch (\Throwable $th) {
            $errors = ['User Not Found'];
            $users = User::all();
            $this->view('persons/index', [
                'errors' => $errors,
                'users' => $users
            ]);
            die();
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // validate inputs 
                $validator = new Validator;
                // make it
                $validation = $validator->make($_POST + $_FILES, [
                    'first_name' => 'required|max:190',
                    'last_name'  => 'required|max:190',
                    'email'      => 'required|email|max:190',
                    'password'   => 'min:8|max:190',
                    'avatar'     => 'uploaded_file:0,2000K,png,jpeg,jpg,gif,bmp'
                ]);

                // then validate
                $validation->validate();
                $user = User::findOrFail($_POST['id']);

                if ($validation->fails()) {
                    // handling errors
                    $errors = $validation->errors();
                    // call_user_func_array([$this ,  'create' ] ,  ['errors' => $errors] );
                    $this->view('persons/edit', [
                        'user'           => $user,
                        'errors'         => $errors,
                        'validate-error' => true
                    ]);
                    die();
                }
                // fill password 
                $password = $user->password;
                if ($_POST['password']) {
                    $password = password_hash($_POST['password'], PASSWORD_ARGON2I);
                }
                // check unique email 
                $email = $user->email;
                if ($email != $_POST['email']) {
                    // user enter new email so check be unique
                    $check = User::where('email', $_POST['email'])->first();
                    if ($check) {
                        // email is duplicate 
                        $this->view('persons/edit', [
                            'errors' => ['Email is Duplicate'],
                            'user'   => $user
                        ]);
                        die();
                    }
                }

                // upload file
                $file_name = null;
                // check file uploaded or not
                if (file_exists($_FILES['avatar']['tmp_name']) || is_uploaded_file($_FILES['avatar']['tmp_name'])) {
                    if (isset($_FILES['avatar'])) {
                        // check if user had avatar before so delete it
                        if ($user->avatar != null && $user->avatar != 'users/avatar.jpg') {
                            unlink('storage/' . $user->avatar);
                        }

                        $storage = new \Upload\Storage\FileSystem('storage/users');
                        $file = new \Upload\File('avatar', $storage);

                        // Optionally you can rename the file on upload
                        $new_filename = uniqid();
                        $file->setName($new_filename);

                        // Validate file upload
                        // MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
                        $file->addValidations(array(
                            // Ensure file is of type "image/png"
                            new \Upload\Validation\Mimetype(['image/png', 'image/jpg', 'image/jpeg']),

                            //You can also add multi mimetype validation
                            //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

                            // Ensure file is no larger than 5M (use "B", "K", M", or "G")
                            new \Upload\Validation\Size('2M')
                        ));

                        // Access data about the file that has been uploaded
                        $data = array(
                            'name'       => $file->getNameWithExtension(),
                            'extension'  => $file->getExtension(),
                            'mime'       => $file->getMimetype(),
                            'size'       => $file->getSize(),
                            'md5'        => $file->getMd5(),
                            'dimensions' => $file->getDimensions()
                        );
                        // Try to upload file
                        try {
                            // Success!
                            $file->upload();
                            $file_name = 'users/' . $data['name'];
                        } catch (\Exception $e) {
                            // Fail!
                            $errors = $file->getErrors();
                            $this->view('persons/create', [
                                'error-upload' => true,
                                'errors' => $errors
                            ]);
                            die();
                        }
                    }
                } else {
                    // user didn't change the avatar
                    $file_name = $user->avatar;
                }
                if (!$file_name) {
                    $file_name = 'users/avatar.jpg';
                }


                $user->update([
                    'first_name' => $_POST['first_name'],
                    'last_name'  => $_POST['last_name'],
                    'email'      => $_POST['email'],
                    'avatar'     => $file_name,
                    'password'   => $password
                ]);
                $users  = User::latest()->get();
                $this->view('persons/index', [
                    'users' => $users,
                    'success' => ['User Updated Successfully.']
                ]);
                die();
            } catch (\Throwable $th) {
                $errors = ['User Not Found'];
                $users = User::all();
                $this->view('persons/index', [
                    'errors' => $errors,
                    'users' => $users
                ]);
                die();
            }
        } else {
            $users = User::all();
            call_user_func_array([$this,  'index'], [
                'users' => $users
            ]);
        }
    }

    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id  = $_POST['id'];
                $user = User::findOrFail($id);
                // check user don't delete himself
                if($id == $_SESSION['user_id']){
                    echo 'false';
                    die();
                }
                if(file_exists('storage/'.$user->avatar)){
                    if($user->avatar != 'users/avatar.jpg'){
                        unlink('storage/'.$user->avatar);
                    }
                }
                $user->delete();
                echo 'true';
                die();
            } catch (\Throwable $th) {
                echo $th;
            }
        }
    }

    public function profile(){
        $user = User::findOrFail($_SESSION['user_id']);
        $this->view('persons/profile' , [
            'user' => $user
        ] );
    }
}
