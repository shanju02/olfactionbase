<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function submit(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $subject = $request->get('subject');
        $message = $request->get('message');

        $to = "bishal.saha@gmail.com, anjusharma.online@gmail.com";

        $message = "
                    <html>
                        <head>
                            <title>Olfaction Contact Form Submitted</title>
                        </head>
                        <body>
                            <p>This email is from olfaction contact us form</p>
                            <p>Name: ".$name."</p>
                            <p>Email: ".$email."</p>
                            <p>Subject: ".$subject."</p>
                            <p>Message: ".$message."</p>
                        </body>
                    </html>
                    ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$email.'>' . "\r\n";
        $headers .= 'Reply-To: '.$email . "\r\n";

        mail($to, $subject, $message, $headers);

        return redirect()->route('contact')->withSuccess('Thanks for contacting us. We will reply you soon.');
    }
}
