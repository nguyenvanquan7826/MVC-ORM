<?php

class UsersController extends Controller {

    public function index() {
        $this->data['content'] = User::getAll();
    }

    public function view() {
        if (isset($this->params[0])) {
            $id = $this->params[0];
            $user = User::find($id);
            if ($user != null) {
                $this->data['content'] = $user;
            } else {
                $this->data['content'] = 'Not found user with id = ' . $id;
            }
        } else {
            $this->data['content'] = 'Please add user id to view user';
        }
    }

    public function register() {
        $this->data['saved'] = false;
        if ($_POST) {
            if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password'])) {
                return false;
            }
            $result = User::create([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ]);
            if ($result) {
                $this->data['saved'] = 'Register success';
            }
        }
    }
}