<!doctype html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <h1 class="title">
            {{ $post->title }}
        </h1>
        
        <p class="edit">[<a href="/posts/{{ $post->id }}/edit">edit</a>]</p>
        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit">delete</button> 
　　    </form>
        <div class="content">
            <div class="content__post">
                <h3>本文</h3>
                <p>{{ $post->body }}</p>    
            </div>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        <div class='comments'>
            @foreach ($comments as $comment)
                <div class='comment'>
                    <h2 class='star'>{{ $comment->star }}</h2>
                    <p class='comment'>{{ $comment->comment}}</p>
                </div>
            @endforeach
        </div>
        <form action="/comments/{{$post->id}}" method="POST"><!--{}*2で変数がその役割を果たす-->
            @csrf
            <div class="star">
                <h3>評価</h3>
                <input type="radio" name="comment[star]" value=1>1 </input>
                <input type="radio" name="comment[star]" value=2>2 </input>
                <input type="radio" name="comment[star]" value=3>3 </input>
                <input type="radio" name="comment[star]" value=4>4 </input>
                <p class="title__error" style="color:red">{{ $errors->first('comment.star') }}</p>
            </div>
            <div class="comment">
                <h3>コメント</h3>
                <input type="text" name="comment[comment]" placeholder="コメント" value="{{ old('comment.comment') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('comment.comment') }}</p>
            </div>
            <button type="submit">投稿</button>
        </form>
    </body>
</html>