<?php

namespace App\Model;

use Psr\Http\Message\ResponseInterface;
use stdClass;

abstract class AbstractResponse
{
    private ResponseInterface $guzzleResponse;

    /**
     * @param ResponseInterface $guzzleResponse
     */
    public function __construct(ResponseInterface $guzzleResponse)
    {
        $this->guzzleResponse = $guzzleResponse;
    }

    /**
     * @return stdClass
     */
    protected function getStdResponse(): stdClass
    {
        return json_decode($this->guzzleResponse->getBody()->getContents());
    }
}