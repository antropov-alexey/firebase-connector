<?php

namespace App\Model\Request\Auth;

use App\Model\RequestInterface;
use GuzzleHttp\RequestOptions;

class GetAccessTokenRequest implements RequestInterface
{
    private string $code;
    private string $clientId;
    private string $clientSecret;

    public function __construct(string $code, string $clientId, string $clientSecret)
    {
        $this->code         = $code;
        $this->clientId     = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function getOptions(): array
    {
        return [
            RequestOptions::QUERY => [
                'code'          => $this->code,
                'redirect_uri'  => 'https://developers.google.com/oauthplayground',
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type'    => 'authorization_code',
            ]
        ];
    }
}
