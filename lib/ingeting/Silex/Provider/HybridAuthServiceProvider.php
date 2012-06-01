<?php

namespace ingeting\Silex\Provider;
 
use Silex\Application;
use Silex\ServiceProviderInterface;
 
class HybridAuthServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        /*$app['auth'] = $app->share(function () use ($app) {
            return new HybridAuthWrapper();
        });*/
        
        $app['auth'] = $app->share(function () use ($app) {
            
            require_once $app['hybridauth.class_file'];
            
         
            $config = array(
				"base_url" => $app['hybridauth.base_url'],  
		
				"providers" => array ( 
					// openid providers
					"Facebook" => array ( 
						"enabled" => true,
						"keys"    => array ( "id" => $app['fb.config.app_id'], "secret" => $app['fb.config.secret'] ),
		
						// A comma-separated list of permissions you want to request from the user. See the Facebook docs for a full list of available permissions: http://developers.facebook.com/docs/reference/api/permissions.
						"scope"   => ",", 
		
						// The display context to show the authentication page. Options are: page, popup, iframe, touch and wap. Read the Facebook docs for more details: http://developers.facebook.com/docs/reference/dialogs#display. Default: page
						"display" => "" 
					)
				),
		
				// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
				"debug_mode" => true,
		
				"debug_file" => $app['hybridauth.config.log_file'],
			);

            return new \Hybrid_Auth($config);
        });
    }
    
    public function boot() {
	    
    }
}
