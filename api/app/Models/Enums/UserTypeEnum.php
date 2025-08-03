<?php

namespace App\Models\Enums;

enum UserTypeEnum : string
{
    case Admin = 'admin';
    case Customer = 'customer';
}