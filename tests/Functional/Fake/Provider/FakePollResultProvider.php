<?php

declare(strict_types=1);

namespace tests\Meals\Functional\Fake\Provider;

use Meals\Application\Component\Provider\PollResultProviderInterface;
use Meals\Domain\Dish\Dish;
use Meals\Domain\Employee\Employee;
use Meals\Domain\Poll\Poll;
use Meals\Domain\Poll\PollResult;

class FakePollResultProvider implements PollResultProviderInterface
{

    private PollResult $pollResult;

    public function setPollResult(int $pollId, Poll $poll, Employee $employee, Dish $dish, int $employeeFloor): void
    {
        $this->pollResult = new PollResult($pollId, $poll, $employee, $dish, $employeeFloor);
    }

    public function getPollResult(int $pollResultId): PollResult
    {
        return $this->pollResult;
    }
}
