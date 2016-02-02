@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard my pofile</div>

                <div class="panel-body">
                     @if (!$posts->count())
                     There are no posts now
                     @else
                    
                     <div class="">
                      @foreach($posts as $post)
                   
                      <div class="list-group">
                        <div class="list-group-item">
                          
                            <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Post</a></button>
                        
                         <div class="list-group-item">
                          <article>
                            {{ $post->message }}
                          </article>
                        </div>
                          <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/users/'. $post->user_id)}}">{{ $post->author->first_name }}</a></p>
                        </div>
                        
                      </div>

                      <a href="{{ url('/posts/like/' . $post->id) }}">Likes: {{ count($post->likes) }}</a>
                      <a href="{{ url('/posts/unlike/' . $post->id) }}">Unlike(samo ako si go lajknal)</a>
                      <!-- VNESI NOV KOMENTAR -->
                      @if(Auth::guest())
                        <p>Login to Comment</p>
                      @else
                        <div class="panel-body">
                          <form method="post" action="/comments/add">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="form-group">
                              <textarea required="required" placeholder="Enter comment here" name = "message" class="form-control"></textarea>
                            </div>
                            <input type="submit" name='post_comment' class="btn btn-success" value = "Post"/>
                          </form>
                        </div>
                      @endif

                      <!-- STARI KOMENTARI ZA POSTOV -->
                      <a href="{{ url('/posts/'.$post->id) }} ">Show comments</a>
                      @endforeach
                          {!! $posts->render() !!} <!--so paginate-->
                  </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
