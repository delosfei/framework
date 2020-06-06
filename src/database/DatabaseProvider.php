<?php

namespace delosfei\framework\database;

use delosfei\framework\core\App;
use delosfei\framework\core\Provider;

class DatabaseProvider extends Provider
{
    protected $defer = false;
    public function boot()
    {
        echo 'database boot';
    }
    public function register(App $app)
    {
        $app->bind('Database', function () {
            return new Database();
        });
    }
}
