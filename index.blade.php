<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        h1{
            text-align: center;
        }
        .btn btn-primary{
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>List</h1>
        <a href="/posts/create" class="btn btn-primary">게시글 작성</a>
        <ol class="list-group list-group-numbered ml-5">
            @foreach ($posts as $post)
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold"><span>Title : {{ $post->title }}</span></div>
                {{ $post->content }}
              </div>
              <span class="badge bg-primary rounded-pill">{{ $post->created_at }}</span>
            </li>
            @endforeach
          </ol>

          <div class="mt-5">
            {{ $posts->links() }}
        </div>
    </div>

    
</body>
</html>