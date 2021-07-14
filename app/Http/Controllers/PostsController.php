<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function __construct() // php에도 생성자가 있음!
    {
        $this->middleware('auth')->except(['index', 'show']);
        // 여기있는 모든 메서드에 auto middleware 적용. except: 예외
    }

    public function show(Request $request, $id)
    {
        $page = $request->page;
        $post = Post::find($id);
        $post->count++; // 조회수 증가
        $post->save(); // DB 반영

        if (Auth::user() == null && !$post->viewers->contains(false)) {
            $post->viewers()->attach(Auth::user()->id);
        }
        return view('posts.show', compact('post', 'page'));
    }

    public function create()
    {
        // dd('OK'); //웹브라우저한테 'ok'를 주고 죽어라
        return view('posts.create');
    }

    public function store(Request $request)
    {
        //$request->input['title']; // form의 name = 'title'을 따온다.
        //$request->input['content'];

        $title = $request->title;
        $content = $request->content;

        $request->validate([
            'title' => 'required | min:3',
            'content' => 'required',
            'imageFile' => 'image | max:2000' // 필수는 아니나 이미지 파일이어야함.
        ]); // 원하는 데이터가 아니면 페이지를 자동으로 back 시켜줌

        //   dd($request);
        /* get = 정보조회
           post = 자원에 대한 변경
            post 방법으로 보낼 때 다른 사이트에서 해킹을 하여 접속할 수도 있음!!
            그래서 hidden으로 해당 사이트만의 token을 이용해 다른 사이트를 차단한다.
            그것을 @csrf 라고 함.(create.blade.php의 html에 사용)
        */

        $post = new Post();
        $post->title = $title;
        $post->content = $content;
        $post->user_id = Auth::user()->id;
        // 현재 로그인한 유저를 id에 저장한 것을 user_id에 저장
        // user는 models에 자동생성된 모델임


        //File 처리
        // 내가 원하는 파일 시스템 상의 위치에 원하는 이름으로
        // 파일을 저장하고
        if ($request->file('imageFile')) { // 파일이 필수가 아니라 없을 수도 있으므로 if
            $post->image = $this->uploadPostImage($request);
        }
        // DB에 저장
        $post->save();

        return redirect('/posts/index');

        // get 방식의 요청 - view를 return
        // post 방식의 요청 - (대부분) redirection을 return
        //  ㄴ view를 리턴하면 새로고침 할 때 계속 그 요청을 받음(ex: 새로고침할 때마다 글쓰기가 계속됨)
    }

    protected function uploadPostFile(Request $request)
    {
        $name = $request->file('imageFile')->getClientOriginalName();
        // $name = spaceship.jpg

        $extension = $request->file('imageFile')->extension();
        // $extension = 'jpg';
        //  spaceship_1231fafwd.jpg

        $nameWithoutExtension = Str::of($name)->basename('.' . $extension);
        //$nameWithoutExtension = 'spaceship';
        $fileName = $nameWithoutExtension . '_' . time() . '.' . $extension;
        //$filename = 'spaceship'.'_'.'123453543'.'jpg';
        $request->file('imageFile')->storeAs('public/images', $fileName); // imagefile을 image폴더안의 filename으로 저장한다.

        // 그 파일 이름을 칼럼에 저장
        // $post->image = $fileName;

        return $fileName;

        // 업로드 된 파일은 resources/app/images 파일에 저장된다.
    }

    public function index()
    {
        // $posts = Post::all();
        // $posts = Post::latest()->get(); // 가장 최근의 글을 맨 위로.

        $posts = Post::latest()->Paginate(4);
        // dd($posts);
        // 내림차순으로 한 페이지에 4개의 글을 표시
        return view('posts.index', ['posts' => $posts]);
    }

    public function edit(Request $request, Post $post) // 수정 폼 생성
    {
        // $post = Post::find($id);
        // $post - Post::where('id',$id)->('name','scpark)->first();
        //                                                 ㄴ get();
        return view('posts.edit', ['post' => $post, 'page' => $request->page]);
    }

    public function update(Request $request, $id)
    {
        // validation 필요
        // 게시글을 데이터베이스에서 수정
        // 파일시스템에서 이미지 파일 수정
        $page = $request->page;

        $request->validate([
            'title' => 'required | min:3',
            'content' => 'required',
            'imageFile' => 'image | max:2000' // 필수는 아니나 이미지 파일이어야함.
        ]);

        $post = Post::findOrFail($id); // orFail: 괄호 안의 변수를 못 찾으면 404 에러나도록 함.

        // autorization. 수정 권한이 있는지 검사
        // 즉 로그인한 사용자와 게시글의 사용자가 같은지 검사
        // if (auth()->user()->id != $post->user_id) {
        //     abort(403);
        // }


        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }

        if ($request->file('imageFile')) {
            $imagePath = 'public/images/' . $post->image; // 기존의 파일 위치
            Storage::delete($imagePath); // 기존의 파일을 삭제
            $post->image = $this->uploadPostFile($request); // 수정한 파일 업로드
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();


        return redirect()->route('posts.show', ['id' => $id, 'page' => $page]);
    }

    public function destroy(Request $request, $id)
    {
        // 게시글을 데이터베이스에서 삭제
        // 파일 시스템에서 이미지 파일 삭제
        $page = $request->page;
        $post = post::findOrFail($id);

        // autorization. 수정 권한이 있는지 검사
        // 즉 로그인한 사용자와 게시글의 사용자가 같은지 검사
        // if (auth()->user()->id != $post->user_id) {
        //    abort(403);}

        if ($request->user()->cannot('delete', $post)) {
            abort(403);
        }

        if ($post->image) {
            $imagePath = 'public/images/' . $post->image; // 기존의 파일 위치
            Storage::delete($imagePath);
        }
        $post->delete();

        return redirect()->route('posts.index', ['id' => $id, 'page' => $page]);
    }

    public function myPost()
    {
        // $posts = auth() -> user() -> posts() ->orderBy('title', 'asc')->
        $posts = auth()->user()->posts()->latest()->paginate(5);
        //$posts = User::find($id)->posts()->paginate(5);

        return view('posts.myPost', ['posts' => $posts]);
    }
}
