<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homes = Home::orderBy('id', 'DESC')->get();
        return view('admin.home.index', compact('homes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.home.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validasi = $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg|max:200048',
                'subtitle' => 'required|string',
                'title' => 'required|string',
                'description' => 'required|string',
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('upload/home', $filename, 'public');
                $validasi['image'] = $path;
            }

            //insert
            Home::create($validasi);
            return redirect()->route('homeadmin.index');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => 'terjadi masalah' . $th->getMessage()]);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $home = Home::find($id);
        return view('admin.home.edit', compact('home'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $home = Home::findOrFail($id);

            $validasi = $request->validate([
                'image' => 'nullable|image|mimes:png,jpg,jpeg|max:200048',
                'subtitle' => 'required|string',
                'title' => 'required|string',
                'description' => 'required|string',
            ]);

            // Kalau user upload gambar baru
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('upload/home', $filename, 'public');
                $validasi['image'] = $path;
            } else {
                // Jika tidak upload gambar, pakai gambar lama
                $validasi['image'] = $home->image;
            }

            $home->update($validasi);

            return redirect()->route('homeadmin.index')->with('success', 'Data berhasil diperbarui!');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => 'terjadi masalah' . $th->getMessage()]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $home = Home::find($id); 
        $home->delete(); 
        File::delete(public_path('storage/' . $home->image)); 
        return redirect()->route('homeadmin.index');
    }
}
