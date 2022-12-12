<?php

namespace App\Exceptions;

use Exception;

class BookDoesNotBelongToAdmin extends Exception
{
    public function render()
    {
        return ['error'=>'Book is not registered by user.'];
    }
}
