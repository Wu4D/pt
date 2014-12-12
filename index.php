<?php 

use framework\base\Application; 

require_once(__DIR__."/include/autoload.php");
$start = microtime(true);

$application = new Application(); 
$application->run();

$stop = microtime(true);
$time = $stop - $start;

echo "Time spent in APP :$time <BR> Memory: ". (memory_get_usage() / 1024 / 1024 ). "MB";

?>