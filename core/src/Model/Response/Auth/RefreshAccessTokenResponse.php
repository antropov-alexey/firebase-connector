<?php

namespace App\Model\Response\Auth;

use App\Model\AbstractResponse;

class RefreshAccessTokenResponse extends AbstractResponse
{
    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return (string) $this->getStdResponse()->access_token;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return (int) $this->getStdResponse()->expires_in;
    }
}
