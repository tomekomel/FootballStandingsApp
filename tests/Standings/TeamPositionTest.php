<?php
declare(strict_types=1);

namespace BallGame\Tests;

use BallGame\Domain\Standings;
use BallGame\Domain\Team;
use BallGame\Domain\TeamPosition;
use PHPUnit\Framework\TestCase;

class TeamPositionTest extends TestCase
{
	/**
	 * @var TeamPosition
	 */
	private $teamPosition;

	public function setUp()
	{
		$team = Team::create('Some other team');

		$this->teamPosition = new TeamPosition($team);
	}

	public function testGetPointsReturnsZeroWhenThereAreNoGames()
	{
		$this->assertSame(0, $this->teamPosition->getPoints());
	}

	public function testGetPointsReturnsZeroWhenThereAreThreeWins()
	{
		$this->teamPosition->recordWin();
		$this->teamPosition->recordWin();
		$this->teamPosition->recordWin();

		$this->assertSame(9, $this->teamPosition->getPoints());
	}

	public function testGetPointsScoredReturnsZeroWhenThereAreNoGames()
	{
		$this->assertSame(0, $this->teamPosition->getPointsScored());
	}

	public function testGetPointsScoredAfterThreeGames()
	{
		$this->teamPosition->recordPointsScored(1);
		$this->teamPosition->recordPointsScored(2);
		$this->teamPosition->recordPointsScored(3);

		$this->assertSame(6, $this->teamPosition->getPointsScored());
	}

	public function testGetPointsAgaintsReturnsZeroWhenThereAreNoGames()
	{
		$this->assertSame(0, $this->teamPosition->getPointsAgaints());
	}

	public function testGetPointsAgaintsAfterThreeGames()
	{
		$this->teamPosition->recordPointsAgaints(1);
		$this->teamPosition->recordPointsAgaints(2);
		$this->teamPosition->recordPointsAgaints(3);

		$this->assertSame(6, $this->teamPosition->getPointsAgaints());
	}
}
