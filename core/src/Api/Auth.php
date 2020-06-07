<?php

namespace App\Api;

use App\Enum\BasePaths;
use App\Enum\Operations;
use App\Enum\RequestMethods;
use App\Exception\FirebaseApiException;
use App\Model\Request\Auth\LoginRequest;
use App\Model\Request\Auth\RegisterRequest;
use App\Model\Response\Auth\LoginResponse;
use App\Model\Response\Auth\RegisterResponse;

class Auth extends Api
{
    /**
     * @param string $email
     * @param string $password
     *
     * @return RegisterResponse
     * @throws FirebaseApiException
     */
    public function register(string $email, string $password): RegisterResponse
    {
        $request = new RegisterRequest($email, $password, true);

        $url = $this->getAuthUrl() . Operations::REGISTER;

        $response = $this->request(RequestMethods::POST, $url, $request);

        return new RegisterResponse($response);
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return LoginResponse
     * @throws FirebaseApiException
     */
    public function login(string $email, string $password): LoginResponse
    {
        $request = new LoginRequest($email, $password, true);

        $url = $this->getAuthUrl() . Operations::LOGIN;

        $response = $this->request(RequestMethods::POST, $url, $request);

        return new LoginResponse($response);
    }

    /**
     * @return string
     */
    private function getAuthUrl(): string
    {
        return BasePaths::AUTH;
    }
}
