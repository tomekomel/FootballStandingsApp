<?php
declare(strict_types=1);


namespace BallGame\RuleBook;

use BallGame\TeamPosition;


interface RuleBookInterface
{
	public function decide(TeamPosition $teamA, TeamPosition $teamB);

}


