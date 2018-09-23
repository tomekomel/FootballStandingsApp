<?php
declare(strict_types=1);


namespace BallGame\Domain;


class GetTheBallRolling
{
    private $name;
    private $numberArray = [];

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function create(string $name)
    {
        return new self($name);
    }

    public function getName()
    {
        return $this->name;
    }

    public function calculateBinaryGap($number)
    {
    	$binaryGaps = [];
    	$binaryGap = 0;
    	$prev_char = null;
    	$decimal = decbin($number);

    	for($i = 0; $i < strlen($decimal); $i++) {

	    	if($decimal[$i] == 0 && isset($prev_char) && $prev_char == 1)
		    {
		    	$binaryGap++;
		    }

		    if($decimal[$i] == 0 && $binaryGap > 0)
		    {
		    	$binaryGap++;
		    }

		    if($decimal[$i] == 1 && $binaryGap > 0)
		    {
		    	$binaryGaps[] = $binaryGap;
		    	$binaryGap = 0;
		    }

	    	$prev_char = $decimal[$i];
	    }

	    return empty($binaryGaps) ? 0 : ( max($binaryGaps) - 1 );
    }

    // array_flip
    public function getOddOccurrences(array $numbers)
    {
    	$result = [];
    	$counted_values = array_count_values($numbers);

    	return $result;
    }


}


