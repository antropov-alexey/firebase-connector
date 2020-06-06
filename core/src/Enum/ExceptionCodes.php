<?php

namespace App\Enum;

class ExceptionCodes
{
    // region Auth
    public const EMAIL_EXISTS     = 'EMAIL_EXISTS';
    public const EMAIL_NOT_FOUND  = 'EMAIL_NOT_FOUND';
    public const INVALID_PASSWORD = 'INVALID_PASSWORD';
    public const USER_DISABLED    = 'USER_DISABLED';
}
