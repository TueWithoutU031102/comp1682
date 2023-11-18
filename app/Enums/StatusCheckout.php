<?php

namespace App\Enums;

enum StatusCheckout: string
{
    case Pending = "Pending";
    case Cash = "Cash";
    case Transfer = "Transfer";
    case Canceled = "Cancel";
}
