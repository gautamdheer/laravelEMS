<?php

namespace App\Models;

use App\Models\Review;
use App\Models\Speaker;
use App\Models\Revision;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TalkProposal extends Model
{
    use HasFactory;

    protected $fillable = ['speaker_id', 'title', 'description', 'tags', 'file_path'];

    protected $casts = [
        'tags'=>'array'
    ];

    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

    public function reviews(): BelongsTo
    {
        return $this->hasMany(Review::class);
    }

    public function revisions()
    {
        return $this->hasMany(Revision::class);
    }
}
