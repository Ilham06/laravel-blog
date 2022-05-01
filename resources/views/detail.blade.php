@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="detail-box">
            <div class="col-12 header mb-3">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Post Detail</li>
                    </ol>
                </nav>
            </div>
            <h1 class="title fw-bold">
                {{ $post->title }}
            </h1>
            <span class="d-block mt-3 mb-2"><strong>Category :</strong> {{ $post->category->name }}</span>
            <span>
                <strong>Published at :</strong> {{ $post->getDate() }}
            </span>
            <div class="content my-3">
                <div class="img mb-5">
                    <img width="100%" src="{{ asset('storage/thumbnail/' . $post->thumbnail) }}" alt="">
                </div>
                {{ $post->content }}
            </div>
            <strong>Tag :</strong>
            @foreach ($post->tag as $tag)
                <span class="badge bg-primary">{{ $tag->name }}</span>
            @endforeach
        </div>
    </div>
@endsection
