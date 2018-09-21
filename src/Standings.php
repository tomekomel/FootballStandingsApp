<?php
declare(strict_types=1);


namespace BallGame;

use BallGame\RuleBook\RuleBookInterface;

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

	private $ruleBook;

    private function __construct(RuleBookInterface $ruleBook)
    {
		$this->ruleBook = $ruleBook;
    }

	public static function create(RuleBookInterface $ruleBook)
	{
		return new self($ruleBook);
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

			uasort( $this->teamPositions, [$this->ruleBook, 'decide']);

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


