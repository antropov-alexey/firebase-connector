<?php

namespace App\Model\Request\Database;

use App\Model\Database\DatabaseModelInterface;
use App\Model\RequestInterface;
use GuzzleHttp\RequestOptions;

class DatabaseWriteRequest implements RequestInterface
{
    private DatabaseModelInterface $databaseModel;
    private string                 $authKey;

    public function __construct(DatabaseModelInterface $databaseModel, string $authKey)
    {
        $this->databaseModel = $databaseModel;
        $this->authKey       = $authKey;
    }

    public function getOptions(): array
    {
        return [
            RequestOptions::JSON  => $this->databaseModel->toArray(),
            RequestOptions::QUERY => [
                'key' => $this->authKey,
            ],
        ];
    }
}
