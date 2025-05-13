<?php

namespace App\Exceptions;

use Exception;

class ApiFilteringInvalidAttributeException extends Exception
{
    public $columnName = '';

    public function setColumnName($columnName)
    {
        $this->columnName = $columnName;
    }

    public function getColumnName()
    {
        return $this->columnName;
    }
}
