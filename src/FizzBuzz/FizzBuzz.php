<?php

namespace FizzBuzz;

class FizzBuzz
{
    /**
     * @var int
     */
    private int $fizzNumber;

    /**
     * @var string
     */
    private string $fizzString;

    /**
     * @var int
     */
    private int $buzzNumber;

    /**
     * @var string
     */
    private string $buzzString;

    /**
     * FizzBuzz constructor.
     * @param int $fizzNumber
     * @param string $fizzString
     * @param int $buzzNumber
     * @param string $buzzString
     */
    public function __construct(int $fizzNumber = 3, string $fizzString = 'Fizz', int $buzzNumber = 5, string $buzzString = 'Buzz')
    {
        $this->fizzNumber = $fizzNumber;
        $this->fizzString = $fizzString;
        $this->buzzNumber = $buzzNumber;
        $this->buzzString = $buzzString;
    }

    /**
     *Runs the classic FizzBuzz program from $start to $end
     *
     * @param int $start
     * @param int $end
     *
     * @return array
     */
    public function fizzBuzz(int $start = 1, int $end = 100): array
    {
        $result = [];
        foreach (range($start, $end) as $currentNumber) {
            $isFizzy = (0 === $currentNumber % $this->fizzNumber);
            $isBuzzy = (0 === $currentNumber % $this->buzzNumber);
            $parts = [];
            if (!$isFizzy && !$isBuzzy) {
                $parts[] = $currentNumber;
            }
            if ($isFizzy) {
                $parts[] = $this->fizzString;
            }
            if ($isBuzzy) {
                $parts[] = $this->buzzString;
            }
            $result[] = implode(" ", $parts);
        }
        return $result;
    }

}