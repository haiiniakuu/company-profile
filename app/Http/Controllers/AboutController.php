<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::orderBy('id', 'DESC')->get();
        return view('admin.about.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validasi = $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg|max:20048',
                'title' => 'required|string',
                'description' => 'required|string',
                'features' => 'required|string',
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('upload/about', $filename, 'public');
                $validasi['image'] = $path;
            }

            $feautures = [];
            if($request->features){
                $feautures = array_map('trim', explode(',', $request->features));
            }
            $validasi['features'] = $feautures;

            About::create($validasi);
            return redirect()->route('aboutadmin.index');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => 'Terjadi kesalahan  di- ',
            $th->getMessage()]);
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
        $about = About::find($id);
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $about = About::find($id);

            $validasi = $request->validate([
                'image' => 'image|mimes:png,jpg,jpeg|max:20048',
                'title' => 'required|string',
                'description' => 'required|string',
                'features' => 'required|string',
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('upload/about', $filename, 'public');
                $validasi['image'] = $path;
            }

            $features = [];
            if ($request->features) {
                $features = array_map('trim', explode(',', $request->features));
            }
            $validasi['features'] = $features;

            $about->update($validasi);

            return redirect()->route('aboutadmin.index');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $about = About::find($id);
        $about->delete();
        File::delete(public_path('storage/' . $about->image));
        return redirect()->route('aboutadmin.index');
    }
}
