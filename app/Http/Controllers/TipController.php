<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipRequest;
use App\Models\Tip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TipController extends Controller
{
    public function index(): View
    {
        $tipsQuery = Tip::with('user')->latest();

        if (Auth::check()) {
            $tipsQuery->where('user_id', '!=', Auth::id());
        }

        $tips = $tipsQuery->get()->map(fn (Tip $tip): object => (object) [
            'key' => 'tip-'.$tip->id,
            'profile_id' => $tip->user_id,
            'title' => $tip->title,
            'content' => $tip->content,
            'author' => $tip->user->name,
        ]);

        if ($tips->isEmpty()) {
            $tips = collect([
                (object) [
                    'title' => 'Keep your base fresh',
                    'content' => 'Apply foundation in thin layers and let each layer settle before adding more.',
                    'author' => 'Beauty Rush community',
                    'profile_id' => null,
                    'key' => 'featured-keep-your-base-fresh',
                ],
                (object) [
                    'title' => 'Make blush last longer',
                    'content' => 'Tap a little cream blush underneath powder blush for a soft, lasting flush.',
                    'author' => 'Beauty Rush community',
                    'profile_id' => null,
                    'key' => 'featured-make-blush-last-longer',
                ],
                (object) [
                    'title' => 'Blend concealer naturally',
                    'content' => 'Use a small amount and tap the edges with your ring finger for a seamless finish.',
                    'author' => 'Beauty Rush community',
                    'profile_id' => null,
                    'key' => 'featured-blend-concealer-naturally',
                ],
            ]);
        }

        return view('tips', [
            'tips' => $tips,
            'favoriteTips' => session('favorite_tips', []),
        ]);
    }

    public function toggleFavorite(Request $request): RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->guest(route('login'))->with('status', 'Please log in to save a tip.');
        }

        $validated = $request->validate([
            'tip_key' => ['required', 'string', 'max:255'],
        ]);
        $favorites = $request->session()->get('favorite_tips', []);

        if (in_array($validated['tip_key'], $favorites, true)) {
            $favorites = array_values(array_diff($favorites, [$validated['tip_key']]));
        } else {
            $favorites[] = $validated['tip_key'];
        }

        $request->session()->put('favorite_tips', $favorites);

        return back();
    }

    public function store(StoreTipRequest $request): RedirectResponse
    {
        Tip::create([
            'user_id' => Auth::id(),
            'title' => $request->validated('title'),
            'content' => $request->validated('content'),
        ]);

        return to_route('account')->with('status', 'Tip added successfully.');
    }

    public function update(StoreTipRequest $request, Tip $tip): RedirectResponse
    {
        abort_unless($tip->user_id === Auth::id(), 403);

        $tip->update([
            'title' => $request->validated('title'),
            'content' => $request->validated('content'),
        ]);

        return to_route('account')->with('status', 'Tip updated successfully.');
    }

    public function destroy(Tip $tip): RedirectResponse
    {
        abort_unless($tip->user_id === Auth::id(), 403);

        $tip->delete();

        return to_route('account')->with('status', 'Tip deleted successfully.');
    }
}
