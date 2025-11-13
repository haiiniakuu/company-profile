<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructor = Instructor::orderBy('id', 'DESC')->get();
        return view('admin.instructor.index', compact('instructor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.instructor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validasi = $request->validate([
                'name' => 'required|string',
                'photo' => 'required|image|mimes:png,jpg,jpeg|max:20048',
                'major' => 'required|string',
                'sosmed' => 'string',
                'sosmed_urls' => 'required|string',
            ]);

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('upload/instructor', $filename, 'public');
                $validasi['photo'] = $path;
            }

            $sosmed = [];
            if ($request->sosmed) {
                $sosmed = array_map('trim', explode(',', $request->sosmed));
            }
            $validasi['sosmed'] = $sosmed;

            $sosmed_urls = [];
            if ($request->sosmed_urls) {
                $sosmed_urls = array_map('trim', explode(',', $request->sosmed_urls));
            }
            $validasi['sosmed_urls'] = $sosmed_urls;

            Instructor::create($validasi);

            return redirect()->route('instructoradmin.index');
        } catch (\Throwable $th) {
            return back()->withErrors([
                'error' => 'Terjadi kesalahan  di- ',
                $th->getMessage()
            ]);
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
        $instructor = Instructor::find($id);
        return view('admin.instructor.edit', compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $instructor = Instructor::find($id);

            $validasi = $request->validate([
                'name' => 'required|string',
                'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:20048',
                'major' => 'required|string',
                'sosmed' => 'required|string',
                'sosmed_urls' => 'required|string',
            ]);

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('upload/instructor', $filename, 'public');
                $validasi['photo'] = $path;
            }

            $sosmed = [];
            if ($request->sosmed) {
                $sosmed = array_map('trim', explode(',', $request->sosmed));
            }
            $validasi['sosmed'] = $sosmed;

            $sosmed_urls = [];
            if ($request->sosmed_urls) {
                $sosmed_urls = array_map('trim', explode(',', $request->sosmed_urls));
            }
            $validasi['sosmed_urls'] = $sosmed_urls;

            $instructor->update($validasi);

            return redirect()->route('instructoradmin.index');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /** 
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $instructor = Instructor::find($id);
        $instructor->delete();
        File::delete(public_path('storage/' . $instructor->photo));
        return redirect()->route('instructoradmin.index');
    }
}
