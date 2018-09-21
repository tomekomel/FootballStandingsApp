<?php
declare(strict_types=1);

namespace BallGame\Tests;

use BallGame\GetTheBallRolling;
use PHPUnit\Framework\TestCase;

class GetTheBallRollingTest extends TestCase
{
	private $ball;

    public function testGetNameReturnsCreatedName()
    {
        $ball = GetTheBallRolling::create('Hello');

        $this->assertSame('Hello', $ball->getName());
    }

    public function setUp()
    {
	    $this->ball = GetTheBallRolling::create('Hello');
    }

    public function testBinaryWhenGapSizeTwo()
    {
    	$this->assertEquals( 2, $this->ball->calculateBinaryGap(9));
    }

	public function testBinaryWhenThereAreTwoGaps()
	{
		// 10000100
		$this->assertEquals( 4, $this->ball->calculateBinaryGap(132));
	}

	public function testBinaryWhenThereAreNoGaps()
	{
		// 11111111111111111
		$this->assertEquals( 0, $this->ball->calculateBinaryGap(131071));
	}

	public function testBinaryWhenThereAreTwoGapsAndTheLatterIsGrater()
	{
		// 11010001
		$this->assertEquals( 3, $this->ball->calculateBinaryGap(209));
	}

	// Second Exercise
	public function testOddOccurenceWhenOneElementsExists()
	{
		$input = [42];
		$oddOccurrences = $this->ball->getOddOccurrences( $input );
		$this->assertSame( 42, $oddOccurrences);
	}

	public function testOddOccurenceWhenOneElement()
	{
		$input = [3, 5, 5, 7, 7, 7, 9, 9];
		$oddOccurrences = $this->ball->getOddOccurrences( $input );
		$this->assertSame( 3, $oddOccurrences);
	}

	public function testOddOccurenceWhenTwoElement()
	{
		$input = [3, 5, 5, 7, 7, 7, 9, 9, 11];
		$oddOccurrences = $this->ball->getOddOccurrences( $input );
		$this->assertSame( [3, 11], $oddOccurrences);
	}
}
