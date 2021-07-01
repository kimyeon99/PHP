<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
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
            'content' => 'required'
        ]); // 원하는 데이터가 아니면 페이지를 자동으로 back 시켜줌

        //   dd($request);
        /* get = 정보조회
           post = 자원에 대한 변경
            post 방법으로 보낼 때 다른 사이트에서 해킹을 하여 접속할 수도 있음!!
            그래서 hidden으로 해당 사이트만의 token을 이용해 다른 사이트를 차단한다.
            그것을 @csrf 라고 함.(create.blade.php의 html에 사용)
        */

        // DB에 저장
        $post = new Post();
        $post->title = $title;
        $post->content = $content;
        $post->user_id = Auth::user()->id;
        // 현재 로그인한 유저를 id에 저장한 것을 user_id에 저장
        // user는 models에 자동생성된 모델임
        $post->save();

        // 결과 뷰를 저장
        return redirect('/posts/index');
        // get 방식의 요청 - view를 return
        // post 방식의 요청 - (대부분) redirection을 return
    }

    public function index()
    {
        // $posts = Post::all();
        // $posts = Post::latest()->get(); // 가장 최근의 글을 맨 위로.

        $posts = Post::latest()->Paginate(4);
        // 내림차순으로 한 페이지에 4개의 글을 표시
        return view('posts.index', ['posts' => $posts]);
    }
}
