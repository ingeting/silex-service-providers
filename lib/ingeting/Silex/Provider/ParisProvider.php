<?php

namespace ingeting\Silex\Provider;
 
use Silex\Application;
use Silex\ServiceProviderInterface;
 
//use Cs\Utils as u;
     
 
require_once __DIR__.'/../../../vendor/Idiorm/idiorm.php';
require_once __DIR__.'/../../../vendor/Paris/paris.php';


 
class ParisProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['paris'] = $app->share(function () use ($app) {
            \ORM::configure($app['paris.dsn']);
            \ORM::configure('username', $app['paris.username']);
            \ORM::configure('password', $app['paris.password']);
            \ORM::configure('logging', true );
            \ORM::configure('driver_options', array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ));
 
            return new ParisWrapper();
        });
    }
    
    public function boot(Application $app) {
	    
    }
}
 
class ParisWrapper
{
    public function getModel($modelName)
    {
        return \Model::factory($modelName);
    }
     
    public function getLastQuery()
    {
        return \ORM::get_last_query();
    }
     
    public function getQueryLog()
    {
        return \ORM::get_query_log();
    }
}