<?php
/**
 * Created by PhpStorm.
 * User: pdorofiejczyk
 * Date: 07.04.2016
 * Time: 00:28
 */

namespace App;


use Guzzle\Service\ClientInterface;

class HttpService
{
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function __call($name, $arguments = [])
    {
        $operation = $this->client->getDescription()->getOperation($name);

        if($operation === null) {
            return null;
        }

        $paramNames = $operation->getParamNames();
        $args = [];

        foreach ($arguments as $i => $argument) {
            $args[$paramNames[$i]] = $argument;
        }

        $command = $this->client->getCommand($name, $args);

        if($command !== null) {
           return $command->execute();
        }

        return null;
    }
}