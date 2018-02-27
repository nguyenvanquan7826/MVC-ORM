<?php

class User extends Model {

    protected  $tableName = 'mvcorm_user'; // usually tables are named in plural when the object should be named singular

    // only public fields will mapper with columns in data table
    public $id;
    public $name;
    public $email;
    public $password;

}