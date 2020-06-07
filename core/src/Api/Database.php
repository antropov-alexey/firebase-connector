<?php

namespace App\Api;

use App\Enum\RequestMethods;
use App\Exception\FirebaseApiException;
use App\Model\Database\DatabaseModelInterface;
use App\Model\Request\Database\DatabaseWriteRequest;
use App\Model\Response\Database\DatabaseGetResponse;
use App\Model\Response\Database\DatabaseWriteResponse;

class Database extends Api
{
    /**
     * @param string $resourceName
     * @param string $resourceId
     *
     * @return DatabaseGetResponse
     * @throws FirebaseApiException
     */
    public function get(string $resourceName, string $resourceId): DatabaseGetResponse
    {
        $url = $this->getDatabaseUrl() . "/{$resourceName}/{$resourceId}.json";

        $response = $this->request(RequestMethods::GET, $url, null);

        return new DatabaseGetResponse($response);
    }

    /**
     * @param string                 $resourceName
     * @param DatabaseModelInterface $databaseModel
     *
     * @return DatabaseWriteResponse
     * @throws FirebaseApiException
     */
    public function write(string $resourceName, DatabaseModelInterface $databaseModel): DatabaseWriteResponse
    {
        $url = $this->getDatabaseUrl() . "/{$resourceName}.json";

        $request = new DatabaseWriteRequest($databaseModel);

        $response = $this->request(RequestMethods::POST, $url, $request);

        return new DatabaseWriteResponse($response);
    }

    /**
     * @param string                 $resourceName
     * @param string                 $resourceId
     * @param DatabaseModelInterface $databaseModel
     *
     * @return DatabaseGetResponse
     * @throws FirebaseApiException
     */
    public function edit(string $resourceName, string $resourceId, DatabaseModelInterface $databaseModel): DatabaseGetResponse
    {
        $url = $this->getDatabaseUrl() . "/{$resourceName}/{$resourceId}.json";

        $request = new DatabaseWriteRequest($databaseModel);

        $response = $this->request(RequestMethods::PUT, $url, $request);

        return new DatabaseGetResponse($response);
    }

    private function getDatabaseUrl()
    {
        return "https://{$this->getProjectId()}.firebaseio.com";
    }

    /**
     * @param string $resourceName
     * @param array  $params
     *
     * @return DatabaseGetResponse
     * @throws FirebaseApiException
     */
    public function getByParams(string $resourceName, array $params): DatabaseGetResponse
    {
        $joinedParams = [];

        foreach ($params as $key => $value) {
            $joinedParams[] = "{$key}={$value}";
        }

        $joinedParams = implode('&', $joinedParams);

        $url = $this->getDatabaseUrl() . "/{$resourceName}.json?{$joinedParams}";

        $response = $this->request(RequestMethods::GET, $url, null);

        return new DatabaseGetResponse($response);
    }
}
