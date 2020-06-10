<?php

namespace App;

use App\Api\Auth;
use App\Api\Database;
use App\Api\Storage;
use App\Enum\BasePaths;
use App\Factories\ErrorFactory;
use GuzzleHttp\Client;

class FirebaseConnector
{
    private Auth     $auth;
    private Database $database;
    private Storage  $storage;

    /**
     * @param Auth     $auth
     * @param Database $database
     * @param Storage  $storage
     */
    public function __construct(Auth $auth, Database $database, Storage $storage)
    {
        $this->auth     = $auth;
        $this->database = $database;
        $this->storage  = $storage;
    }

    /**
     * @param string $authKey
     * @param string $projectId
     * @param string $oauthCode
     * @param string $clientKey
     * @param string $clientSecret
     *
     * @return FirebaseConnector
     */
    public static function make(
        string $authKey,
        string $projectId,
        string $oauthCode,
        string $clientKey,
        string $clientSecret
    ): FirebaseConnector
    {
        $client = new Client([
            'headers' => [
                'Content-Type: application/json',
            ],
        ]);

        $errorFactory = new ErrorFactory();

        return new self(
            new Auth($authKey, $projectId, $oauthCode, $clientKey, $clientSecret, $client, $errorFactory),
            new Database($authKey, $projectId, $oauthCode, $clientKey, $clientSecret, $client, $errorFactory),
            new Storage($authKey, $projectId, $oauthCode, $clientKey, $clientSecret, $client, $errorFactory)
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

    /**
     * @return Storage
     */
    public function storage(): Storage
    {
        return $this->storage;
    }
}