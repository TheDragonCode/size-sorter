<?php

declare(strict_types=1);

namespace Tests\Fixtures\Enums;

enum StringEnum: string
{
    case ValueOneSize  = 'ONE SIZE';
    case ValueXxs      = 'XXS';
    case Value2        = '2';
    case ValueM        = 'M';
    case ValueXl_2xl   = 'XL/2XL';
    case Value80b      = '80B';
    case Value70b      = '70B';
    case Value44_46    = '44-46';
    case ValueSome     = 'some';
    case Value1        = '1';
    case Value30       = '30';
    case ValueXxs_Xs   = 'XXS/XS';
    case Value52_56    = '52-56';
    case Value21       = '21';
    case Value3        = '3';
    case Value41_38_15 = '41х38х15 см';
    case Value39_38_15 = '39х38х15 см';
}
