<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>

    <h1>게시판</h1>
    <!-- enctype = "multi .."을 반드시 해줘야 파일 업로드가 가능하다.-->
    <form action="{{ route('posts.update', ['id'=>$post->id]) }}" method = "post" enctype="multipart/form-data">
      @csrf
      @method("put") {{-- method spoofing, input type hidden의 value="put"을 선언한 것과 같다 --}}
      <div class="title">
          <label for="title">Title</label>
          <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp" value="{{ old('title') ? old('title') : $post->title }}"> <!--새로고침 될 때 수정하는 도중이었다면 old title을 가져오고, 그렇지 않다면 원래 제목을 다시 가져온다.-->
            @error('title')
               <div>{{ $message }}</div>
            @enderror

          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="content">
          <label for="content">Content</label>
          <textarea type="text" name="content" class="form-control" id="content">{{ old('content') ? old('title') : $post->content }}</textarea>
            @error('content')
              <div>{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
              <img class="img-thumbnail" width="20%" src="{{ $post->imagePath() }}">
          </div>
        </div>
        <div class="checkbox">
          <input type="checkbox" class="checkbox" id="checkbox">
          <label class="checkbox">Check me out</label>
        </div>

        <div class="from-group">
          <label for="file">File</label>
          <input type="file" id="file" name="imageFile">
          @error('imageFile')
            <div>{{ $message }}</div>
          @enderror
        </div><br>
        <button type="submit" class="submit">Submit</button>
  </form>


    
</body>
</html>