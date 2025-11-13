@extends('admin.app')
@section('title', 'Instruction Edit')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <h1>{{ $error }}</h1>
        @endforeach
    @endif
    <form action="{{ route('instructoradmin.update', $instructor->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')        
        
        <div class="mb-2 ">
            <label for="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="" value="{{ old('name', $instructor->name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Current Image</label><br>
            @if ($instructor->photo)
                <img src="{{ asset('storage/' . $instructor->photo  ) }}" alt="Old Image" width="120" class="mb-2">
            @else
                <p>No image uploaded</p>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Change Image</label>
            <input type="file" name="photo" class="form-control" accept=".jpg,.png,.jpeg">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
        </div>

        <div class="mb-2 ">
            <label for="form-label">Sosmed Icons</label>
            <div id="featurewrap">
                <div class="feature-item d-flex">
                    <input type="text" class="form-control" name="sosmed" placeholder="Isi Sosmed" data-role="tagsinput" value="{{ implode(',', $instructor->sosmed) }}">
                </div>
            </div>
        </div>

        <div class="mb-2 ">
            <label for="form-label">Sosmed Urls</label>
            <div id="featurewrap">
                <div class="feature-item d-flex">
                    <input type="url" class="form-control" name="sosmed_urls" placeholder="Isi Sosmed" data-role="tagsinput" value="{{ implode(',', $instructor->sosmed_urls) }}">
                </div>
            </div>
        </div>

        <div class="mb-2 ">
            <label for="form-label">Expert</label>
            <input type="text" name="major" class="form-control" id="" value="{{ old('major', $instructor->major) }}">
        </div>

        <button type="submit" class="btn btn-info">Update</button>
        <a href="{{ route('instructoradmin.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection





