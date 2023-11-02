<?php

namespace App\Enums;

enum StatusDish: string
{
    case Waiting = "Waiting";
    case Preparing = "Preparing";
    case Completed = "Completed";
}
