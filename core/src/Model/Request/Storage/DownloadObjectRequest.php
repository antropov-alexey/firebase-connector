<?php

namespace App\Model\Request\Storage;

use App\Model\RequestInterface;
use GuzzleHttp\RequestOptions;

class DownloadObjectRequest implements RequestInterface
{
    private string $authKey;
    private        $resource;

    public function __construct(string $authKey, $resource)
    {
        $this->authKey  = $authKey;
        $this->resource = $resource;
    }

    public function getOptions(): array
    {
        return [
            RequestOptions::HEADERS => [
                'Authorization' => "Bearer {$this->authKey}",
            ],
            RequestOptions::QUERY   => [
                'alt' => 'media',
            ],
            RequestOptions::SINK    => $this->resource,
        ];
    }
}
