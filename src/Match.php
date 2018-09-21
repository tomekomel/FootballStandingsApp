<?php
declare(strict_types=1);


namespace BallGame;


class Match
{
	private $homeTeam;
	private $awayTeam;
	private $homeTeamPoints;
	private $awayTeamPoints;

    private function __construct(Team $homeTeam, Team $awayTeam, int $homeTeamPoints, int $awayTeamPoints)
    {
		$this->homeTeam = $homeTeam;
		$this->awayTeam = $awayTeam;
		$this->homeTeamPoints = $homeTeamPoints;
		$this->awayTeamPoints = $awayTeamPoints;
    }

	/**
	 * @param $homeTeam
	 * @param $awayTeam
	 * @param $homeTeamPoints
	 * @param $awayTeamPoints
	 *
	 * @return Match
	 */
	public static function create( $homeTeam, $awayTeam, $homeTeamPoints, $awayTeamPoints)
	{
		return new self($homeTeam, $awayTeam, $homeTeamPoints, $awayTeamPoints);
	}

	/**
	 * @return Team
	 */
	public function getHomeTeam(): Team
	{
		return $this->homeTeam;
	}

	/**
	 * @return Team
	 */
	public function getAwayTeam(): Team
	{
		return $this->awayTeam;
	}

	/**
	 * @return int
	 */
	public function getHomeTeamPoints(): int
	{
		return $this->homeTeamPoints;
	}

	/**
	 * @return int
	 */
	public function getAwayTeamPoints(): int
	{
		return $this->awayTeamPoints;
	}

}


