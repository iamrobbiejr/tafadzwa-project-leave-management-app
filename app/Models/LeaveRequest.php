<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function employee($id)
    {
        return Employee::findOrFail($id);
    }

    public function leaveType($id)
    {
        return LeaveType::findOrFail($id);
    }
}
