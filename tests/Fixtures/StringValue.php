<?php

declare(strict_types=1);

namespace Tests\Fixtures;

enum StringValue: string
{
    case VALUE_ONE_SIZE = 'ONE SIZE';

    case VALUE_XXS = 'XXS';

    case VALUE_2 = '2';

    case VALUE_M = 'M';

    case VALUE_XL_2XL = 'XL/2XL';

    case VALUE_80B = '80B';

    case VALUE_70B = '70B';

    case VALUE_44_46 = '44-46';

    case VALUE_SOME = 'some';

    case VALUE_1 = '1';

    case VALUE_30 = '30';

    case VALUE_XXS_XS = 'XXS/XS';

    case VALUE_52_56 = '52-56';

    case VALUE_21 = '21';

    case VALUE_3 = '3';

    case VALUE_41_38_15 = '41х38х15 см';

    case VALUE_39_38_15 = '39х38х15 см';
}
