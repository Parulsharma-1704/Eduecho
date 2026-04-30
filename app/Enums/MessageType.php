<?php

namespace App\Enums;

enum MessageType: string
{
    case Text = 'text';
    case Email = 'email';
    case Notification = 'notification';
}
