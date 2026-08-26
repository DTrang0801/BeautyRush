<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipRequest;
use App\Models\Tip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TipController extends Controller
{
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
}
