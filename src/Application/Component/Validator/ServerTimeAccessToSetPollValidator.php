<?php

declare(strict_types=1);

namespace Meals\Application\Component\Validator;

use Meals\Application\Component\Validator\Exception\ServerTimeOutOfRangeException;

class ServerTimeAccessToSetPollValidator
{
    public function validate(): void
    {
        $numberOfWeek = idate('w');
        $hours = idate('H');
        $minutes = idate('i');
        $seconds = idate('s');
        if ($numberOfWeek === 1 && $hours >= 6 && ($hours <= 23 && $minutes <= 59 && $seconds <= 59)) {
            throw new ServerTimeOutOfRangeException();
        }
    }
}
