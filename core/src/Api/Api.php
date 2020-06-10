<?php

namespace App\Api;

use App\Exception\FirebaseApiException;
use App\Factories\ErrorFactory;
use App\Model\RequestInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

abstract class Api
{
    private string       $authKey;
    private string       $projectId;
    private string       $oauthCode;
    private string       $clientKey;
    private string       $clientSecret;
    private Client       $client;
    private ErrorFactory $errorFactory;

    /**
     * @param string       $authKey
     * @param string       $projectId
     * @param string       $oauthCode
     * @param string       $clientKey
     * @param string       $clientSecret
     * @param Client       $client
     * @param ErrorFactory $errorFactory
     */
    public function __construct(
        string $authKey,
        string $projectId,
        string $oauthCode,
        string $clientKey,
        string $clientSecret,
        Client $client,
        ErrorFactory $errorFactory
    )
    {
        $this->client       = $client;
        $this->projectId    = $projectId;
        $this->authKey      = $authKey;
        $this->errorFactory = $errorFactory;
        $this->oauthCode = $oauthCode;
        $this->clientKey = $clientKey;
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return string
     */
    protected function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @return string
     */
    protected function getClientKey(): string
    {
        return $this->clientKey;
    }

    /**
     * @return string
     */
    protected function getOauthCode(): string
    {
        return $this->oauthCode;
    }

    /**
     * @return string
     */
    protected function getAuthKey(): string
    {
        return $this->authKey;
    }

    /**
     * @return string
     */
    protected function getProjectId(): string
    {
        return $this->projectId;
    }

    /**
     * @param string           $method
     * @param string           $uri
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     * @throws FirebaseApiException
     */
    protected function request(string $method, string $uri, RequestInterface $request)
    {
        try {
            $options = $request ? $request->getOptions() : [];

            return $this->client->request($method, $uri, $options);
        }
        catch (GuzzleException $e) {
            throw $this->errorFactory->makeException($e);
        }
    }
}
