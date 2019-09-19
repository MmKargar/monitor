<?php


class home extends Controller
{
    public function index($name = '' ){
        $user = $this->model('User');
        $user->name = $name;

        $user = User::findOrFail(1);
        echo $user->user_name;
        // $this->view('home/index' ,  ['name' => $name] );
    }

    public function test(){
        echo 'test method';
    }
}