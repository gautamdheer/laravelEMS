<?php

use App\Models\Review;
use App\Models\TalkProposal;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TalkProposalController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('talkproposal',[TalkProposalController::class, 'index'])->name('talkproposal.index');
Route::post('talkproposal',[TalkProposalController::class, 'store'])->name('talkproposal.store');

// Review
Route::get('review',[ReviewController::class, 'index'])->name('review.index');
Route::post('review',[ReviewController::class, 'store'])->name('review.store');


// fetch all reviews
Route::get('/api/reviewers', function() {
    return Review::all();
});
// fetch single review
Route::get('/api/talk_proposals/{id}/reviews', function($id) {
    return TalkProposal::find($id)->reviews;
});

Route::get('/api/statistics', function() {
    $stats = [
        'total_proposals' => TalkProposal::count(),
        'average_rating' => Review::avg('rating'),
        'proposals_per_tag' => TalkProposal::select('tags', DB::raw('count(*) as total'))->groupBy('tags')->get()
    ];
    return $stats;
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
