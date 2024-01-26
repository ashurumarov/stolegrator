<?php

declare(strict_types=1);

namespace tests\Meals\Functional\Interactor;

use Meals\Application\Component\Validator\Exception\AccessDeniedException;
use Meals\Application\Component\Validator\Exception\PollIsNotActiveException;
use Meals\Application\Feature\Poll\UseCase\EmployeeGetsActivePoll\Interactor;
use Meals\Domain\Dish\Dish;
use Meals\Domain\Dish\DishList;
use Meals\Domain\Employee\Employee;
use Meals\Domain\Menu\Menu;
use Meals\Domain\Poll\Poll;
use Meals\Domain\User\Permission\Permission;
use Meals\Domain\User\Permission\PermissionList;
use Meals\Domain\User\User;
use tests\Meals\Functional\Fake\Provider\FakeEmployeeProvider;
use tests\Meals\Functional\Fake\Provider\FakePollProvider;
use tests\Meals\Functional\Fake\Provider\FakePollResultProvider;
use tests\Meals\Functional\FunctionalTestCase;

class EmployeeSetsActivePollTest extends FunctionalTestCase
{
    public function testSuccessful()
    {
        $this->performTestMethod(
            $this->getEmployeeWithPermissions(),
            $this->getPoll(true),
            $this->getDish()
        );
    }

    public function testUserHasNotPermissions()
    {
        $this->expectException(AccessDeniedException::class);

        $this->performTestMethod(
            $this->getEmployeeWithNoPermissions(),
            $this->getPoll(true),
            $this->getDish()
        );
    }

    public function testPollIsNotActive()
    {
        $this->expectException(PollIsNotActiveException::class);

         $this->performTestMethod(
            $this->getEmployeeWithPermissions(),
            $this->getPoll(false),
            $this->getDish()
        );
    }

    private function performTestMethod(Employee $employee, Poll $poll, Dish $dish): void
    {
        $this->getContainer()->get(FakeEmployeeProvider::class)->setEmployee($employee);
        $this->getContainer()->get(FakePollResultProvider::class)->setPollResult($poll);

        $this->getContainer()->get(Interactor::class)->setActivePoll(
            $poll,
            $employee,
            $dish
        );
    }

    private function getEmployeeWithPermissions(): Employee
    {
        return new Employee(
            1,
            $this->getUserWithPermissions(),
            4,
            'Surname'
        );
    }

    private function getUserWithPermissions(): User
    {
        return new User(
            1,
            new PermissionList(
                [
                    new Permission(Permission::PARTICIPATION_IN_POLLS),
                ]
            ),
        );
    }

    private function getEmployeeWithNoPermissions(): Employee
    {
        return new Employee(
            1,
            $this->getUserWithNoPermissions(),
            4,
            'Surname'
        );
    }

    private function getUserWithNoPermissions(): User
    {
        return new User(
            1,
            new PermissionList([]),
        );
    }

    private function getPoll(bool $active): Poll
    {
        return new Poll(
            1,
            $active,
            new Menu(
                1,
                'title',
                new DishList([$this->getDish()]),
            )
        );
    }

    private function getDish(): Dish
    {
        return new Dish(
            1,
            'Dish title',
            'DishDescription'
        );
    }
}
