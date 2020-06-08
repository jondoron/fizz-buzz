<?php

namespace FizzBuzz;

use phpDocumentor\Reflection\DocBlock\Tags\Param;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FizzBuzzCommand extends Command
{
    protected static $defaultName = 'fizz-buzz';

    /**
     * @var OutputInterface
     */
    private OutputInterface $outputInterface;

    /**
     * @var InputInterface
     */
    private InputInterface $inputInterface;

    /**
     * Documentation for configuring Symfony console commands can be found at: https://symfony.com/doc/master/console.html
     * Documentation that specifically covers command arguments and options: https://symfony.com/doc/master/console/input.html
     */
    protected function configure()
    {
        $this->setDescription('A customizable fizz-buzz program');
        $this
            ->addArgument('start-value', InputArgument::REQUIRED, 'Which number should we start counting from?')
            ->addArgument('end-value', InputArgument::REQUIRED, 'Which number should we stop at?')
            ->addOption('fizz-number', null, InputOption::VALUE_OPTIONAL, 'When current number is multiple of this number, will output `fizz-string`', 3)
            ->addOption('fizz-string', null, InputOption::VALUE_OPTIONAL, 'When current number is multiple of this `fizz-number`, will output this value', 'Research')
            ->addOption('buzz-number', null, InputOption::VALUE_OPTIONAL, 'When current number is multiple of this number, will output `buzz-string`', 5)
            ->addOption('buzz-string', null, InputOption::VALUE_OPTIONAL, 'When current number is multiple of this `buzz-number`, will output this value', 'Square')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * Let's just do some very basic input validation. Things get pretty wonky with modular division and negative numbers
         * so lets just make sure our numeric inputs are positive integers.
         *
         * In a production app we'd want to use something like the Symfony Validator and have
         * the logic contained in its own testable class.
         * https://symfony.com/doc/current/components/validator.html
         */
        $startValue = $input->getArgument('start-value');
        $endValue = $input->getArgument('end-value');
        $fizzNumber = $input->getOption('fizz-number');
        $buzzNumber = $input->getOption('buzz-number');
        if (
            !$this->isNonNegativeIntegerValue($startValue) ||
            !$this->isNonNegativeIntegerValue($endValue) ||
            !$this->isNonNegativeIntegerValue($fizzNumber) ||
            !$this->isNonNegativeIntegerValue($buzzNumber)
        ) {
            $output->writeln('Please ensure all numeric values provided are integers and greater than 0');
            return Command::FAILURE;
        }

        /**
         * Since we're using php 7.4 and typed properties on the FizzBuzz class, let's catch TypeError's in case
         * any validation problems fell through the cracks
         */
        try {
            $fizzBuzz = new FizzBuzz(
                $fizzNumber,
                $input->getOption('fizz-string'),
                $buzzNumber,
                $input->getOption('buzz-string'),
            );
        } catch (\TypeError $error) {
            $output->writeln('Something unexpected went wrong... Please double check your input.');
            return Command::FAILURE;
        }

        $fizzBuzzResults = $fizzBuzz->fizzBuzz($startValue, $endValue);
        foreach ($fizzBuzzResults as $result) {
            $output->writeln($result);
        }

        return Command::SUCCESS;
    }

    /**
     * Checks if $value is an integer and non-negative
     *
     * @param mixed $value
     *
     * @return bool
     */
    private function isNonNegativeIntegerValue($value): bool
    {
        return (bool) preg_match('/^\d+$/', $value) && (int) $value >= 0;
    }
}