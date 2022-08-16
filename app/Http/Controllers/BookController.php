<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
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

 
    /**
     * 商品検索
     */
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $books = Book::Join('categories', 'books.category_id', '=', 'categories.id')
           ->Join('publishers', 'books.publisher_id', '=', 'publishers.id')
           ->where(function($query) use($keyword){
            $query->where('title', 'LIKE', "%{$keyword}%") 
                ->orWhere('publisher_name', 'LIKE', "%{$keyword}%")
                ->orWhere('category_name', 'LIKE', "%{$keyword}%");
           })
           ->select('books.*','categories.category_name','publishers.publisher_name')
           ->get();

        return view('book.search', compact('books', 'keyword'));
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $books = Book::all();

        return view('book.index', compact('books'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'category_id' => 'required',
                'publisher_id' => 'required',
                'stock' => 'required',
                'title' => 'required',
                'price' => 'required',
            ]);
            
            $request->user()->books()->create([
                'category_id' => $request->publisher_id,
                'publisher_id' => $request->publisher_id,
                'title' => $request->title,
                'price' => $request->price,
                'stock' => $request->stock,
             ]);
         
            return redirect('/books');
            
        }else{
            // 登録画面を表示
            $publishers = Publisher::all();
            $categories = Category::all();

            return view('book.add')
            ->with([
                'publishers' =>  $publishers,
                'categories' =>  $categories,

            ]);

        }
    }

    /**
     * 投稿作成
     */
    public function create()
    {
        // 出版社テーブルの全データを取得する
        $publishers = Publisher::all();

        return view('book.add')
            ->with([
                'publishers' =>  $publishers,
            ]);
    }

    /**
     * 投稿編集 遷移
     */
    public function edit($id){
        $book = \App\Models\Book::where('id', '=', 'id')->first();
        $book = \App\Models\Book::findOrFail($id);

        $publishers = Publisher::all();
        $categories = Category::all();
        

        return view('book.edit')
        ->with([
            'book' => $book,
            'publishers' =>  $publishers,
            'categories' =>  $categories,
            

        ]);
    }

 
    /**
     * 投稿編集
     */
    public function bookEdit(Request $request){
        $book = \App\Models\Book::where('id', '=', $request->id)->first();
        $request->validate([
            'category_id' => 'required',
            'publisher_id' => 'required',
            'stock' => 'required',
            'title' => 'required',
            'price' => 'required',
        ]);

        $book->publisher_id = $request->publisher_id;
        $book->category_id = $request->category_id;
        $book->title = $request->title;
        $book->price = $request->price;
        $book->stock = $request->stock;
        $book->save(); 

        return redirect('/books');
    }

    /**
     * 投稿削除
     */
    public function bookDelete(Request $request,$id){
        $book = \App\Models\Book::find($id);
        $book->delete();

        return redirect('/books');
    }

    /**
     * 在庫　減らす
     */
    public function minus(Request $request,$id){
        $book = \App\Models\Book::find($id);
        $book->stock = $book->stock - $request->number;
        if($book->stock < 0){
            $book->stock = 0;
        }
        $book->save();

        return redirect('/books');

      

        
    }

    /**
     * 　在庫　増やす
     */
    public function plus(Request $request,$id){
        $book = \App\Models\Book::find($id);
        $book->stock = $book->stock + $request->number;
        $book->save();

        return redirect('/books');
    }
}
