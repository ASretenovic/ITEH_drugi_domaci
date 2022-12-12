<?php

namespace App\Exceptions;

use Exception;

class ReviewDoesNotBelongToUser extends Exception
{
    public function render()
    {
        return ['error'=>'Review is not registered by user.'];
    }
}
