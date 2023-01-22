<?php

declare(strict_types=1);

namespace Meals\Application\Feature\Poll\UseCase\EmployeeSetsActivePoll;

use Meals\Application\Component\Provider\PollResultProviderInterface;
use Meals\Application\Component\Validator\PollIsActiveValidator;
use Meals\Application\Component\Validator\ServerTimeAccessToSetPollValidator;
use Meals\Application\Component\Validator\UserHasAccessToSetPollValidator;
use Meals\Domain\Dish\Dish;
use Meals\Domain\Employee\Employee;
use Meals\Domain\Poll\Poll;

class Interactor
{
    public function __construct(
        private PollResultProviderInterface $pollResultProvider,
        private UserHasAccessToSetPollValidator $userHasAccessToSetPollValidator,
        private ServerTimeAccessToSetPollValidator $serverTimeAccessToSetPollValidator,
        private PollIsActiveValidator $pollIsActiveValidator
    ) {}

    public function setActivePoll(Poll $poll, Employee $employee, Dish $chosenDish): void
    {
        $this->userHasAccessToSetPollValidator->validate($employee->getUser());
        $this->serverTimeAccessToSetPollValidator->validate();
        $this->pollIsActiveValidator->validate($poll);

        $dishes = $poll->getMenu()->getDishes();
        foreach ($dishes as $dish) {
            if (!$dishes->hasDish($chosenDish)) {
                continue;
            }

            $this->pollResultProvider->setPollResult(
                $poll->getId(),
                $poll,
                $employee,
                $dish,
                $employee->getFloor()
            );
        }
    }
}
