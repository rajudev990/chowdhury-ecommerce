<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Verified;
use App\Models\ReferralIncome;

class AddReferralIncome
{
    public function handle(Verified $event): void
    {
        $user = $event->user;

        if ($user->referrer_id && !ReferralIncome::where('referred_user_id', $user->id)->exists()) {
            ReferralIncome::create([
                'user_id' => $user->referrer_id,
                'referred_user_id' => $user->id,
                'amount' => 50.00,
            ]);
        }
    }
}
