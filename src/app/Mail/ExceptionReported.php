<?php

namespace ikdev\ikpanel\app\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class ExceptionReported extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $error;
    protected $users;
    
    /**
     * Create a new message instance.
     *
     * @param $error
     * @param $users
     */
    public function __construct($error, $users)
    {
        $this->error = $error;
        $this->users = $users;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $this->to($this->users);
        
        return $this->from(Config::get('mail.from.address'))
            ->view('ikpanel::emails.exceptions.exception-reported')
            ->with(['error' => $this->error]);
    }
}
