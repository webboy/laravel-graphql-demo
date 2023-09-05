<?php

namespace App\Enums;

enum TodoStatus: int
{
    case PENDING = 0;

    case COMPLETED = 1;

    case ABORTED = 2;
}
