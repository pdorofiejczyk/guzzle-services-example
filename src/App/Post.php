<?php
namespace App;
use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Command\ResponseClassInterface;

/**
 * Created by PhpStorm.
 * User: pdorofiejczyk
 * Date: 06.04.2016
 * Time: 23:56
 */
class Post implements ResponseClassInterface
{
    private $id;
    private $userId;
    private $title;
    private $body;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->userId = $data['userId'];
        $this->title = $data['title'];
        $this->body = $data['body'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getBody()
    {
        return $this->body;
    }

    public static function fromCommand(OperationCommand $command)
    {
        $data = $command->getResponse()->json();

        return new self($data);
    }
}