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
                       'name'=>'ptframework'],
                   
    
    
    
                  'cache'=>0], //Enable disable chaching - 0 Disabled, 1 Enabled
          ];
         
?>