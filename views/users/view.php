<?php
$user = $data['content'];
if($user instanceof User){
    echo 'ID: '.$user->id . BR;
    echo 'Email: '.$user->email . BR;
}