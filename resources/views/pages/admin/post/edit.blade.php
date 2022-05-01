@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 header mb-3">
                <h3 class="fw-bold mt-4">Edit Post Data</h3>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('post.index') }}"
                                class="text-decoration-none">Post</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Post Name</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="name"
                                    name="title" placeholder="Post Name" value="{{ old('title', $post->title) }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="label" class="form-label">Category</label>
                                <select name="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $post->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tag" class="form-label">Post Tag</label>
                                <input type="text" class="form-control" id="tag" name="tag" placeholder="Post Tag"
                                    value="{{ old('title', $post->tag->implode('name', ',')) }}">
                            </div>
                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Post thumbnail</label>
                                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                    id="thumbnail" name="thumbnail">
                                @error('thumbnail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Post content</label>
                                <textarea name="content" id="content" cols="30" rows="10"
                                    class="form-control">{{ old('content', $post->content) }}</textarea>
                                @error('content')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            {{-- <div class="mb-4">
                                <label for="x" class="form-label">Content</label>
                                <input id="x" type="hidden" name="content" value="{{ old('content') }}">
                                <trix-editor input="x"></trix-editor>
                                @error('content')
                                    <small class="text-red">{{ $message }}</small>
                                @enderror
                            </div> --}}
                            <button type="sumbit" class="btn btn-primary">Sumbit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
