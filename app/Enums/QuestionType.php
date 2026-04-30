<?php

namespace App\Enums;

enum QuestionType: string
{
    case MCQ = 'mcq';
    case ShortAnswer = 'short_answer';
    case Essay = 'essay';
    case TrueFalse = 'true_false';
}
