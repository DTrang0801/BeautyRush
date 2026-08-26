<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function destroy(Review $review): RedirectResponse
    {
        abort_unless($review->user_id === Auth::id(), 403);

        $review->delete();

        return to_route('account')->with('status', 'Review deleted successfully.');
    }
}
