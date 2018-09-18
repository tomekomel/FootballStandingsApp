<?php
declare(strict_types=1);

namespace BallGame\Tests;

use BallGame\GetTheBallRolling;
use PHPUnit\Framework\TestCase;

class GetTheBallRollingTest extends TestCase
{
    public function testGetNameReturnsCreatedName()
    {
        $ball = GetTheBallRolling::create('Hello');

        $this->assertSame('Hello', $ball->getName());
    }
}
