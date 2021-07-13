<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>

</head>
<body>

    <h1>게시판</h1>
    <!-- enctype = "multi .."을 반드시 해줘야 파일 업로드가 가능하다.-->
    <form action="/posts/store" method = "post" enctype="multipart/form-data">
      @csrf
      <div class="title">
          <label for="title">Title</label>
          <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp" value="{{ old('title') }}"> 
            @error('title')
               <div>{{ $message }}</div>
            @enderror

          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="content">
          <label for="content">Content</label>
          <textarea type="text" name="content" class="form-control" id="content">{{ old('content') }}</textarea>
            @error('content')
              <div>{{ $message }}</div>
            @enderror
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
  <script>
    ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
    
</body>
</html>