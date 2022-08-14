<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


 
    // Indexページの表示
    public function index() {

        $home = Home::all(); // 全データの取り出し
        return view('home', ["home" => $home]); // homeにデータを渡す
    }

    // 投稿された内容を表示するページ
    public function create(Request $request) {

        // バリデーションチェック
        $request->validate([
            'comment' => 'required|min:5|max:140',
        ]);

        // 投稿内容の受け取って変数に入れる
        $comment = $request->input('comment');

        Home::insert(["comment" => $comment]); // データベーステーブルhomeに投稿内容を入れる

        $home = Home::all(); // 全データの取り出し
        return view('home', ["home" => $home]); // homeにデータを渡す
    }

}
