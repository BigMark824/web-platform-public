<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use GooberBlox\Account\Enums\AccountStatusEnum;
use GooberBlox\Account\Models\AccountStatus;

use Illuminate\Auth\Events\Verified;
class SetAccountStatusOnEmailVerified 
{

    /**
     * Handle the event.
     */
    public function handle(Verified $event): void
    {
        /** @var \GooberBlox\Account\Models\Account $account */
        $account = $event->user; 
        $accountStatus = $account->accountStatus;

        $accountStatus = $event->user->accountStatus()->first();
        if ($accountStatus) {
            $accountStatus->value = AccountStatusEnum::OK;
            $accountStatus->save();
        }
    }
}
