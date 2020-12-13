<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CarStatus extends Enum
{
    const OCCUPIED =    1;
    const AVAILABLE =   0;
    const MAINTENANCE = 2;
}
