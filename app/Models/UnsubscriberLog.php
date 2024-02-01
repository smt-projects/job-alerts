<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnsubscriberLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscriber_id', 'unsubscribed_for', 'notify'
    ];
}
