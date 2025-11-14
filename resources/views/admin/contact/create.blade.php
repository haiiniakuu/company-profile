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
                    <input type="text" class="form-control" name="features" placeholder="Isi Feature" data-role="tagsinput">
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
@endsection





{{-- @extends('admin.app')
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
            <input type="file" name="image" class="form-control" accept=".jpg,.png,.jpeg">
        </div>

        <div class="mb-2">
            <label for="form-label">Features</label>
            <div id="featurewrap">
                <div class="feature-item d-flex gap-2 mb-2">
                    <input type="text" name="features[]" class="form-control features" placeholder="Isi Feature">
                    <button type="button" class="removeFeatures btn btn-danger">Remove</button>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="addFeature">+ Add Feature</button>
        </div>

        <div class="mb-2 ">
            <label for="form-label">Title</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="mb-2 ">
            <label for="form-label">Description</label>
            <textarea name="description" class="form-control" cols="30" rows="5"></textarea>
        </div>

        <button type="submit" class="btn btn-info">Submit</button>
        <a href="{{ url('aboutadmin') }}" class="btn btn-secondary">Back</a>
    </form>

    <script>
        const wrapper = document.querySelector('#featurewrap');
        const addBtn = document.querySelector('#addFeature');

        // ✅ Tambah input baru
        addBtn.addEventListener('click', function() {
            const newInput = document.createElement('div');
            newInput.classList.add('feature-item', 'd-flex', 'gap-2', 'mb-2');
            newInput.innerHTML = `
                <input type="text" name="features[]" class="form-control features" placeholder="Isi Feature">
                <button type="button" class="removeFeatures btn btn-danger">Remove</button>
            `;
            wrapper.appendChild(newInput);
        });

        // ✅ Event delegation untuk hapus input (termasuk yang baru ditambahkan)
        wrapper.addEventListener('click', function(e) {
            if (e.target.classList.contains('removeFeatures')) {
                e.preventDefault();
                const item = e.target.closest('.feature-item');
                if (item) item.remove();
            }
        });
    </script>
@endsection --}}
