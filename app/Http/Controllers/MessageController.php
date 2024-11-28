<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\UserMessageMail;
use Illuminate\Support\Facades\Mail;





class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Validate incoming request


        // Prepare the data to be sent
        $messageData = [
            'name' => 'Your Name', // Hardcoded name
            'email' => 'walidvl5546@gmail.com', // Hardcoded email
            'message' => 'This is a test message.', // Hardcoded message
        ];

        // Send the email
        Mail::to('admin@yourdomain.com')->send(new UserMessageMail($messageData));

        return response()->json(['message' => 'Email sent successfully!']);
    }
}
