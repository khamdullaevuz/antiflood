<?php

namespace Khamdullaevuz;

class AntiFlood
{
    private $connection;
    private $seconds;

    function __construct(string $hostname = 'localhost', int $port = 11211, int $seconds = 1)
    {
        $this->connection = new \Memcache();
        $this->connection->connect($hostname, $port);
        $this->seconds = $seconds;
    }

    private function setValue($key, $value)
    {
        $tmp = new \stdClass();
        $tmp->value = $value;
        $this->connection->set($key, $tmp, false, $this->seconds);
    }

    private function getValue($key)
    {
        return $this->connection->get($key);
    }

    public function check($key, $value)
    {
        if (!is_object($this->getValue($key))) {
            $this->setValue($key, $value);
            return true;
        }
        if ($this->getValue($key)->value !== $value) {
            $this->setValue($key, $value);
            return true;
        } else {
            return false;
        }
    }
}
