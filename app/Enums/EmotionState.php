<?php

namespace App\Enums;

enum EmotionState: string
{
    case Happy = 'happy';
    case Frustrated = 'frustrated';
    case Distracted = 'distracted';
    case Focused = 'focused';
    case Anxious = 'anxious';
}
