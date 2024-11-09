<?php

namespace App\Enums;

enum OrderStatus: int
{
    case PENDING = 1;
    case ACCEPTED = 2;
    case REJECTED = 3;
    case DELIVERED = 4;
    case CANCELED = 5;
}
