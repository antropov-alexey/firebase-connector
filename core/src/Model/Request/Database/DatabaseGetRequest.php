<?php

namespace App\Model\Request\Database;

use App\Model\RequestInterface;
use GuzzleHttp\RequestOptions;

class DatabaseGetRequest implements RequestInterface
{
    private string                 $authKey;

    public function __construct(string $authKey)
    {
        $this->authKey = $authKey;
    }

    public function getOptions(): array
    {
        return [
            RequestOptions::QUERY => [
                'key' => $this->authKey,
            ],
        ];
    }
}
