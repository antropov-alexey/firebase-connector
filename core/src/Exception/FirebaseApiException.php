<?php

namespace App\Exception;

use App\Enum\ExceptionCodes;
use Exception;
use Throwable;

class FirebaseApiException extends Exception
{
    private int    $httpResponseCode;

    /**
     * @var string
     * @see ExceptionCodes
     */
    private string $errorCode;

    /**
     * @param int       $httpResponseCode
     * @param string    $errorCode
     * @param Throwable $previous
     *
     * @see ExceptionCodes
     */
    public function __construct(int $httpResponseCode, string $errorCode, Throwable $previous)
    {
        parent::__construct($errorCode, 0, $previous);
        $this->httpResponseCode = $httpResponseCode;
        $this->errorCode        = $errorCode;
    }

    /**
     * @return int
     */
    public function getHttpResponseCode(): int
    {
        return $this->httpResponseCode;
    }

    /**
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }
}
