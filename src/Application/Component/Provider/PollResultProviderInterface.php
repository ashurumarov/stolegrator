<?php

declare(strict_types=1);

namespace Meals\Application\Component\Provider;

use Meals\Domain\Dish\Dish;
use Meals\Domain\Employee\Employee;
use Meals\Domain\Poll\Poll;
use Meals\Domain\Poll\PollList;
use Meals\Domain\Poll\PollResult;

interface PollResultProviderInterface
{
    public function setPollResult(int $pollId, Poll $poll, Employee $employee, Dish $dish, int $employeeFloor): void;

    public function getPollResult(int $pollResultId): PollResult;
}
