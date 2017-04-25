<?php

namespace App;

use Psr\Log\AbstractLogger;

/**
 * Class Logger
 * Класс - логгер
 *
 * @package App
 */
class Logger extends AbstractLogger
{
    use Singleton;

    protected $fp;

    protected function __construct()
    {
        $config = Config::getInstance();
        $this->fp = fopen($config->data['log']['fileName'], 'a');
    }

    /**
     * Производит запись в лог-файл
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     */
    public function log($level, $message, array $context = [])
    {
        $log = '[' . date('Y-m-d H:i:s', time()) . '] ';
        $log .= ucfirst($level) . ': ' . $message . PHP_EOL;
        foreach ($context as $item) {
            $log .= (string)$item . PHP_EOL;
        }
        fwrite($this->fp, $log);
    }
}
