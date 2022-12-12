<?php

namespace App\Exceptions;

use Exception;

class UserDoesNotHaveAdminStatus extends Exception
{
    public function render()
    {
        return ['error'=>'Only admin can add new books.'];
    }
}
