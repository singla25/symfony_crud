<?php

namespace App\FormObject;

class Register
{
    public $user;
    public $userDetail;

    public function __construct($user, $userDetail)
    {
        $this->user = $user;
        $this->userDetail = $userDetail;
    }
}
