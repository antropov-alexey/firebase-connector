<?php

namespace App\Model\Response\Database;

use App\Model\AbstractResponse;

class DatabaseWriteResponse extends AbstractResponse
{
    /**
     * @return string
     */
    public function getRecordUid(): string
    {
        return (string) $this->getStdResponse()->name;
    }
}
