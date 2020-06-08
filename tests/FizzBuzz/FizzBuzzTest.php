<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use FizzBuzz\FizzBuzz;

final class FizzBuzzTest extends TestCase
{
    /**
     * @param array $params
     * @param int $start
     * @param int $end
     * @param array $expected
     *
     * @dataProvider fizzBuzzTestCaseProvider
     */
    public function testTrue(array $params, int $start, int $end, array $expected): void
    {
        $fizzBuzz = new FizzBuzz(
            $params['fizzNumber'],
            $params['fizzString'],
            $params['buzzNumber'],
            $params['buzzString']
        );
        $fizzBuzzResult = $fizzBuzz->fizzBuzz($start, $end);
        $this->assertIsArray($fizzBuzzResult);
        $this->assertEquals(count($fizzBuzzResult), count($expected));
        foreach ($expected as $key => $expectedValue) {
            $this->assertEquals($expectedValue, $fizzBuzzResult[$key]);
        }
    }

    // TODO: can always add more test cases
    public function fizzBuzzTestCaseProvider(): array
    {
        return [
            'test classic FizzBuzz' => [
                'params' => [
                    'fizzNumber' => 3,
                    'fizzString' => 'Fizz',
                    'buzzNumber' => 5,
                    'buzzString'=> 'Buzz',
                ],
                'start' => 1,
                'end' => 20,
                'expected' => [
                    1, 2, 'Fizz', 4, 'Buzz', 'Fizz', 7, 8, 'Fizz', 'Buzz', 11, 'Fizz', 13, 14, 'Fizz Buzz', 16, 17, 'Fizz', 19, 'Buzz'
                ]
            ],
            'test backwards' => [
                'params' => [
                    'fizzNumber' => 3,
                    'fizzString' => 'Fizz',
                    'buzzNumber' => 5,
                    'buzzString'=> 'Buzz',
                ],
                'start' => 20,
                'end' => 1,
                'expected' => [
                    'Buzz', 19, 'Fizz', 17, 16, 'Fizz Buzz', 14, 13, 'Fizz', 11, 'Buzz', 'Fizz', 8, 7, 'Fizz', 'Buzz', 4, 'Fizz', 2, 1
                ]
            ],
            'test no range fizz buzzy' => [
                'params' => [
                    'fizzNumber' => 3,
                    'fizzString' => 'Fizz',
                    'buzzNumber' => 5,
                    'buzzString'=> 'Buzz',
                ],
                'start' => 15,
                'end' => 15,
                'expected' => [
                    'Fizz Buzz'
                ]
            ],
            'test no range non-fizzy-buzzy' => [
                'params' => [
                    'fizzNumber' => 3,
                    'fizzString' => 'Fizz',
                    'buzzNumber' => 5,
                    'buzzString'=> 'Buzz',
                ],
                'start' => 11,
                'end' => 11,
                'expected' => [
                    11
                ]
            ],
        ];
    }
}