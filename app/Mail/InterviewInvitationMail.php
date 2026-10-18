<?php

namespace App\Mail;

use App\Models\JobApplication;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InterviewInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public JobApplication $application;

    public function __construct(JobApplication $application)
    {
        $this->application = $application;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                config('mail.from.address', 'hrd@bachri.co.id'),
                'PT Bachri Samudera Indonesia'
            ),
            subject: 'Undangan Interview & Tes - PT Bachri Samudera Indonesia',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.interview-invitation',
            with: [
                'nama'    => $this->application->nama,
                'posisi'  => $this->application->vacancy->title ?? '-',
                'email'   => $this->application->email,

                // Data jadwal interview
                'tanggal' => $this->application->interview_date
                    ? $this->application->interview_date->translatedFormat('l, d F Y')
                    : '-',

                'waktu'   => $this->application->interview_time
                    ? Carbon::parse($this->application->interview_time)->format('H:i') . ' WIB'
                    : '-',

                'lokasi'  => $this->application->interview_location ?? '-',
                'catatan' => $this->application->interview_note,
            ],
        );
    }
}