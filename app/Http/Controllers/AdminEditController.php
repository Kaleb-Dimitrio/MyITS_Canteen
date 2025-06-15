<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;
use App\Models\Cashier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminEditController extends Controller
{
    /**
     * Show the form for creating or editing a Toko.
     */
    public function showForm()
    {
        return view('admin_edit');
    }

    /**
     * Store a newly created resource or update an existing one.
     */
    public function storeOrUpdate(Request $request)
    {
        // 1. Validate the form data, including the new 'toko_no_rekening' field
        $validatedData = $request->validate([
            'toko_nama' => 'required|string|max:255',
            'toko_no_rekening' => 'required|string|max:255',
            'kasir_nama' => 'required|string|max:255',
            'nomor_telephone' => 'required|string|max:15',
            'foto_toko' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle the image upload if a file is provided
        $imagePathForDb = null;
        if ($request->hasFile('foto_toko')) {
            $file = $request->file('foto_toko');
            // Get the original name of the file
            $originalFileName = $file->getClientOriginalName();
            // Store the file in 'storage/app/public/image' using its original name
            $file->storeAs('image', $originalFileName, 'public');
            // Set the path to be saved in the database
            $imagePathForDb = 'image/' . $originalFileName;
        }

        // 2. Logic to "Update or Create" the Toko
        $tokoData = [
            'admin_id' => Auth::guard('admin')->id(),
            // Use the validated nomor rekening from the form
            'toko_no_rekening' => $validatedData['toko_no_rekening']
        ];

        // Only add the image path if a new image was uploaded
        if ($imagePathForDb) {
            $tokoData['toko_gambar'] = $imagePathForDb;
        }

        $toko = Toko::updateOrCreate(
            ['toko_nama' => $validatedData['toko_nama']], // Condition to find the toko
            $tokoData                                     // Data to update or create with
        );

        // 3. Logic to create the new Cashier
        $tokoNameSlug = Str::slug($toko->toko_nama);
        $cashierNameNoSpace = strtolower(str_replace(' ', '', $validatedData['kasir_nama']));

        Cashier::create([
            'cashier_nama' => $validatedData['kasir_nama'],
            'cashier_no_telp' => $validatedData['nomor_telephone'],
            'cashier_email' => "{$cashierNameNoSpace}@{$tokoNameSlug}.com",
            'cashier_password' => Hash::make("{$tokoNameSlug}123"),
            'toko_id' => $toko->toko_id, // Link the cashier to the toko
        ]);

        // 4. Redirect back with a success message
        return back()->with('success', 'Toko dan Kasir berhasil disimpan!');
    }
}
