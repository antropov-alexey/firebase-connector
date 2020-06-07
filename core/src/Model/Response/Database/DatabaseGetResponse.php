<?php

namespace App\Model\Response\Database;

use App\Model\AbstractResponse;
use stdClass;

class DatabaseGetResponse extends AbstractResponse
{
    /**
     * @return stdClass
     */
    public function getResponse(): stdClass
    {
        return $this->getStdResponse();
    }
}
