@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" alt="Imagen" class="w-100">
        </div>
        <div class="col-4">

            <div class="d-flex align-items-center">
                <div>
                    <img src="{{ $post->user->profile->profileImage() }}" alt="" class="w-100 rounded-circle" style="max-width: 50px;">
                </div>
                <div class="pl-4 d-flex align-items-center">
                    <h3 class="font-weight-bold">
                        <a href="/profile/{{ $post->user->id }}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </h3>
                    <a href="#" class="pl-2 font-weight-bold">Follow</a>
                </div>

            </div>

            <hr>
            
            <p class="">
                <span class="font-weight-bold">
                    <a href="/profile/{{ $post->user->id}} ">
                        <span class="text-dark">{{ $post->user->username }}</span>
                    </a>
                </span> {{ $post->caption }}</p>
        </div>
    </div>
</div>
@endsection
