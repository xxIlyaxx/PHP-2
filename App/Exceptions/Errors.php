<?php

namespace App\Exceptions;

/**
 * Class Errors
 *
 * @package App\Exceptions
 */
class Errors extends \Exception
{
    protected $data = [];

    public function add(\Exception $e)
    {
        $this->data[] = $e;
    }

    public function getErrors()
    {
        return $this->data;
    }
}
