<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Email extends Model
{
    protected $fillable = [
        'from_address',
        'to_address',
        'cc_address',
        'subject',
        'body',
        'type',
        'ip_address',
        'user_agent',
    ];
    protected static function booted(): void
    {
        static::creating(function (Email $email) {
            $email->uuid = Str::uuid();
        });
    }
}
