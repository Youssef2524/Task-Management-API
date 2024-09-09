<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'my_tasks';
    protected $fillable = ['title', 'description', 'priority', 'due_date', 'status', 'assigned_to'];
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'task_id';
public $incrementing = true;
    public $timestamps = true;

    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'updated_on';
    
    protected $casts = [
        'created_on' => 'datetime',
        'updated_on' => 'datetime',
        'due_date' => 'datetime',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function scopePriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }


    
    public function getDueDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y H:i') : null;
    }


    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = $value ? Carbon::createFromFormat('d-m-Y H:i', $value)->format('Y-m-d H:i:s') : null;
    }

}
