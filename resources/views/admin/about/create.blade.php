@extends('admin.app')
@section('title', 'About Create')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <h1>{{ $error }}</h1>
        @endforeach
    @endif
    <form action="{{ route('aboutadmin.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-2 ">
            <label for="form-label">Image</label>
            <input type="file" name="image" class="form-control" accept=".jpg,.png,.jpeg" id="">
        </div>
        <div class="mb-2 ">
            <label for="form-label">Features</label>
            <div id="featurewrap">
                <div class="feature-item d-flex">
                    <input type="text" class="form-control features" placeholder="Isi Feature">
                    <button type="submit" class="removeFeatures btn btn-danger">Remove</button>
                    <button type="button" class="btn btn-primary" id="addFeature">ADD</button>
                </div>
            </div>
            
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
        <a href="{{ url('aboutadmin') }}" class="btn btn-secondary">Back</a>
    </form>
    <script>
        const wraper = document.querySelector('#featurewrap');
        const addBtn = document.querySelector('#addFeature');

        addBtn.addEventListener('click', function() {
            const newInpt = document.createElement('div');
            newInpt.classList.add('feature-item');
            newInpt.innerHTML = 
            `
                <input type="text" class="form-control features" placeholder="Isi Feature">
                <button type="submit" class="removeFeatures btn btn-danger">Remove</button>
            `;
            wraper.appendChild(newInpt);
        })
    </script>   
@endsection