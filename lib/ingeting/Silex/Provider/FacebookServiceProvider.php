<?php

namespace ingeting\Silex\Provider;
 
use Silex\Application;
use Silex\ServiceProviderInterface;
 
class FacebookServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {

        $app['facebook'] = $app->share(function () use ($app) {

            return new \Facebook(array(
                'appId'  => $app['fb.config.app_id'],
                'secret' => $app['fb.config.secret'],
            ));
            
        });
        
        
    }
    
    public function boot() {
	    
    }
}
