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
    use TraitIterator;

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
}
