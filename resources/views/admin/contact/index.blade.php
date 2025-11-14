@extends('admin.app')
@section('title', 'Contact Menu')
@section('content')
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Reply</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contact as $index =>$ctc)
                    <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ctc->name }}</td>
                    <td>{{ $ctc->email }}</td>
                    <td>{{ $ctc->subject }}</td>
                    <td>{{ $ctc->message }}</td>
                    <td>{{ $ctc->reply ?? '-' }}</td>
                    <td>
                        <form action="{{ route('contactadmin.reply', $ctc->id) }}" method="POST">
                            @csrf
                            <textarea class="form-control" name="reply" id="" cols="30" rows="5"></textarea>
                            <button class="btn btn-info btn-sm mt-2" type="submit">Kirim Balasan</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            <a href="{{ route('aboutadmin.create') }}" class="btn btn-info my-2">ADD</a>
        </div>
    </div>
    
@endsection