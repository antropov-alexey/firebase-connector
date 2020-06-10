<?php

namespace App\Model\Request\Storage;

use App\Model\RequestInterface;
use GuzzleHttp\RequestOptions;

class UploadObjectRequest implements RequestInterface
{
    private string   $authKey;
    private string   $contentType;
    private string   $name;
    private          $fileData;

    public function __construct(string $authKey, $fileData, string $contentType, string $name)
    {
        $this->authKey     = $authKey;
        $this->contentType = $contentType;
        $this->name        = $name;
        $this->fileData    = $fileData;
    }

    public function getOptions(): array
    {
        return [
            RequestOptions::HEADERS => [
                'Authorization' => "Bearer {$this->authKey}",
                'Content-Type'  => $this->contentType,
            ],
            RequestOptions::QUERY   => [
                'uploadType' => 'media',
                'name'       => $this->name,
            ],
            RequestOptions::BODY    => $this->fileData,
        ];
    }
}
