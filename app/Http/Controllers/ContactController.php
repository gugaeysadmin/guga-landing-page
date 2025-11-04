<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Mail\ServiceContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Log;
class ContactController extends Controller
{
    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'company' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'comments' => 'required|string',
        ]);

        // Enviar el correo
        Mail::to('ventas1@gugaequiposyservicios.com.mx')->cc('info@gugaequiposyservicios.com.mx')->send(new ContactFormMail($validated));

        return back()->with('success', '¡Gracias por contactarnos! Hemos recibido tu mensaje.');
    }
    public function specificServiceContact(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'company' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'comments' => 'required|string',
        ]);

        // Enviar el correo
        Mail::to('ventas1@gugaequiposyservicios.com.mx')->cc('info@gugaequiposyservicios.com.mx')->send(new ContactFormMail($validated));

        return back()->with('success', '¡Gracias por contactarnos! Hemos recibido tu mensaje.');
    }

        public function sendServiceContact(Request $request)
    {
        Log::info($request);
        $validated = $request->validate([
            'service' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'company' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'comments' => 'required|string',
        ]);

        Log::info($validated);

        // Enviar el correo
        Mail::to('ventas1@gugaequiposyservicios.com.mx')->cc('info@gugaequiposyservicios.com.mx')->send(new ServiceContactFormMail($validated));

        return back()->with('success', '¡Gracias por contactarnos! Hemos recibido tu mensaje.');
    }



}
