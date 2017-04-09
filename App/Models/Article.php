<?php

namespace App\Models;

/**
 * Class Article
 * Модель статьи
 *
 * @package App\Models
 *
 * @property Author $author
 */
class Article extends Model
{
    protected const TABLE = 'news';

    public $title;
    public $lead;
    public $author_id;

    public function __get($name)
    {
        if ('author' === $name && null !== $this->author_id) {
            return Author::findById($this->author_id);
        }
    }

    /**
     * Устанавливает cвойство title
     * у данной модели
     *
     * @param $title
     */
    public function setTitle($title) {
        if (!is_string($title)) {
            throw new \InvalidArgumentException('The title must be a string');
        }
        $this->title = $title;
    }

    /**
     * Устанавливает cвойство lead
     * у данной модели
     *
     * @param $lead
     */
    public function setLead($lead) {
        if (!is_string($lead)) {
            throw new \InvalidArgumentException('The lead must be a string');
        }
        $this->title = $lead;
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
