<?php

namespace App\Api;

use App\Enum\RequestMethods;
use App\Exception\FirebaseApiException;
use App\Model\Request\Storage\DownloadObjectRequest;
use App\Model\Request\Storage\UploadObjectRequest;

class Storage extends Api
{
    /**
     * @param string $accessToken
     * @param        $fileData
     * @param string $contentType
     * @param string $fileName
     *
     * @throws FirebaseApiException
     */
    public function uploadObject(string $accessToken, $fileData, string $contentType, string $fileName): void
    {
        $request = new UploadObjectRequest($accessToken, $fileData, $contentType, $fileName);

        $this->request(RequestMethods::POST, 'https://storage.googleapis.com/upload/storage/v1/b/alexe/o', $request);
    }

    /**
     * @param string $accessToken
     * @param string $fileName
     *
     * @throws FirebaseApiException
     */
    public function download(string $accessToken, string $fileName): void
    {
        $resource = fopen($fileName, 'w');

        $request = new DownloadObjectRequest($accessToken, $resource);

        $this->request(RequestMethods::GET, "https://storage.googleapis.com/storage/v1/b/alexe/o/{$fileName}", $request);
    }
}
