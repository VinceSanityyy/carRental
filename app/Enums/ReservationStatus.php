<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ReservationStatus extends Enum
{
    const PENDING =   0;
    const COMPLETED =   1;
    const CANCELLED =   2;
}
