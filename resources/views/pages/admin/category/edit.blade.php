@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 header mb-3">
                <h3 class="fw-bold mt-4">Edit Category Data</h3>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('category.index') }}"
                                class="text-decoration-none">Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('category.update', $category->id) }}" method="post">
                            @method('put')
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" placeholder="Category Name" value="{{ old('name', $category->name) }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="sumbit" class="btn btn-primary">Sumbit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
