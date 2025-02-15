<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendPartnerRequest(Request $request)
    {
        // Validate incoming data
        request()->validate([
            'firmenname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'telefon' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'evcKundennummer' => 'nullable|string|max:255',
            'tuningtools' => 'nullable|string|max:255',
            'message' => 'required|string|max:1000',
        ]);
    
        // Define the email data
        $data = [
            'firmenname' => $request->firmenname,
            'name' => $request->name,
            'adresse' => $request->adresse,
            'telefon' => $request->telefon,
            'email' => $request->email,
            'evcKundennummer' => $request->evcKundennummer,
            'tuningtools' => $request->tuningtools,
            'message' => $request->message,
        ];
    
        // The custom message to be included in the email
        $customMessage = "
        Partner Request:
          Dies ist eine Anfrage von einem Unternehmen oder einer Einzelperson, die daran interessiert ist, ein Partner Ihres Unternehmens zu werden. Der Absender hat seine Kontaktdaten hinterlassen, um eine mögliche Partnerschaft aufzubauen.
        ";
    
        // Raw email content including the custom message and request details
        $emailContent = "Partner Request Details: \n\n" .
                        $customMessage . "\n" .  // Add the custom message
                        'Firmenname: ' . $data['firmenname'] . "\n" .
                        'Name: ' . $data['name'] . "\n" .
                        'Adresse: ' . $data['adresse'] . "\n" .
                        'Telefon: ' . $data['telefon'] . "\n" .
                        'E-Mail: ' . $data['email'] . "\n" .
                        'EVC Kundennummer: ' . $data['evcKundennummer'] . "\n" .
                        'Tuningtools: ' . $data['tuningtools'] . "\n" .
                        'Message: ' . $data['message'];
    
        // Send the raw email (bypassing Blade template)
        try {
            Mail::raw($emailContent, function ($message) {
                $message->to('info@vtec-chiptuning.com')  // Replace with your Gmail address
                        ->subject('Partnerschaftsanfrage von der Website');
            });
    
            // Return a success response
            return response()->json(['message' => 'Partner request sent successfully!'], 200);
        } catch (\Exception $e) {
            // Return an error response if email sending fails
            return response()->json(['message' => 'Failed to send partner request. Please try again later.'], 500);
        }
    }
    
    public function sendContactMessage(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
            'accept' => 'required|accepted',  // Ensure user accepts the privacy policy
        ]);

        // Define the email data
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        // Send the email
        try {
            // Send the email with the updated German subject
            Mail::raw('Kontakt Nachricht von: ' . "\n\n" .
                'Name: ' . $data['name'] . "\n" .
                'Email: ' . $data['email'] . "\n" .
                'Nachricht: ' . $data['message'], function ($message) {
                    $message->to('info@vtec-chiptuning.com')  // Replace with your email address
                            ->subject('Neue Kontaktanfrage von der Website'); // Subject in German
            });

            // Return a success response
            return response()->json(['message' => 'Message sent successfully!'], 200);
        } catch (\Exception $e) {
            // Return an error response if email sending fails
            return response()->json(['message' => 'Failed to send message. Please try again later.'], 500);
        }
    }

    public function sendEmail(Request $request)
    {
        // Define the email data (this will be passed directly)
        $data = [
            'name' => "Walid",
            'email' => "info@vtec-chiptuning.com",
            'message' => "The first test",
        ];

        // Send the email
        try {
            Mail::raw('Name: ' . $data['name'] . "\nEmail: " . $data['email'] . "\nMessage: " . $data['message'], function ($message) {
                $message->to('info@vtec-chiptuning.com', 'VTEC Chiptuning')  // Replace with your Gmail address
                    ->subject('New message from website');
            });

            // Return a success response
            return response()->json(['message' => 'Email sent successfully!'], 200);
        } catch (\Exception $e) {
            // Return an error response if email sending fails
            return response()->json(['message' => 'Failed to send email. Please try again later.'], 500);
        }
    }
}
