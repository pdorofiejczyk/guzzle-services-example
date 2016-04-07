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
class Posts implements ResponseClassInterface
{
    private $posts;

    /**
     * Posts constructor.
     * @param Post[] $posts
     */
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    public static function fromCommand(OperationCommand $command)
    {
        $data = $command->getResponse()->json();
        $posts = [];

        foreach ($data as $d) {
            $posts[$d['id']] = new Post($d);
        }

        return new self($posts);
    }

    /**
     * @return Post[]
     */
    public function getAll()
    {
        return $this->posts;
    }

    /**
     * @param $id
     * @return Post|null
     */
    public function getById($id)
    {
        return isset($this->posts[$id]) ? $this->posts[$id] : null;
    }
}