<?php

namespace delosfei\framework\core;

abstract class Provider
{
    protected $defer = true;
    abstract public function register(App $app);
    protected $app;
    public function __construct(App $app)
    {
        $this->app = $app;
    }
}
