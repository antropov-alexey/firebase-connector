<?php

namespace App;

use App\Api\Auth;
use App\Enum\BasePaths;
use App\Factories\ErrorFactory;
use GuzzleHttp\Client;

class FirebaseConnector
{
    /**
     * @var Auth
     */
    private Auth $auth;

    /**
     * FirebaseConnector constructor.
     *
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param string $authKey
     *
     * @return FirebaseConnector
     */
    public static function make(string $authKey): FirebaseConnector
    {
        $client = new Client([
            'base_uri' => BasePaths::AUTH,
            'headers'  => [
                'Content-Type: application/json',
            ],
        ]);

        return new self(new Auth($authKey, $client, new ErrorFactory()));
    }

    /**
     * @return Auth
     */
    public function auth(): Auth
    {
        return $this->auth;
    }
}