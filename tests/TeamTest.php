<?php
declare(strict_types=1);


namespace BallGame\Tests;


use BallGame\Domain\Exception\BadTeamNameException;
use BallGame\Domain\Match\Match;
use BallGame\Domain\Team\Team;
use PHPUnit\Framework\TestCase;

class MatchTest extends TestCase
{
	public function testDoesNotAllowMatchWithTheSameName()
	{

		$this->expectException(BadTeamNameException::class);
		Match::create(
			Team::create('Name'),
			Team::create('Name'),
			0,
			0
		);


	}
}
