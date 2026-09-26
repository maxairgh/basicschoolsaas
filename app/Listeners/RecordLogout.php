<?php

namespace App\Listeners;

use App\Models\LoginHistory;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;

class RecordLogout
{
    public function __construct(
        protected Request $request
    ) {}

    public function handle(Logout $event): void
    {
        if (! $event->user) {
            return;
        }

        $history = LoginHistory::query()
            ->where('user_id', $event->user->id)
            ->where('session_id', $this->request->session()->getId())
            ->whereNull('logout_at')
            ->latest('login_at')
            ->first();

        if ($history) {
            $history->update([
                'logout_at' => now(),
            ]);
        }
    }
}