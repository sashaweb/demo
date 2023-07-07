<?php

namespace App\Enum;

enum Status : int
{
    case EmailNotConfirmed = 1;
    case PendingModeration = 2;
    case PendingPayment = 3;
    case Added = 4;
}