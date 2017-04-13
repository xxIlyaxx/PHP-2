<?php

namespace App;

trait TraitIterator
{
    /**
     * Сбрасывает внутренний указатель
     */
    public function rewind()
    {
        reset($this->data);
    }

    /**
     * Возвращает ключ на который указывает внутренний указатель
     *
     * @return mixed
     */
    public function key()
    {
        return key($this->data);
    }

    /**
     * Возвращает значение на который указывает внутренний указатель
     *
     * @return mixed
     */
    public function current()
    {
        return current($this->data);
    }

    /**
     * Сдвигает внутренний указатель на следующий элемент
     */
    public function next()
    {
        next($this->data);
    }

    /**
     * Проверяет не вышел ли внутренний указатель за пределы массива
     *
     * @return bool
     */
    public function valid()
    {
        return key($this->data) !== null;
    }
}
