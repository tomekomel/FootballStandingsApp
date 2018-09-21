<?php
declare(strict_types=1);


namespace BallGame;

use BallGame\Team;


class TeamPosition
{
	private $team;
	private $points;
	private $matchesWon;
	private $pointsScored;
	private $pointsAgaints;

	public function __construct(Team $team)
	{
		$this->team = $team;
		$this->points = 0;
		$this->matchesWon = 0;
		$this->pointsScored = 0;
		$this->pointsAgaints = 0;
	}

	public function getTeam()
	{
		return $this->team;
	}

	/**
	 * @return mixed
	 */
	public function getPoints()
	{
		return $this->points;
	}

	/**
	 * @return mixed
	 */
	public function getPointsScored()
	{
		return $this->pointsScored;
	}

	/**
	 * @return mixed
	 */
	public function getPointsAgaints()
	{
		return $this->pointsAgaints;
	}

	public function getMatchesWon()
	{
		return $this->matchesWon;
	}

	public function recordWin()
	{
		$this->points += 3;
		$this->matchesWon += 1;
	}

	public function recordPointsScored(int $pointsScored)
	{
		$this->pointsScored += $pointsScored;
	}

	public function recordPointsAgaints(int $pointsAgaints)
	{
		$this->pointsAgaints += $pointsAgaints;
	}
}


