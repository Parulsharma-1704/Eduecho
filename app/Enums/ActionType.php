<?php

namespace App\Enums;

enum ActionType: string
{
    case Created = 'created';
    case Updated = 'updated';
    case Deleted = 'deleted';
    case Accessed = 'accessed';
    case Downloaded = 'downloaded';
    case Exported = 'exported';
}
