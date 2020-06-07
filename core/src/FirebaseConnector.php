<?php

namespace App;

use App\Api\Auth;
use App\Api\Database;
use App\Enum\BasePaths;
use App\Factories\ErrorFactory;
use GuzzleHttp\Client;

class FirebaseConnector
{
    private Auth     $auth;
    private Database $database;

    /**
     * @param Auth     $auth
     * @param Database $database
     */
    public function __construct(Auth $auth, Database $database)
    {
        $this->auth     = $auth;
        $this->database = $database;
    }

    /**
     * @param string $authKey
     * @param string $projectId
     *
     * @return FirebaseConnector
     */
    public static function make(string $authKey, string $projectId): FirebaseConnector
    {
        $client = new Client([
            'headers'  => [
                'Content-Type: application/json',
            ],
        ]);

        $errorFactory = new ErrorFactory();

        return new self(
            new Auth($authKey, $projectId, $client, $errorFactory),
            new Database($authKey, $projectId, $client, $errorFactory)
        );
    }

    /**
     * @return Auth
     */
    public function auth(): Auth
    {
        return $this->auth;
    }

    /**
     * @return Database
     */
    public function database(): Database
    {
        return $this->database;
    }
}