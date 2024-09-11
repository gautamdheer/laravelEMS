<?php

namespace App\Models;

use App\Models\User;
use App\Models\TalkProposal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Revision extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'talk_proposal_id', 'changes', 'timestamp'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function talkProposal()
    {
        return $this->belongsTo(TalkProposal::class);
    }
}
