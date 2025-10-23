<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuoteRequestMail;

class QuoteController extends Controller
{
    /**
     * Afficher le formulaire de demande de devis
     */
    public function create()
    {
        return view('quote.create');
    }

    /**
     * Traiter la demande de devis
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'service_type' => 'required|string',
            'description' => 'required|string|min:10',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120'
        ], [
            'name.required' => 'Le nom est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'L\'email doit être valide',
            'phone.required' => 'Le numéro de téléphone est obligatoire',
            'service_type.required' => 'Le type de service est obligatoire',
            'description.required' => 'La description est obligatoire',
            'description.min' => 'La description doit contenir au moins 10 caractères',
            'attachment.mimes' => 'Le fichier doit être au format JPG, PNG ou PDF',
            'attachment.max' => 'Le fichier ne doit pas dépasser 5 Mo'
        ]);

        // Gérer le fichier uploadé si présent
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('quote-attachments', 'public');
        }

        // Préparer les données
        $quoteData = array_merge($validated, [
            'attachment_path' => $attachmentPath,
            'submitted_at' => now()
        ]);

        // Envoyer l'email (optionnel)
        try {
            // Mail::to('votre-email@example.com')->send(new QuoteRequestMail($quoteData));
        } catch (\Exception $e) {
            // Log l'erreur mais ne bloque pas le processus
            \Log::error('Erreur envoi email devis: ' . $e->getMessage());
        }

        // Rediriger avec message de succès
        return redirect()->route('quote.success')->with('quote_data', $quoteData);
    }

    /**
     * Afficher la page de confirmation
     */
    public function success()
    {
        if (!session()->has('quote_data')) {
            return redirect()->route('accueil');
        }

        return view('quote.success');
    }
}
