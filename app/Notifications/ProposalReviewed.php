<?php

namespace App\Notifications;

use App\Models\TalkProposal;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProposalReviewed extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(TalkProposal $proposal)
    {
        //
        $this->proposal = $proposal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('Your Talk Proposal has been Reviewed')
                ->greeting('Hello ' . $this->proposal->speaker->name . ',')
                ->line('Your talk proposal titled "' . $this->proposal->title . '" has been reviewed.')
                ->line('You can check the status and feedback on your proposal by logging into the dashboard.')
                ->action('View Proposal', url('/proposals/' . $this->proposal->id))
                ->line('Thank you for your submission and we look forward to your presentation.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'proposal_id' => $this->proposal->id,
            'title' => $this->proposal->title,
            'status' => $this->proposal->status,
        ];
    }
}
