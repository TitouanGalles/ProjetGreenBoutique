<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function show()
    {
        return view('paiement');
    }

    public function verify(Request $request)
    {
        $numCarte = $request->input('numCarte');
        $date = $request->input('date');

        $verifCarte = false;
        $verifDate = false;

        if (is_numeric($numCarte) && strlen($numCarte) == 16 && $numCarte[0] == $numCarte[15]) {
            $verifCarte = true;
        }

        if ($date) {
            $dateInput = new \DateTime($date);
            $dateNow = new \DateTime();
            $dateNow->modify('+3 months');
            if ($dateInput >= $dateNow) {
                $verifDate = true;
            }
        }

        session(['verifCarte' => $verifCarte, 'verifDate' => $verifDate]);

        if ($verifCarte && $verifDate) {
            // Payment successful, clear cart
            session()->forget(['Panier', 'quantite']);
            return redirect('/paiement');
        }

        return redirect('/paiement');
    }
}