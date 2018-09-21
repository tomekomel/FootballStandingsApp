<?php
declare(strict_types=1);


namespace BallGame;

use BallGame\Team;


class TeamPosition
{
	private $team;
	private $points;
	private $pointsScored;
	private $pointsAgaints;

	public function __construct(Team $team)
	{
		$this->team = $team;
		$this->points = 0;
		$this->pointsScored = 0;
		$this->pointsAgaints = 0;
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

	public function recordWin()
	{
		$this->points += 3;
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


