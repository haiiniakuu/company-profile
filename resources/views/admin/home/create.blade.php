@extends('admin.app')
@section('title', 'Home Create')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <h1>{{ $error }}</h1>
        @endforeach
    @endif
    <form action="{{ route('homeadmin.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-2 ">
            <label for="form-label">Image</label>
            <input type="file" name="image" class="form-control" accept=".jpg,.png,.jpeg" id="">
        </div>
        <div class="mb-2 ">
            <label for="form-label">Subtitle</label>
            <input type="text" name="subtitle" class="form-control" id="">
        </div>
        <div class="mb-2 ">
            <label for="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="">
        </div>
        <div class="mb-2 ">
            <label for="form-label">Description</label>
            <textarea name="description" id="" class="form-control"  cols="30" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-info">Submit</button>
        <a href="{{ url('homeadmin') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection