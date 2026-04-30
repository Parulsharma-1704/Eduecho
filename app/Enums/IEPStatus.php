<?php

namespace App\Enums;

enum IEPStatus: string
{
    case Draft = 'draft';
    case Active = 'active';
    case Completed = 'completed';
}
