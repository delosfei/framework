<?php

namespace delosfei\framework\core;

abstract class Container
{
    protected $building = [];
    public function bind($name, $closure)
    {
        $this->building[$name] = compact('closure');
    }
    protected function make($name)
    {
        $closure = $this->getClosure($name);
        $instance = $this->build($closure);
        return $instance;
    }
    protected function build($closure)
    {
        return $closure($this);
    }
    protected function getClosure($name)
    {
        return isset($this->building[$name]) ? $this->building[$name]['closure'] : $name;
    }
}
