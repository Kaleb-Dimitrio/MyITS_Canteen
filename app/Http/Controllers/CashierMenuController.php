<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;

class CashierMenuController extends Controller
{
    /**
     * Show the menu editing form.
     * This will fetch all menu items belonging to the logged-in cashier's store.
     */
    public function showEditForm()
    {
        // Get the logged-in cashier
        $cashier = Auth::guard('cashier')->user();

        // Get all menu items that belong to the cashier's toko
        $menus = Menu::where('toko_id', $cashier->toko_id)
                     ->orderBy('menu_kategori')
                     ->orderBy('menu_nama')
                     ->get();
        
        return view('cashier_edit', ['menus' => $menus]);
    }

    /**
     * Store a newly created menu item in the database.
     */
    public function store(Request $request)
    {
        // Get the logged-in cashier and their store ID
        $cashier = Auth::guard('cashier')->user();
        
        $validatedData = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // *** UPDATED IMAGE HANDLING LOGIC ***
        $imagePathForDb = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Get the original name of the file
            $originalFileName = $file->getClientOriginalName();
            // Store the file in 'storage/app/public/image' using its original name
            $file->storeAs('image', $originalFileName, 'public');
            // Set the path to be saved in the database
            $imagePathForDb = 'image/' . $originalFileName;
        }

        // Create the new menu item and associate it with the cashier's store
        Menu::create([
            'menu_nama' => $validatedData['nama_menu'],
            'menu_harga' => $validatedData['harga'],
            'menu_stok' => $validatedData['stok'],
            'menu_kategori' => $validatedData['kategori'],
            'menu_gambar' => $imagePathForDb, // Use the new path variable
            'toko_id' => $cashier->toko_id,
        ]);

        return back()->with('success', 'Menu baru berhasil ditambahkan!');
    }

    /**
     * Update an existing menu item.
     */
    public function update(Request $request, Menu $menu)
    {
        // Authorization: Ensure the cashier can only edit menus from their own store.
        if ($menu->toko_id !== Auth::guard('cashier')->user()->toko_id) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $menu->update([
            'menu_harga' => $validatedData['harga'],
            'menu_stok' => $validatedData['stok'],
        ]);

        return back()->with('success', "Menu '{$menu->menu_nama}' berhasil diperbarui.");
    }

    /**
     * Delete a menu item.
     */
    public function destroy(Menu $menu)
    {
        // Authorization: Ensure the cashier can only delete menus from their own store.
        if ($menu->toko_id !== Auth::guard('cashier')->user()->toko_id) {
            abort(403, 'Unauthorized action.');
        }

        $menu->delete();
        
        return back()->with('success', "Menu '{$menu->menu_nama}' berhasil dihapus.");
    }
}
