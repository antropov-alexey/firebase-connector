<?php

namespace App\Model;

use Psr\Http\Message\ResponseInterface;
use stdClass;

abstract class AbstractResponse
{
    private ResponseInterface $guzzleResponse;
    private ?stdClass          $decodedResponse = null;

    /**
     * @param ResponseInterface $guzzleResponse
     */
    public function __construct(ResponseInterface $guzzleResponse)
    {
        $this->guzzleResponse = $guzzleResponse;
    }

    /**
     * @return stdClass|null
     */
    protected function getStdResponse(): ?stdClass
    {
        if ( ! $this->decodedResponse) {
            $this->decodedResponse = json_decode($this->guzzleResponse->getBody()->getContents());
        }

        return $this->decodedResponse;
    }
}
