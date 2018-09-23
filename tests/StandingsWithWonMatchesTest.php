<?php
declare(strict_types=1);

namespace BallGame\Tests;

use BallGame\Repository\MatchRepository;
use BallGame\Domain\RuleBook\SimpleRuleBook;
use BallGame\Domain\Standings;
use BallGame\Domain\Team;
use BallGame\Domain\Match;
use PHPUnit\Framework\TestCase;

class StandingsWithWonMatchesTest extends TestCase
{
	/**
	 * @var Standings
	 */
	private $standings;
	private $ruleBook;
	private $matchesRepository;

    public function setUp()
    {
	    $this->matchesRepository = $this->getMockBuilder(MatchRepository::class)
		    ->disableOriginalConstructor()
		    ->getMock();

    	$this->ruleBook = new SimpleRuleBook();
        $this->standings = Standings::create($this->ruleBook, $this->matchesRepository);
    }

    public function testGetStandingsWithTeamWhoWonTwoMatches()
    {
		$this->matchesRepository->method('findAll')->willReturn([
			Match::create(
				Team::create('Tigers'),
				Team::create('Elephants'),
				1,
				0
			),
			Match::create(
				Team::create('Tigers'),
				Team::create('Elephants'),
				2,
				0
			),
		]);

    	// When
    	$actualStandings = $this->standings->getWonMatches();

    	// Then
		$this->assertSame(
			[
				['Tigers', 3, 0, 6, 2],
				['Elephants', 0, 3, 0, 0],
			],
			$actualStandings
		);
    }
	
}
