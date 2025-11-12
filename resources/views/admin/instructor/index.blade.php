@extends('admin.app')
@section('title', 'Instructor Menu')
@section('content')
    <div class="table-responsive">
        <div class="d-flex justify-content-end">
            <a href="{{ route('instructoradmin.create') }}" class="btn btn-info my-2">ADD</a>
        </div>
    </div>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Photo</th>
                <th>Major</th>
                <th>Sosmed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($instructor as $index => $y)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $y->name }}</td>
                    <td><img src="{{ asset('storage/' . $y->photo) }}" width="120" alt=""></td>
                    <td>{{ $y->major }}</td>
                    <td>
                        <ul>
                            @foreach ($y->sosmed as $c)
                                <li>{{ $c }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <a href="{{ route('instructoradmin.edit', $y->id) }}" class="btn btn-success">Edit</a>
                        <form action="{{ route('instructoradmin.destroy', $y->id) }}" method="post" class="d-inline">
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