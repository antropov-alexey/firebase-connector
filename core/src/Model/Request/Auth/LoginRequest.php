<?php

namespace App\Model\Request\Auth;

use App\Model\RequestInterface;
use GuzzleHttp\RequestOptions;

class LoginRequest implements RequestInterface
{
    private string $email;
    private string $password;
    private bool   $returnSecureToken;
    private string $authKey;

    public function __construct(string $email, string $password, bool $returnSecureToken, string $authKey)
    {
        $this->email             = $email;
        $this->password          = $password;
        $this->returnSecureToken = $returnSecureToken;
        $this->authKey           = $authKey;
    }

    public function getOptions(): array
    {
        return [
            RequestOptions::JSON  => [
                'email'             => $this->email,
                'password'          => $this->password,
                'returnSecureToken' => $this->returnSecureToken,
            ],
            RequestOptions::QUERY => [
                'key' => $this->authKey,
            ],
        ];
    }
}