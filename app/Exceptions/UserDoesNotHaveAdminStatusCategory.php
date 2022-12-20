<?php

namespace App\Exceptions;

use Exception;

class UserDoesNotHaveAdminStatusCategory extends Exception
{
    public function render()
    {
        return ['error'=>'Only admin can manage categories.'];
    }
}
