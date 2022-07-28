<?php

namespace Khamdullaevuz;

class AntiFlood
{
    private $connection;

    function __construct()
    {
        $this->connection = new \Memcache();
        $this->connection->connect('localhost', 11211);
    }

    private function setValue($key, $value)
    {
        $tmp = new \stdClass();
        $tmp->value = $value;
        $this->connection->set($key, $tmp, false, 10);
    }

    private function getValue($key)
    {
        return $this->connection->get($key);
    }

    public function check($key, $value)
    {
        if(!is_object($this->getValue($key))) {
            $this->setValue($key, $value);
            return true;
        }
        if($this->getValue($key)->value !== $value)
        {
            $this->setValue($key, $value);
            return true;
        }else {
            return false;
        }
    }
}
