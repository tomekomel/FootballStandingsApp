<?php
declare(strict_types=1);


namespace BallGame\Domain\RuleBook;

use BallGame\Domain\TeamPosition;


interface RuleBookInterface
{
	public function decide(TeamPosition $teamA, TeamPosition $teamB);

}


