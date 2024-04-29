<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveBalance extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function leaveType($id)
    {
        return LeaveType::findOrFail($id);
    }
}
