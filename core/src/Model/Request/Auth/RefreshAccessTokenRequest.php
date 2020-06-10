<?php

namespace App\Model\Request\Auth;

use App\Model\RequestInterface;
use GuzzleHttp\RequestOptions;

class RefreshAccessTokenRequest implements RequestInterface
{
    private string $code;
    private string $clientId;
    private string $clientSecret;
    private string $refreshToken;

    public function __construct(string $code, string $clientId, string $clientSecret, string $refreshToken)
    {
        $this->code         = $code;
        $this->clientId     = $clientId;
        $this->clientSecret = $clientSecret;
        $this->refreshToken = $refreshToken;
    }

    public function getOptions(): array
    {
        return [
            RequestOptions::QUERY => [
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type'    => 'refresh_token',
                'refresh_token' => $this->refreshToken,
            ],
        ];
    }
}
