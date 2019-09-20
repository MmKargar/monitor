<?php


class Login extends Controller
{

    public function __construct()
    {
        if (isset($_SESSION['user_name']) && !isset($_POST['logout'])) {
            
            // user logged in
            require_once '../app/controllers/home.php';
            $home = new Home;
            call_user_func_array([$home, 'index'], []);
            die();
            return '';
        }
    }

    public function index()
    {
        // show login page
        $this->view('login');
    }

    public function attemp()
    {
        $user = User::where('user_name', $_POST['user_name'])->where('password', $_POST['password'])->get();
        if (count($user) > 0) {
            // user found 
            if(isset($_POST['remember'])){
                setcookie('user_name', $user[0]->user_name , time() + (86400 * 7), "/"); // 86400 = 1 day + 7  = 7day
            }
            $_SESSION["user_name"] = $user[0]->user_name;
            $this->view('home/index');
        } else {
            // wrong user name and password
            $this->view('login', [
                'text' => 'UserName Or Password Is Wrong!',
                'heading' => 'Error!',
                'loaderBg' => '#ff6849',
                'icon' => 'error',
            ]);
        }
    }

    public function logout()
    {
        unset($_SESSION['user_name']);
        unset($_COOKIE['user_name']);
        setcookie('user_name', null, -1, '/'); 
        $this->view('login');
    }
}
