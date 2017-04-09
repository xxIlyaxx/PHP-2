<?php

namespace App\Models;

/**
 * Class Author
 * Модель автора
 *
 * @package App\Models
 */
class Author extends Model
{
    protected const TABLE = 'authors';

    public $name;

    /**
     * Устанавливает cвойство name
     * у данной модели
     *
     * @param $name
     */
    public function setName($name)

    {
        if (false === is_string($name)) {
            throw new \InvalidArgumentException('The name must be a string');
        }
        $this->name = $name;
    }
}
