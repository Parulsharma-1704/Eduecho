<?php

namespace App\Enums;

enum TherapyType: string
{
    case Physical = 'physical';
    case Occupational = 'occupational';
    case Speech = 'speech';
    case Behavioral = 'behavioral';
}
