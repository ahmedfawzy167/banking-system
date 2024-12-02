<?php

namespace App\Exceptions;

use Exception;

class InsufficientFundsException extends Exception
{
    public function __construct()
    {
        parent::__construct('Insufficient Funds for this Transaction');
    }
}
