<?php

namespace App\Mail;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicantAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public JobApplication $application,
        public string $subjectLine,
        public string $bodyMessage,
        public string $startDate,
        public string $startTime,
        public string $workplace,
        public ?string $notes = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->subjectLine);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.applicant-accepted',
            with: [
                'application' => $this->application,
                'bodyMessage' => $this->bodyMessage,
                'startDate'   => $this->startDate,
                'startTime'   => $this->startTime,
                'workplace'   => $this->workplace,
                'notes'       => $this->notes,
            ],
        );
    }
}