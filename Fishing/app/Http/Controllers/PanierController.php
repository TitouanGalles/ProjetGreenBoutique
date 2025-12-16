<?php

namespace App\Http\Controllers;

use App\Models\Bait;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    public function afficher()
    {
        $panier = session('Panier', []);
        $quantites = session('quantite', []);
        $baits = collect([]);
        $prixTotal = 0;

        if (!empty($panier)) {
            foreach ($panier as $id) {
                try {
                    $bait = Bait::find($id);
                } catch (\Exception $e) {
                    // Fallback
                    $bait = (object)['Id' => $id, 'nom' => 'Leurre ' . $id, 'descriptif' => 'Description ' . $id, 'prix' => 10.00, 'nomImg' => 'IMG' . $id . '.jpeg'];
                }
                if ($bait) {
                    $baits->push($bait);
                    $prix = $quantites[$id - 1] * $bait->prix;
                    $prixTotal += $prix;
                }
            }
        }

        return view('panier', compact('baits', 'quantites', 'prixTotal'));
    }

    public function ajouter($id)
    {
        $panier = session('Panier', []);
        $quantites = session('quantite', []);

        if (empty($quantites)) {
            try {
                $nbArticles = Bait::count();
            } catch (\Exception $e) {
                $nbArticles = 10; // Fallback
            }
            $quantites = array_fill(0, $nbArticles, 0);
        }

        if (in_array($id, $panier)) {
            $quantites[$id - 1] += 1;
        } else {
            $panier[] = $id;
            $quantites[$id - 1] += 1;
        }

        session(['Panier' => $panier, 'quantite' => $quantites]);

        return redirect('/');
    }

    public function retirer(Request $request, $id)
    {
        $panier = session('Panier', []);
        $quantites = session('quantite', []);
        $quantite = $request->input('quantite', 0);

        if (isset($quantites[$id - 1]) && $quantites[$id - 1] >= $quantite) {
            $quantites[$id - 1] -= $quantite;
        }

        if ($quantites[$id - 1] <= 0) {
            $panier = array_filter($panier, function($item) use ($id) {
                return $item != $id;
            });
        }

        session(['Panier' => array_values($panier), 'quantite' => $quantites]);

        return redirect('/panier');
    }

    public function vider()
    {
        session()->forget(['Panier', 'quantite']);
        return redirect('/panier');
    }
}