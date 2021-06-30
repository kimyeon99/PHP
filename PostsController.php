<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        dd($request);
        /* get = 정보조회
           post = 자원에 대한 변경
            post 방법으로 보낼 때 다른 사이트에서 해킹을 하여 접속할 수도 있음!!
            그래서 hidden으로 해당 사이트만의 token을 이용해 다른 사이트를 차단한다.
            그것을 @csrf 라고 함.
        */
    }
}
