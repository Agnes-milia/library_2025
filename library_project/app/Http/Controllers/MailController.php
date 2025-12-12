<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;


class MailController extends Controller
{
    public function index(){
        $mailData = [
            "title" => "Szülinapi köszöntő",
            "body" => "https://lufizda.hu/shop_ordered/90728/pic/szulinap.jpg"
        ];

        Mail::to('taknyoskolibri@gmail.com')
        /* ->cc($moreUsers)
                ->bcc($evenMoreUsers) */
        ->send(new DemoMail($mailData));
       dd("Email küldése sikeres.");

    }
}
