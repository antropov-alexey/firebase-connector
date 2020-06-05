<?php

namespace App\Model\Response\Auth;

use App\Model\AbstractResponse;

class LoginResponse extends AbstractResponse
{
    /**
     * @return string
     */
    public function getIdToken(): string
    {
        return (string) $this->getStdResponse()->idToken;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->getStdResponse()->email;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return (string) $this->getStdResponse()->refreshToken;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return (int) $this->getStdResponse()->expiresIn;
    }

    /**
     * @return string
     */
    public function getLocalId(): string
    {
        return (string) $this->getStdResponse()->localId;
    }

    /**
     * @return bool
     */
    public function isRegistered(): bool
    {
        return (bool) $this->getStdResponse()->registered;
    }
}
