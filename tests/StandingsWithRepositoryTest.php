<?php
declare(strict_types=1);


namespace BallGame\Tests;


use BallGame\Domain\RuleBook\AdvancedRuleBook;
use BallGame\Domain\Standings\Standings;
use BallGame\Domain\Team\Team;
use BallGame\Domain\Match\Match;
use BallGame\Repository\MatchRepository;
use PHPUnit\Framework\TestCase;

class StandingsWithRepositoryTest extends TestCase
{
	/**
	 * @var Standings
	 */
	private $standings;
	private $ruleBook;

	/**
	 * @var MatchRepository
	 */
	private $matchesRepository;

    public function setUp()
    {
	    $this->matchesRepository = $this->getMockBuilder(MatchRepository::class)
		    ->disableOriginalConstructor()
		    ->getMock();

    	$this->ruleBook = new AdvancedRuleBook();
        $this->standings = Standings::create($this->ruleBook, $this->matchesRepository);
    }

    public function testGetStandingsFetchedFromRepository()
    {
		$this->matchesRepository->method('findAll')->willReturn([
			Match::create(
				Team::create('Tigers'),
				Team::create('Elephants'),
				0,
				1
			)
		]);

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

    public function testRecordSavesMatchInRepository()
    {
		$match = $this->getMockBuilder(Match::class)
			->disableOriginalConstructor()
			->getMock();

		$this->matchesRepository
			->expects($this->once())
			->method('save');

    	$this->standings->record($match);
    }
	
}
