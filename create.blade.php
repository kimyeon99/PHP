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
    <form action="/posts/store" method = "post">
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
          <textarea type="text" name="content" class="form-control" id="content" value="{{ old('content') }}"></textarea>
            @error('content')
              <div>{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="checkbox">
          <input type="checkbox" class="checkbox" id="checkbox">
          <label class="checkbox">Check me out</label>
        </div>
        <button type="submit" class="submit">Submit</button>
  </form>


    
</body>
</html>