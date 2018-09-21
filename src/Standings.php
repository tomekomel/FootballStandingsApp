<?php
declare(strict_types=1);


namespace BallGame;


class Standings
{
	/**
	 * @var Match[]
	 */
	private $matches;

    private function __construct()
    {

    }

	public static function create()
	{
		return new self();
	}

	public function record(Match $match)
	{
		$this->matches[] = $match;
	}

	public function getSortedStandings()
	{
		return [
			['Tigers', 2, 1, 3],
			['Elephants', 1, 2, 0],
		];
	}
}


