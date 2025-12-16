<?php

namespace App\Http\Controllers;

use App\Models\Bait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BaitController extends Controller
{
    public function index()
    {
        try {
            $baits = Bait::all();
        } catch (\Exception $e) {
            // Fallback to sample data if DB not available
            $baits = collect([
                (object)['Id' => 1, 'nom' => 'Leurre 1', 'descriptif' => 'Description 1', 'prix' => 10.00, 'nomImg' => 'IMG1.jpeg'],
                (object)['Id' => 2, 'nom' => 'Leurre 2', 'descriptif' => 'Description 2', 'prix' => 15.00, 'nomImg' => 'IMG2.jpeg'],
                (object)['Id' => 3, 'nom' => 'Leurre 3', 'descriptif' => 'Description 3', 'prix' => 20.00, 'nomImg' => 'IMG3.jpeg'],
            ]);
        }
        return view('index', compact('baits'));
    }

    public function adminIndex()
    {
        if (!session('login')) {
            return redirect('/connexion');
        }
        try {
            $baits = Bait::all();
        } catch (\Exception $e) {
            $baits = collect([
                (object)['Id' => 1, 'nom' => 'Leurre 1', 'descriptif' => 'Description 1', 'prix' => 10.00, 'nomImg' => 'IMG1.jpeg'],
                (object)['Id' => 2, 'nom' => 'Leurre 2', 'descriptif' => 'Description 2', 'prix' => 15.00, 'nomImg' => 'IMG2.jpeg'],
                (object)['Id' => 3, 'nom' => 'Leurre 3', 'descriptif' => 'Description 3', 'prix' => 20.00, 'nomImg' => 'IMG3.jpeg'],
            ]);
        }
        return view('backoffice', compact('baits'));
    }

    public function create()
    {
        if (!session('login')) {
            return redirect('/connexion');
        }
        return view('ajout');
    }

    public function store(Request $request)
    {
        if (!session('login')) {
            return redirect('/connexion');
        }

        $request->validate([
            'add-id' => 'required|integer',
            'add-nom' => 'required|string',
            'add-descriptif' => 'required|string',
            'add-prix' => 'required|numeric',
            'file' => 'required|image|mimes:jpeg,jpg',
        ]);

        $imageName = 'IMG' . $request->input('add-id') . '.jpeg';
        $request->file('file')->move(public_path('images'), $imageName);

        Bait::create([
            'Id' => $request->input('add-id'),
            'nom' => $request->input('add-nom'),
            'descriptif' => $request->input('add-descriptif'),
            'prix' => $request->input('add-prix'),
            'nomImg' => $imageName,
        ]);

        return redirect('/backoffice');
    }

    public function edit($id)
    {
        if (!session('login')) {
            return redirect('/connexion');
        }
        $bait = Bait::findOrFail($id);
        return view('modifier', compact('bait'));
    }

    public function update(Request $request, $id)
    {
        if (!session('login')) {
            return redirect('/connexion');
        }

        $bait = Bait::findOrFail($id);

        $request->validate([
            'edit-nom' => 'required|string',
            'edit-descriptif' => 'required|string',
            'edit-prix' => 'required|numeric',
            'file' => 'nullable|image|mimes:jpeg,jpg',
        ]);

        if ($request->hasFile('file')) {
            // Delete old image
            if ($bait->nomImg && file_exists(public_path('images/' . $bait->nomImg))) {
                unlink(public_path('images/' . $bait->nomImg));
            }
            $imageName = 'IMG' . $id . '.jpeg';
            $request->file('file')->move(public_path('images'), $imageName);
            $bait->nomImg = $imageName;
        }

        $bait->update([
            'nom' => $request->input('edit-nom'),
            'descriptif' => $request->input('edit-descriptif'),
            'prix' => $request->input('edit-prix'),
        ]);

        return redirect('/backoffice');
    }

    public function destroy($id)
    {
        if (!session('login')) {
            return redirect('/connexion');
        }

        $bait = Bait::findOrFail($id);

        // Delete image
        if ($bait->nomImg && file_exists(public_path('images/' . $bait->nomImg))) {
            unlink(public_path('images/' . $bait->nomImg));
        }

        $bait->delete();

        return redirect('/backoffice');
    }
}