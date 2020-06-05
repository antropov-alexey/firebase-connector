<?php

namespace App\Factories;

use App\Enum\ExceptionCodes;
use App\Exception\Auth\EmailAlreadyExistsException;
use App\Exception\FirebaseApiException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class ErrorFactory
{
    /**
     * @param GuzzleException $exception
     *
     * @return FirebaseApiException
     */
    public function makeException(GuzzleException $exception): FirebaseApiException
    {
        /** @var RequestException $exception */

        $exceptionBody = json_decode($exception->getResponse()->getBody()->getContents());

        return $this->makeExceptionFromCode(
            (int) $exceptionBody->error->code,
            (string) $exceptionBody->error->message,
            $exception
        );
    }

    /**
     * @param int              $httpCode
     * @param string           $errorCode
     * @param RequestException $previous
     *
     * @return FirebaseApiException
     */
    private function makeExceptionFromCode(
        int $httpCode,
        string $errorCode,
        RequestException $previous
    ): FirebaseApiException
    {
        switch ($errorCode) {
            case ExceptionCodes::EMAIL_EXISTS:
                return new EmailAlreadyExistsException($httpCode, $errorCode, $previous);
                break;

            default:
                return new FirebaseApiException($httpCode, $errorCode, $previous);
                break;
        }
    }
}