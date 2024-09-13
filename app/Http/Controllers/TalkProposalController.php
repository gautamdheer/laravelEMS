<?php

namespace App\Http\Controllers;

use App\Models\Revision;
use App\Models\TalkProposal;
use Illuminate\Http\Request;

class TalkProposalController extends Controller
{

    public function index(){
        return view('talkproposal.index');
    }

    public function store(Request $request)
    {

         $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'pdf_file' => 'required|file|mimes:pdf|max:10000',
        ]);

        // Handle file upload
        if ($request->hasFile('pdf_file')) {
          $filePath = $request->file('pdf_file')->store('proposals');
        } else {
          return back()->withErrors(['pdf_file' => 'File upload is required.']);
        }

        $talkProposal = TalkProposal::create([
            'speaker_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'tags' => explode(',', $request->tags),
            'file_path' => $filePath,
        ]);

         // Log revision
        Revision::create([
            'user_id' => auth()->user()->id,
            'talk_proposal_id' => $talkProposal->id,
            'changes' => json_encode($talkProposal->toArray()),
            'revision_timestamp' => now(),

        ]);


        return redirect()->route('talkproposal.index');


    }
}
