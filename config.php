<?php

$config = ['app'=> 
    
    
    
                  ['controller' => 
                        ['path' => "controller/", //This is the controller folder where you place your controllers
                         //The path must not start with / 
                            
                        'method_hook' => 'action',
                        ],
                   
                   
                   
                   'db'=>
                       ['type'=>'mysql',
                       'host'=>'127.0.0.1', 
                       'user'=>'root', 
                       'pass'=>'', 
                       'name'=>'ptframework',
                       'cache' => [
                           'schema' => 1,
                       ]
                      ],
                   
    
    
    
                  'cache'=> 
                      [
                          'memcache' => [
                              'status' => 0, 
                              'host' => 'localhost', 
                              'port' => '11211',
                          ], 
                           
                      ]], //Enable disable chaching - 0 Disabled, 1 Enabled
          ];
         
?>