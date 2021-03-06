<?php
declare(strict_types=1);


namespace BallGame\Domain\RuleBook;


use BallGame\Domain\Team\TeamPosition;

class SimpleRuleBook implements RuleBookInterface
{
	public function decide(TeamPosition $teamA, TeamPosition $teamB)
	{
		if ($teamA->getPoints() > $teamB->getPoints()) {
			return -1;
		}

		if ($teamA->getPoints() < $teamB->getPoints()) {
			return 1;
		}

		return 0;
	}

}


