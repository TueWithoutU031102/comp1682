<?php

namespace App\Enums;

enum Role: string
{
    case Manager = "Manager";
    case Staff = "Staff";
    case Admin = "Admin";
}
