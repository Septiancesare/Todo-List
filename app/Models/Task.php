<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'tag_id', 'deadline'];

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
