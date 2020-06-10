<?php

namespace App\Model\Response\Auth;

use App\Model\AbstractResponse;

class GetAccessTokenResponse extends AbstractResponse
{
    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return (string) $this->getStdResponse()->access_token;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return (string) $this->getStdResponse()->refresh_token;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return (int) $this->getStdResponse()->expires_in;
    }
}
