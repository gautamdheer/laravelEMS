<?php

namespace App\Models;

use App\Models\Review;
use App\Models\TalkProposal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['reviewer_id', 'talk_proposal_id', 'comments', 'rating'];

    public function talkProposal()
    {
        return $this->belongsTo(TalkProposal::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(Review::class);
    }



}
