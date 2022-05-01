@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <h1 class="fw-bold">Welcome To Blog</h1>
            <p class="fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit!</p>
        </div>
        <div class="row mt-4">
            @forelse ($posts as $post)
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-lg-4">
                                    <img class="rounded-3" width="100%"
                                        src="{{ asset('storage/thumbnail') . '/' . $post->thumbnail }}" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <a class="text-decoration-none text-dark"
                                        href="{{ route('post.detail', $post->slug) }}">
                                        <h3 class="fw-bold mb-3">{{ $post->title }}</h3>
                                    </a>
                                    <p>{{ $post->excerp() }}</p>
                                    <span>{{ $post->getDate() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h2 class="mt-5 text-center">Nothing Post</h2>
            @endforelse
        </div>
        {{ $posts->links() }}
    </div>
@endsection
