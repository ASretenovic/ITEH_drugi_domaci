<?php

namespace App\Exceptions;

use Exception;

class UserIsNotAuthorized extends Exception
{
    public function render()
    {
        return ['error'=>'You must be authorized to add a review.'];
    }
}
