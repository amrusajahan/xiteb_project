<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Quotation;

class QuotationCreated extends Notification
{
    use Queueable;

    public $quotation;

    /**
     * Create a new notification instance.
     */
    public function __construct(Quotation $quotation)
    {
        $this->quotation = $quotation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $prescription = $this->quotation->prescription;
        $pharmacy = $this->quotation->pharmacy;

        $mail = (new MailMessage)
                    ->subject('New Quotation for your Prescription')
                    ->greeting('Hello ' . ($notifiable->name ?? ''))
                    ->line('A pharmacy has prepared a quotation for your prescription.')
                    ->line('Pharmacy: ' . ($pharmacy->name ?? $pharmacy->email ?? 'Pharmacy'))
                    ->line('Quotation ID: ' . $this->quotation->id)
                    ->line('Prescription ID: ' . $prescription->id)
                    ->line('Status: ' . $this->quotation->status)
                    ->action('View My Quotations', url(route('user.quotations')))
                    ->line('Thank you for using our service.');

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'quotation_id' => $this->quotation->id,
            'prescription_id' => $this->quotation->prescription_id,
            'pharmacy_id' => $this->quotation->pharmacy_id,
            'status' => $this->quotation->status,
        ];
    }
}
