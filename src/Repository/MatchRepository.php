<?php
declare(strict_types=1);


namespace BallGame\Repository;


use BallGame\Domain\Match;

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
