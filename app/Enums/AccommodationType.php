<?php

namespace App\Enums;

enum AccommodationType: string
{
    case ExtraTime = 'extra_time';
    case BreakTime = 'break_time';
    case AssistiveTech = 'assistive_tech';
    case TextToSpeech = 'text_to_speech';
    case ScreenReader = 'screen_reader';
    case LargeFont = 'large_font';
    case HighContrast = 'high_contrast';
    case Scribe = 'scribe';
}
