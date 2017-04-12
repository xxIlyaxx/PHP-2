<?php

namespace App\Models;

/**
 * Class Article
 * Модель статьи
 *
 * @package App\Models
 *
 *
 * @property string title
 * @property string lead
 * @property string author_id
 * @property Author $author
 */
class Article extends Model
{
    protected const TABLE = 'news';

    public function __get($name)
    {
        if ('author' === $name && null !== $this->data['author_id']) {
            if (!isset($this->data['author'])) {
                $this->data['author'] = Author::findById($this->data['author_id']);
            }
        }
        return $this->data[$name];
    }

    /**
     * Устанавливает cвойство author_id
     * у данной модели
     *
     * @param $id
     */
    public function setAuthor_id($id) {
        if (!is_numeric($id) && 0 > $id) {
            throw new \InvalidArgumentException('The author_id must be a number and greater than 0');
        }
        $this->author_id = (int)$id;
    }

}
