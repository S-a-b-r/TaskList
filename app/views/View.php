<?php

class View
{
    public function __construct(string $name, array $params = [])
    {
        include_once($name.'.php');
    }
}