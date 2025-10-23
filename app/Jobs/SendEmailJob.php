<?php

namespace App\Jobs;

use App\Models\Email;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\PHPMailer;

class SendEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Email $email)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(PHPMailer $mail): void
    {

        try {
            $mail->setFrom($this->email->from_address);
            $mail->addAddress($this->email->to_address);
            if ($this->email->cc_address) {
                $mail->addCC($this->email->cc_address);
            }

            $mail->isHTML($this->email->body_type === 'html');
            $mail->Subject = $this->email->subject;
            $mail->Body    = $this->email->body;
            if ($this->email->body_type === 'text') {
                $mail->AltBody = $this->email->body;
            }

            $mail->send();

        } catch (Exception $e) {
            Log::error("PHPMailer Error: {$mail->ErrorInfo}", ['email_id' => $this->email->id]);
        }
    }
}
