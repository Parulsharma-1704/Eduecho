<?php

namespace App\Enums;

enum SupportType: string
{
    case TeachingAssistant = 'teaching_assistant';
    case ParaEducator = 'para_educator';
    case Aide = 'aide';
}
