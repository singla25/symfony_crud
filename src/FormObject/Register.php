<?php

namespace App\FormObject;

use App\Entity\UserDetail;

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
