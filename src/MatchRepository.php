<?php
declare(strict_types=1);


namespace BallGame;

use BallGame\Team;
use BallGame\Standings;

class MatchRepository
{
	private $matches;

	public function save(Match $match)
	{
		sleep(2);

		$this->matches[] = $match;
	}

	public function findAll()
	{
		sleep(1);

		return $this->matches;
	}
}
