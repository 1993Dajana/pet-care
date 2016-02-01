<!-- ovoj fajl e rendiran od create() funkcijata vo PostController ^^ : forma za kreiranje na post -->
@extends('app')
@section('title')
Add New Post
@endsection
@section('content')
<form action="/create-post" method="post">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
 
  <div class="form-group">
    <textarea name='message'class="form-control">{{ old('body') }}</textarea>
  </div>
  <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
 
</form>
@endsection