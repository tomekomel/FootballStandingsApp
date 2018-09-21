<?php
declare(strict_types=1);


namespace BallGame\Exception;


use BallGame\Team;
use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase
{
	public function testCreateDoesNotAllowTeamWithNoName()
	{
		$this->expectException(BadTeamNameException::class);

		Team::create('');
	}
}
