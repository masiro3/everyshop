<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;


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

        $query = Book::query();

        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('stock', 'LIKE', "%{$keyword}%")
                ->orWhere('price', 'LIKE', "%{$keyword}%")
                ->orWhere('publisher_name', 'LIKE', "%{$keyword}%");
                // ->orWhere('category_name', 'LIKE', "%{$keyword}%");
                
               
             
        }

        $books = $query->get();

        return view('book.search', compact('query', 'keyword'));
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
                
            $book = Book::create([
                'publisher_id' => $request->publisher_id,
                'title' => $request->title,
                'price' => $request->price,
                'stock' => $request->stock,
            ]);
            if(is_array($request->category_id)){
                $book->categories()->sync($request->category_id);
            };

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
        $book_category_ids= array_column($book->categories->toArray(), 'id');

        return view('book.edit')
        ->with([
            'book' => $book,
            'publishers' =>  $publishers,
            'categories' =>  $categories,
            'book_category_ids' =>  $book_category_ids,

        ]);
    }

 
    /**
     * 投稿編集
     */
    public function bookEdit(Request $request){
        $book = \App\Models\Book::where('id', '=', $request->id)->first();
        $book->publisher_id = $request->publisher_id;
        $book->title = $request->title;
        $book->price = $request->price;
        $book->stock = $request->stock;
        $book->save(); 

        if(is_array($request->category_id)){
            $book->categories()->sync($request->category_id);
        }
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
