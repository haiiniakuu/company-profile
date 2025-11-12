@extends('admin.app')
@section('title', 'Instruction Edit')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <h1>{{ $error }}</h1>
        @endforeach
    @endif
    <form action="{{ route('aboutadmin.update', $instructor->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')                                        

        {{-- Name --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Name</label>
            <input type="text" name="name" class="form-control" 
                   value="{{ old('name', $instructor->name) }}">
        </div>

        {{-- Gambar lama --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Current Image</label><br>
            @if ($instructor->photo)
                <img src="{{ asset('storage/' . $instructor->photo  ) }}" alt="Old Image" width="120" class="mb-2">
            @else
                <p>No image uploaded</p>
            @endif
        </div>

        {{-- Upload gambar baru --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Change Image</label>
            <input type="file" name="image" class="form-control" accept=".jpg,.png,.jpeg">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
        </div>

        {{-- Major --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Major</label>
            <input type="text" name="major" class="form-control" 
                   value="{{ old('major', $instructor->major) }}">
        </div>

        {{-- sosmed --}}
        <div class="mb-2 ">
            <label for="form-label">Sosmed</label>
            <div id="featurewrap">
                <div class="feature-item d-flex">
                    <input type="text" class="form-control" name="sosmed" placeholder="Isi Feature" data-role="tagsinput"  value="{{ implode(',', $instructor->sosmed) }}">
                </div>
            </div>
        </div>


        <button type="submit" class="btn btn-info">Update</button>
        <a href="{{ route('instructoradmin.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection





