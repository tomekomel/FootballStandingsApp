<?php
declare(strict_types=1);

namespace BallGame\Tests;

use BallGame\Standings;
use BallGame\Team;
use BallGame\Match;
use PHPUnit\Framework\TestCase;

class StandingsTest extends TestCase
{
	/**
	 * @var Standings
	 */
	private $standings;

    public function setUp()
    {
        $this->standings = Standings::create();
    }

    public function testGetStandingsReturnsSortedLeagueStandings()
    {
    	$tigers = Team::create('Tigers');
    	$elephants = Team::create('Elephants');

    	$match = Match::create($tigers, $elephants, 2, 1);

    	$this->standings->record($match);

    	// When
    	$actualStandings = $this->standings->getSortedStandings();

    	// Then
		$this->assertSame(
			[
				['Tigers', 2, 1, 3],
				['Elephants', 1, 2, 0],
			],
			$actualStandings
		);
    }

	public function testGetStandingsReturnsSortedLeagueStandingsWhenSecondTeamEndsUpInFirstPlace()
	{
		$tigers = Team::create('Tigers');
		$elephants = Team::create('Elephants');

		$match = Match::create($tigers, $elephants, 2, 1);

		$this->standings->record($match);

		// When
		$actualStandings = $this->standings->getSortedStandings();

		// Then
		$this->assertSame(
			[
				['Elephants', 1, 0, 3],
				['Tigers', 0, 1, 0],
			],
			$actualStandings
		);
	}
}
