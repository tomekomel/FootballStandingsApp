<?php
declare(strict_types=1);


namespace BallGame;


class GetTheBallRolling
{
    private $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function create(string $name)
    {
        return new self($name);
    }

    public function getName()
    {
        return $this->name;
    }
}
