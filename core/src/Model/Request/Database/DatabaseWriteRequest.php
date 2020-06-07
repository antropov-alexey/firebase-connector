<?php

namespace App\Model\Request\Database;

use App\Model\Database\DatabaseModelInterface;
use App\Model\RequestInterface;
use GuzzleHttp\RequestOptions;

class DatabaseWriteRequest implements RequestInterface
{
    private DatabaseModelInterface $databaseModel;

    public function __construct(DatabaseModelInterface $databaseModel)
    {
        $this->databaseModel = $databaseModel;
    }

    public function serialize(): array
    {
        return $this->databaseModel->toArray();
    }

    public function getParamsOption(): string
    {
        return RequestOptions::JSON;
    }
}
