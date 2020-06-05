<?php

namespace App\Model\Request\Auth;

use App\Model\RequestInterface;
use GuzzleHttp\RequestOptions;

class RegisterRequest implements RequestInterface
{
    private string $email;
    private string $password;
    private bool   $returnSecureToken;

    public function __construct(string $email, string $password, bool $returnSecureToken)
    {
        $this->email             = $email;
        $this->password          = $password;
        $this->returnSecureToken = $returnSecureToken;
    }

    /**
     * @inheritDoc
     */
    public function serialize(): array
    {
        return get_object_vars($this);
    }

    /**
     * @inheritDoc
     */
    public function getParamsOption(): string
    {
        return RequestOptions::JSON;
    }
}