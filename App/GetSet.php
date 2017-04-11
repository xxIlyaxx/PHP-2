<?php

namespace App;

/**
 * Trait GetSet
 * Содержит в себе реализацию магических
 * методов __get(), __set() и __isset()
 *
 * @package App
 */
trait GetSet
{
    protected $data = [];

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function __unset($name)
    {
        unset($this->data[$name]);
    }

}
