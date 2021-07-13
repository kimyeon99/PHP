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
        .btn{

        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="title">
            <label for="title">Title</label>
            <input type="text" readonly name="title" class="form-control" id="title" aria-describedby="emailHelp" value="{{ $post->title }}">
          </div>

          <div class="form-group">
            <label>작성자</label>
            <input type="text" readonly class="form-control" value="{{ $post->user_id}}">
          </div>

          <div class="content">
            <label for="content">Content</label>
            <textarea type="text" readonly name="content" class="form-control" id="content">{{ $post->content }}</textarea>
          </div>

          <div class="form-group">
            <label for="imageFile">Post Image</label>
            <div class = "my-6 mx-3 w-3/12">
                <img class = "form-control" width="20%" 
                    src = "{{ $post->imagePath() }}"/>
            </div>
          </div>

            <div class="form-group">
                <label>등록일</label>
                <input type="text" readonly class="form-control" value="{{ $post->created_at}}">
            </div>

            <div class="form-group">
                <label>수정일</label>
                <input type="text" readonly class="form-control" value="{{ $post->updated_at}}">
            </div>

            <div class="btn">
                <a href="{{ route('posts.index', ['page'=>$page]) }}" class ="btn btn-primary">목록보기</a>
            </div>

          </div>

    </div>

</body>
</html>                                                                                             