<?php

namespace app\models;
class usersRegister extends users
{public $password_confirmation='';

 public function rules()
 {
    return array_merge(
        parent::rules(),
        [
            ['password_confirmation','compare','compareAttribute'=>'password']
        ]
        );
 }
}