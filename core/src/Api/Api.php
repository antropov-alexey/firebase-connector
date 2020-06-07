<?php

namespace App\Api;

use App\Exception\FirebaseApiException;
use App\Factories\ErrorFactory;
use App\Model\RequestInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

abstract class Api
{
    private string       $authKey;
    private string       $projectId;
    private Client       $client;
    private ErrorFactory $errorFactory;

    /**
     * @param string       $authKey
     * @param string       $projectId
     * @param Client       $client
     * @param ErrorFactory $errorFactory
     */
    public function __construct(
        string $authKey,
        string $projectId,
        Client $client,
        ErrorFactory $errorFactory
    )
    {
        $this->client       = $client;
        $this->projectId    = $projectId;
        $this->authKey      = $authKey;
        $this->errorFactory = $errorFactory;
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
    protected function request(string $method, string $uri, ?RequestInterface $request)
    {
        try {
            $options = [];

            if ($request !== null) {
                if ($request->getParamsOption() === RequestOptions::QUERY) {
                    $options[$request->getParamsOption()] = array_merge($request->serialize(), ['key' => $this->getAuthKey()]);
                }
                else {
                    $options[$request->getParamsOption()] = $request->serialize();
                    $options[RequestOptions::QUERY]       = ['key' => $this->getAuthKey()];
                }
            }

            return $this->client->request($method, $uri, $options);
        }
        catch (GuzzleException $e) {
            throw $this->errorFactory->makeException($e);
        }
    }
}
