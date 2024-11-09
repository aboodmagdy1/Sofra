<?php

namespace App\Enums;

enum OrderStatus: int
{
    case Pending = 0;
    case Accepted = 1;
    case Rejected = 2;
    case Delivered = 3;
    case Canceled = 4;
}
