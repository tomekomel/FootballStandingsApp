<?php
declare(strict_types=1);

namespace BallGame\Tests;

use BallGame\Standings;
use BallGame\RuleBook\AdvancedRuleBook;
use BallGame\Match;
use BallGame\TeamPosition;
use PHPUnit\Framework\TestCase;

class AdvancedRuleBookTest extends TestCase
{
	/**
	 * @var Standings
	 */
	private $advancedRuleBook;

	public function setUp() {
		$this->teamAPosition = $this->getMockBuilder(TeamPosition::class)
			->disableOriginalConstructor()
			->getMock();

		$this->teamBPosition = $this->getMockBuilder(TeamPosition::class)
			->disableOriginalConstructor()
			->getMock();

		$this->advancedRuleBook = new AdvancedRuleBook();
	}

	public function testDecideReturnsGreaterThanZeroWhenFirstPositionPointsIsGreaterThanSecond() {
		$this->teamAPosition->method('getPoints')->willReturn(10);
		$this->teamBPosition->method('getPoints')->willReturn(1);

		$this->assertSame(-1, $this->advancedRuleBook->decide($this->teamAPosition, $this->teamBPosition));
	}

	public function testDecideReturnsGreaterThanZeroWhenSecondPositionPointsIsGreaterThanFirst() {
		$this->teamAPosition->method('getPoints')->willReturn(1);
		$this->teamBPosition->method('getPoints')->willReturn(10);

		$this->assertSame(1, $this->advancedRuleBook->decide($this->teamAPosition, $this->teamBPosition));
	}

	public function testDecideReturnsZeroWhenBothPositionsPointsAreTheSame() {
		$this->teamAPosition->method('getPoints')->willReturn(1);
		$this->teamBPosition->method('getPoints')->willReturn(1);

		$this->assertSame(0, $this->advancedRuleBook->decide($this->teamAPosition, $this->teamBPosition));
	}

}
