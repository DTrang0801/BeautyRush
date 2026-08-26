<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request): RedirectResponse
    {
        Review::create([
            'user_id' => Auth::id(),
            ...$request->validated(),
        ]);

        return back()->with('status', 'Review added successfully.');
    }

    public function destroy(Review $review): RedirectResponse
    {
        abort_unless($review->user_id === Auth::id(), 403);

        $review->delete();

        return to_route('account')->with('status', 'Review deleted successfully.');
    }
}
