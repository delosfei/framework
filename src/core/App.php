<?php

namespace delosfei\framework\core;

use ReflectionClass;

class App extends Container
{
    protected $serviceProviders = [];
    protected $deferProviders = [];
    public function bootstrap()
    {
        define('BASE_PATH', __DIR__ . '/../..');
        $this->bindProviders();
        $this->boot();
    }
    protected function boot()
    {
        foreach ($this->serviceProviders as $provider) {
            if (method_exists($provider, 'boot')) $provider->boot($this);
        }
    }
    public function make($name)
    {
        if (isset($this->deferProviders[$name])) {
            $this->register($this->deferProviders[$name]);
        }
        return parent::make($name);
    }
    protected function bindProviders()
    {
        $config = include BASE_PATH . '/config/app.php';
        foreach ($config['providers'] as $provider) {
            $reflection = new ReflectionClass($provider);
            $properties = $reflection->getDefaultProperties();
            if ($properties['defer'] === false) {
                $this->register($provider);
            } else {
                $alias = substr($reflection->getShortName(), 0, -8);
                $this->deferProviders[$alias] = $provider;
            }
        }
    }
    protected function register($provider)
    {
        if ($this->getProvider($provider)) return;
        $object = new $provider($this);
        $object->register($this);
        $this->serviceProviders[] = $object;
    }
    protected function getProvider($provider)
    {
        $class = is_object($provider) ? get_class($provider) : $provider;
        foreach ($this->serviceProviders as $instance) {
            if ($instance instanceof $class) {
                return $instance;
            }
        }
    }
}
