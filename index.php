<?php

require 'vendor/autoload.php';

$client = new \Guzzle\Service\Client();
$client->setDescription(\Guzzle\Service\Description\ServiceDescription::factory('config/services/jsonplaceholder.json'));

$postsService = new \App\PostsService($client);
var_dump($postsService->getPosts()->getAll());
var_dump($postsService->getPostById(1));
