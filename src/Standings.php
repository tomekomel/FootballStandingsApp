<?php
declare(strict_types=1);


namespace BallGame;


class Standings
{
	/**
	 * @var Match[]
	 */
	private $matches;

	/**
	 * @var TeamPosition
	 */
	private $teamPositions;

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
		foreach($this->matches as $match) {
			if(!isset($this->teamPositions[spl_object_hash($match->getHomeTeam())])) {
				$this->teamPositions[spl_object_hash($match->getHomeTeam())] = new TeamPosition($match->getHomeTeam());
			}
			$homeTeamPosition = $this->teamPositions[spl_object_hash($match->getHomeTeam())];

			if(!isset($this->teamPositions[spl_object_hash($match->getAwayTeam())])) {
				$this->teamPositions[spl_object_hash($match->getAwayTeam())] = new TeamPosition($match->getAwayTeam());
			}
			$awayTeamPosition = $this->teamPositions[spl_object_hash($match->getAwayTeam())];

			if($match->getHomeTeamPoints() > $match->getAwayTeamPoints()) {
				$homeTeamPosition->recordWin();
			}

			if($match->getAwayTeamPoints() > $match->getHomeTeamPoints()) {
				$awayTeamPosition->recordWin();
			}

			$homeTeamPosition->recordPointsScored($match->getHomeTeamPoints());
			$homeTeamPosition->recordPointsAgaints($match->getAwayTeamPoints());

			$awayTeamPosition->recordPointsScored($match->getAwayTeamPoints());
			$awayTeamPosition->recordPointsAgaints($match->getHomeTeamPoints());

			uasort( $this->teamPositions, function (TeamPosition $teamA, TeamPosition $teamB) {
				if ($teamA->getPoints() > $teamB->getPoints()) {
					return -1;
				}

				if ($teamA->getPoints() < $teamB->getPoints()) {
					return 1;
				}

				return 0;
			});

			$finalStandings = [];

			foreach ($this->teamPositions as $teamPosition) {
				$finalStandings[] = [
					$teamPosition->getTeam()->getName(),
					$teamPosition->getPointsScored(),
					$teamPosition->getPointsAgaints(),
					$teamPosition->getPoints()
				];
			}

			return $finalStandings;
		}
	}
}


