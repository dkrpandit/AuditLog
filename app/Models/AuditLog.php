<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'event',
        'auditable_id',
        'auditable_type',
        'user_id',
        'old_values',
        'new_values',
        'url',
        'ip_address',
        'user_agent',
    ];

    public function auditable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}