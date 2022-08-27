<!DOCTYPE html>
@extends('layouts.layout')

@section('main')
    <main id='home'>
        <form action="/post/edit/{{ $post->id }}" method="post" class="post-form">
            @csrf
            @method('put')
            <textarea name="post" id="post" cols="50" rows="5" placeholder="Your post">{{ $post->post }}</textarea>
            <button type="submit">Edit Post</button>
        </form>
    </main>
@endsection
