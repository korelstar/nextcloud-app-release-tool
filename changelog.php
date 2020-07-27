<?php

if (count($argv) !== 3) {
	echo 'Please provide file path as first argument.'.PHP_EOL;
	echo 'Please provide version number as second argument.'.PHP_EOL;
	exit(1);
}
$path = $argv[1];
$version = $argv[2];
$content = file_get_contents($path);
if (preg_match('/^## '.$version.' - \d+-\d+-\d+$(.*?)^## /ms', $content, $matches)) {
	echo trim($matches[1]);
} else {
	echo 'Release for version '.$version.' not found in changelog.'.PHP_EOL;
	exit(2);
}
