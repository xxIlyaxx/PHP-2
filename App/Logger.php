<?php

namespace App;

/**
 * Class Logger
 * Класс - логгер
 *
 * @package App
 */
class Logger
{
    use Singleton;

    protected $fp;

    protected function __construct()
    {
        $config = Config::getInstance();
        $this->fp = fopen($config->data['log']['fileName'], 'a');
    }

    /**
     * Записывает строку или данные
     * об объекте исключения в лог-файл
     *
     * @param string|\Exception $data
     */
    public function log($data)
    {
        $log = '[' . date('Y-m-d H:i:s', time()) . '] ';
        if (is_string($data)) {
            $log .= 'Message: "' . $data . '"' . PHP_EOL;
        } else if ($data instanceof \Exception) {
            $log .= 'Error: ' . $data->getFile() . ':L' . $data->getLine() .
                ' ' . $data->getMessage() . PHP_EOL;
        } else {
            return;
        }
        fwrite($this->fp, $log);
    }
}
