<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FailedJob extends Model
{
    protected $table = 'failed_jobs';

    public $timestamps = false;

    protected $casts = [
        'failed_at' => 'datetime',
    ];

    public function getDisplayNameAttribute(): ?string
    {
        $payload = $this->payload ? json_decode($this->payload, true) : null;

        return is_array($payload) ? ($payload['displayName'] ?? null) : null;
    }

    public function getExceptionMessageAttribute(): string
    {
        $exception = (string) $this->exception;
        $line = strtok($exception, "\n");

        return $line === false ? '' : $line;
    }
}
