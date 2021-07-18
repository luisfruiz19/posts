<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public const FOLDER = 'file';

    protected $fillable = [
        'path',
        'mime_type',
        'comment_id',
    ];

    protected $appends = ['url'];

    public function comment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route('show.file',['id'=>$this->id]);
    }
}
