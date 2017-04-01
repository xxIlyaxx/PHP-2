<?php

namespace App;

trait GetSet
{
    protected $data = [];

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __set($name, $value)
    {
        return $this->data[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }
}
