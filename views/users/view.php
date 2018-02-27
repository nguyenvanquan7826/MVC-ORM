<?php
if ($data['content'] instanceof User) {
    $user = $data['content'];
    echo 'Id: ' . $user->id . BR;
    echo 'Name: ' . $user->name . BR;
    echo 'Email: ' . $user->email . BR;
} else {
    echo $data['content'];
}