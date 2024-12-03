<?php

namespace App\Listeners;

use App\Events\TransactionOccured;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\TransactionNotification;

class SendTransactionNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TransactionOccured $event): void
    {
        $transaction = $event->transaction;
        $type = $event->type;

        // Get Sender's Account User
        $sender = $transaction->account->user;

        switch ($type) {
            case 'deposit':
                // Send notification to Account Owner
                $senderMessage = "Deposit of {$transaction->amount} Completed Successfully to Your Account {$transaction->account->account_number}. New balance: {$transaction->account->balance}";
                $sender->notify(new TransactionNotification($senderMessage, $sender->phone_number));
                break;

            case 'withdrawal':
                // Send Notification to Account Owner
                $senderMessage = "Withdrawal of {$transaction->amount} Completed Successfully from Your Account {$transaction->account->account_number}. New balance: {$transaction->account->balance}";
                $sender->notify(new TransactionNotification($senderMessage, $sender->phone_number));
                break;

            case 'transfer':
                // Get receiver's Account User
                $receiver = $transaction->destinationAccount->user;

                // Send Notification to Sender
                $senderMessage = "Transfer of {$transaction->amount} Completed Successfully From Your Account {$transaction->account->account_number} to {$transaction->destinationAccount->account_number}. New Balance: {$transaction->account->balance}";
                $sender->notify(new TransactionNotification($senderMessage, $sender->phone_number));

                // Send Notification to Receiver
                $receiverMessage = "You have Received {$transaction->amount} From Account {$transaction->account->account_number}. New Balance: {$transaction->destinationAccount->balance}";
                $receiver->notify(new TransactionNotification($receiverMessage, $receiver->phone_number));
                break;
        }
    }
}
