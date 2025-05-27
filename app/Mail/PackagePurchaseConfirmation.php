<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PackagePurchaseConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $packageData;

    public function __construct($packageData)
    {
        $this->packageData = $packageData;
    }

    public function build()
    {
        return $this->subject('Bevestiging Pakket Aankoop - KiteSurfschool Windkracht-12')
                    ->view('emails.package-confirmation');
    }
}
