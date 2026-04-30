<?php

namespace App\Enums;

enum DisabilityType: string
{
    case Visual = 'visual';
    case Hearing = 'hearing';
    case Motor = 'motor';
    case Cognitive = 'cognitive';
    case Multiple = 'multiple';
}
