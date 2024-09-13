<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\TalkProposal;
use Illuminate\Http\Request;
use App\Notifications\ProposalReviewed;
use Illuminate\Support\Facades\Notification;

class ReviewController extends Controller
{
    public function index()
    {
        $proposals = TalkProposal::with('speaker')->get();
         return view('review.index', compact('proposals'));
    }

        public function store(Request $request)
        {
        $request->validate([
            'comments' => 'required',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        Review::create([
            'reviewer_id' => auth()->user()->id,
            'talk_proposal_id' => $request->talk_proposal_id,
            'comments' => $request->comments,
            'rating' => $request->rating
        ]);

        // Update status of proposal based on reviews
        $proposal = TalkProposal::find($request->talk_proposal_id);
        $proposal->status = 'Reviewed';
        $proposal->save();

        // Send notification to the speaker
        Notification::send($proposal->speaker, new ProposalReviewed($proposal));

        return redirect()->route('review.index');
        }

}
