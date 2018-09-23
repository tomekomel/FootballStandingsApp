<?php
declare(strict_types=1);

namespace BallGame\Tests;

use BallGame\Domain\Standings;
use BallGame\Domain\RuleBook\SimpleRuleBook;
use BallGame\Domain\Team\TeamPosition;
use PHPUnit\Framework\TestCase;

class SimpleRuleBookTest extends TestCase
{
	/**
	 * @var Standings
	 */
	private $simpleRuleBook;

	public function setUp() {
		$this->teamAPosition = $this->getMockBuilder(TeamPosition::class)
			->disableOriginalConstructor()
			->getMock();

		$this->teamBPosition = $this->getMockBuilder(TeamPosition::class)
			->disableOriginalConstructor()
			->getMock();

		$this->simpleRuleBook = new SimpleRuleBook();
	}

	public function testDecideReturnsGreaterThanZeroWhenFirstPositionPointsIsGreaterThanSecond() {
		$this->teamAPosition->method('getPoints')->willReturn(10);
		$this->teamBPosition->method('getPoints')->willReturn(1);

		$this->assertSame(-1, $this->simpleRuleBook->decide($this->teamAPosition, $this->teamBPosition));
	}

	public function testDecideReturnsGreaterThanZeroWhenSecondPositionPointsIsGreaterThanFirst() {
		$this->teamAPosition->method('getPoints')->willReturn(1);
		$this->teamBPosition->method('getPoints')->willReturn(10);

		$this->assertSame(1, $this->simpleRuleBook->decide($this->teamAPosition, $this->teamBPosition));
	}

	public function testDecideReturnsZeroWhenBothPositionsPointsAreTheSame() {
		$this->teamAPosition->method('getPoints')->willReturn(1);
		$this->teamBPosition->method('getPoints')->willReturn(1);

		$this->assertSame(0, $this->simpleRuleBook->decide($this->teamAPosition, $this->teamBPosition));
	}

}
