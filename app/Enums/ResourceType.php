<?php

namespace App\Enums;

enum ResourceType: string
{
    case Text = 'text';
    case Audio = 'audio';
    case Video = 'video';
    case PDF = 'pdf';
    case SignLanguage = 'sign_language';
}
