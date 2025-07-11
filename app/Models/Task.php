<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\AuditLog;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'status'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($task) {
            self::logAudit('created', $task, null, $task->getAttributes());
        });

        static::updated(function ($task) {
            $original = $task->getOriginal();
            $changes = $task->getChanges();
            unset($changes['updated_at']);
            if (!empty($changes)) {
                self::logAudit('updated', $task, $original, $changes);
            }
        });

        static::deleted(function ($task) {
            self::logAudit('deleted', $task, $task->getAttributes(), null);
        });
    }

    protected static function logAudit($event, $task, $oldValues, $newValues)
    {
        AuditLog::create([
            'event' => $event,
            'auditable_id' => $task->id,
            'auditable_type' => Task::class,
            'user_id' => Auth::id(),
            'old_values' => $oldValues ? json_encode($oldValues) : null,
            'new_values' => $newValues ? json_encode($newValues) : null,
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}