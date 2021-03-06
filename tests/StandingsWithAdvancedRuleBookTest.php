<?php
declare(strict_types=1);


namespace BallGame\Tests;


use BallGame\Repository\MatchRepository;
use BallGame\Domain\RuleBook\AdvancedRuleBook;
use BallGame\Domain\Standings\Standings;
use BallGame\Domain\Team\Team;
use BallGame\Domain\Match\Match;
use PHPUnit\Framework\TestCase;

class StandingsWithAdvancedRuleBookTest extends TestCase
{
	/**
	 * @var Standings
	 */
	private $standings;
	private $ruleBook;

    public function setUp()
    {
    	$this->ruleBook = new AdvancedRuleBook();
        $this->standings = Standings::create($this->ruleBook, new MatchRepository());
    }

	/**
	 * @group integration
	 */
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

	/**
	 * @group integration
	 */
	public function testGetStandingsReturnsSortedLeagueStandingsWhenSecondTeamEndsUpInFirstPlace()
	{
		$tigers = Team::create('Tigers');
		$elephants = Team::create('Elephants');

		$match = Match::create($tigers, $elephants, 1, 2);

		$this->standings->record($match);

		// When
		$actualStandings = $this->standings->getSortedStandings();

		// Then
		$this->assertSame(
			[
				['Elephants', 2, 1, 3],
				['Tigers', 1, 2, 0],
			],
			$actualStandings
		);
	}
	
}
