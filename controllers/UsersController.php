<?php

class UsersController extends Controller {

    public function index() {
        $this->data['content'] = User::getAll();
    }

    public function view() {
        if (isset($this->params[0])) {
            $id = $this->params[0];
            $this->data['content'] = User::find($id);
        }
    }
}