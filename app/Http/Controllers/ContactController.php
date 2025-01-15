<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('emails.contact');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Aquí puedes enviar el correo electrónico o guardar los datos en la base de datos
        Mail::send('emails.contact', [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ], function($mail) use ($request) {
            $mail->from($request->email, $request->name);
            $mail->to('tu-email@dominio.com')->subject('Formulario de Contacto');
        });

        return redirect()->route('contact.show')->with('success', 'Mensaje enviado correctamente');
    }
}
