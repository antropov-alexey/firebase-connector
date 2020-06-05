<?php

namespace App\Model;

use GuzzleHttp\RequestOptions;

interface RequestInterface
{
    /**
     * @return array
     */
    public function serialize(): array;

    /**
     * @return string
     * @see RequestOptions
     */
    public function getParamsOption(): string;
}