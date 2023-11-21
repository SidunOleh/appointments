<?php

namespace Appointments\Services\Email;

class Email
{
    private string|array $to;

    private string $subject;

    private string $message;

    private string|array $headers = '';

    private string|array $attachments = [];

    public function to( string|array $to ): self
    {
        $this->to = $to;

        return $this;
    }

    public function subject( string $subject ): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function message( string $message ): self
    {
        $this->message = $message;

        return $this;
    }

    public function headers( string|array $headers ): self
    {
        $this->headers = $headers;

        return $this;
    }

    public function attachments( string|array $attachments ): self
    {
        $this->attachments = $attachments;

        return $this;
    }

    public function send(): bool
    {
        $to = $this->to;
        if ( is_array( $to ) ) $to = implode( ',', $to );

        return wp_mail( $to,  $this->subject, $this->message, $this->headers, $this->attachments );
    }
}