<?hh

$exampleName = $argv[1] ?? '';

require './SimpleAutoloader.php';
SimpleAutoloader::register();

ExampleRunner::runExampleByName($exampleName);
