<?php

namespace App\Http\Controllers\UserAdministration;

use App\Http\Controllers\MainController;

class UserAdministrationController extends MainController
{
    public function __construct()
    {
        parent::__construct();

        $this->view = "user-administration.";
    }
}
