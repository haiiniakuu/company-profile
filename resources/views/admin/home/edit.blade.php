@extends('admin.app')
@section('title', 'Home Edit')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <h1>{{ $error }}</h1>
        @endforeach
    @endif
    <form action="{{ route('homeadmin.update', $home->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')                                        

        {{-- Gambar lama --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Current Image</label><br>
            @if ($home->image)
                <img src="{{ asset('storage/' . $home->image) }}" alt="Old Image" width="200" class="mb-2">
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

        {{-- Subtitle --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Subtitle</label>
            <input type="text" name="subtitle" class="form-control" 
                   value="{{ old('subtitle', $home->subtitle) }}">
        </div>

        {{-- Title --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Title</label>
            <input type="text" name="title" class="form-control" 
                   value="{{ old('title', $home->title) }}">
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Description</label>
            <textarea name="description" class="form-control" rows="5">{{ old('description', $home->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-info">Update</button>
        <a href="{{ route('homeadmin.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection