<?php

class User extends Model {

    protected  $tableName = 'mvcorm_user'; // usually tables are named in plural when the object should be named singular

    public $id;
    public $email;
    public $password;

}