<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">    <style>
        .container{
            font-family: 'Roboto Slab', serif;
        }
        h1{
            
            text-align: center;
            font-size: 60px;
        }
        .btn1{
            padding-left: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>List</h1>
        <div class="btn1">
            <a href="{{ route('dashboard') }}" class ="btn btn-primary" id="btn1">Dashboard</a>
            @auth   <!-- 로그인이 된 상태면 아래 실행, 아니면 실행X-->
            <a href="/posts/create" class="btn btn-primary">게시글 작성</a>
        @endauth
        </div>
        <br>
        
        <ol class="list-group list-group-numbered ml-5">
            @foreach ($posts as $post)
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Title : <span><a href="{{ route('posts.show', ['id'=>$post->id, 'page'=>$posts->currentPage()]) }}">{{ $post->title }}</a></span></div>
                {!! $post->content !!}
              </div>
              <span class="badge bg-primary rounded-pill">{{ $post->created_at->diffForHumans() }}</span>
              <span class="badge bg-primary rounded-pill">{{ $post->count }} {{ $post->count >0 ? Str::plural('view', $post->count):'view' }}</span>

            </li>
            @endforeach
          </ol>

          <div class="mt-5">
            {{ $posts->links() }}
        </div>
    </div>

</body>
</html>