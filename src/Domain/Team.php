<?php
declare(strict_types=1);


namespace BallGame\Domain;


use BallGame\Domain\Exception\BadTeamNameException;

class Team
{
	private $name;

    private function __construct(string $name)
    {
		$this->name = $name;
    }

	public static function create($name)
	{
		if (empty($name)) {
			throw new BadTeamNameException();
		}
		return new self($name);
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

}


