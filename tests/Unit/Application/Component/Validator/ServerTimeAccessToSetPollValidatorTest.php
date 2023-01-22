<?php

declare(strict_types=1);

namespace tests\Meals\Unit\Application\Component\Validator;

use Meals\Application\Component\Validator\Exception\ServerTimeOutOfRangeException;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class ServerTimeAccessToSetPollValidatorTest extends TestCase
{
    use ProphecyTrait;

    public function testSuccessful()
    {
        $validator = new ServerTimeAccessToSetPollValidatorTest();
        verify($validator->validate())->null();
    }

    public function testFail()
    {
        $this->expectException(ServerTimeOutOfRangeException::class);

        $validator = new ServerTimeAccessToSetPollValidatorTest();
        $validator->validate();
    }
}
