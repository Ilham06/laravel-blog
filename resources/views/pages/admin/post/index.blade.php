@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 header mb-3">
                <h3 class="fw-bold mt-4">Post</h3>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Post</li>
                    </ol>
                </nav>
            </div>
            <div class="col">
                <a href="{{ route('post.create') }}" class="btn btn-sm btn-success mb-2">Add Post</a>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="10%">Thumbnail</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $key => $post)
                                        <tr>
                                            <td><img width="100%"
                                                    src="{{ asset('storage/thumbnail') . '/' . $post->thumbnail }}"
                                                    alt="">
                                            </td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->category->name }}</td>
                                            <td>
                                                <a href="{{ route('post.edit', $post->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                <form onclick="return confirm('Delete This Data?')"
                                                    action="{{ route('post.destroy', $post->id) }}" class="d-inline"
                                                    method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
