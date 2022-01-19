<?php

namespace App\Jobs;

use App\Mail\UserMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user, $data;

    public function __construct($email, $data)
    {
        $this->email = $email;
        $this->data = $data;
    }

    public function handle()
    {
        Mail::to($this->email)->send(new UserMail($this->data));
    }
}
