@extends('admin.app')
@section('title', 'About Edit')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <h1>{{ $error }}</h1>
        @endforeach
    @endif
    <form action="{{ route('aboutadmin.update', $about->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')                                        

        {{-- Gambar lama --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Current Image</label><br>
            @if ($about->image)
                <img src="{{ asset('storage/' . $about->image) }}" alt="Old Image" width="120" class="mb-2">
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

        {{-- Title --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Title</label>
            <input type="text" name="title" class="form-control" 
                   value="{{ old('title', $about->title) }}">
        </div>

        {{-- Features --}}
        <div class="mb-2 ">
            <label for="form-label">Features</label>
            <div id="featurewrap">
                <div class="feature-item d-flex">
                    <input type="text" class="form-control" name="features" placeholder="Isi Feature" data-role="tagsinput"  value="{{ implode(',', $about->features) }}">
                </div>
            </div>
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Description</label>
            <textarea name="description" class="form-control" rows="5">{{ old('description', $about->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-info">Update</button>
        <a href="{{ route('aboutadmin.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection





