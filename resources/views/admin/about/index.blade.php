@extends('admin.app')
@section('title', 'Home Menu')
@section('content')
    <div class="table-responsive">
        <div class="d-flex justify-content-end">
            <a href="{{ route('aboutadmin.create') }}" class="btn btn-info my-2">ADD</a>
        </div>
    </div>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Image</th>
                <th>Subtitle</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($abouts as $index => $x)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><img src="{{ asset('storage/' . $x->image) }}" width="120" alt=""></td>
                    <td>{{ $x->features }}</td>
                    <td>{{ $x->title }}</td>
                    <td>{{ $x->description }}</td>
                    <td>
                        <a href="{{ route('aboutadmin.edit', $x->id) }}" class="btn btn-success">Edit</a>
                        <form action="{{ route('aboutadmin.destroy', $x->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection