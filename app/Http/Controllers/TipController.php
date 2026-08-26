<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipRequest;
use App\Models\Tip;
use Illuminate\Http\RedirectResponse;
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
                ],
                (object) [
                    'title' => 'Make blush last longer',
                    'content' => 'Tap a little cream blush underneath powder blush for a soft, lasting flush.',
                    'author' => 'Beauty Rush community',
                ],
                (object) [
                    'title' => 'Blend concealer naturally',
                    'content' => 'Use a small amount and tap the edges with your ring finger for a seamless finish.',
                    'author' => 'Beauty Rush community',
                ],
            ]);
        }

        return view('tips', compact('tips'));
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
