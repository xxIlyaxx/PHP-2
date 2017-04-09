<?php

namespace App;

/**
 * Class View
 * Класс представления
 *
 * @package App
 */
class View implements \Countable, \Iterator
{
    use GetSet;

    /**
     * Возвращает строку HTML кода
     *
     * @param string $template
     * @return string
     */
    public function render(string $template)
    {
        foreach ($this as $name => $value) {
            $$name = $value;
        }
        ob_start();
        include $template;
        return ob_get_clean();
    }

    /**
     * Отправляет HTML код клиенту
     *
     * @param string $template
     */
    public function display(string $template)
    {
        echo $this->render($template);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->data);
    }

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