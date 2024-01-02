<?php

namespace App\Enums;

enum PollStatus: string 
{
    case STARTED = 'Started';
    case PENDING = 'PENDING';
    case FINISHED = 'FINISHED';
}
