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
                ->orWhere('publisher_id', 'LIKE', "%{$keyword}%");
                // ->orWhere('category_id', 'LIKE', "%{$keyword}%");
        }

        $books = $query->get();

        return view('search', compact('books', 'keyword'));
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $books = Book::all();

    
        // $books = \DB::table('books')->get();  

        return view('book.index', compact('books'));
    }

    //     $books = Book::all();

    //     return view('book.index', ['books' => $books]);
    // }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        

        if ($request->isMethod('post')) {
                
            
            $book = Book::create([
                // $books = new Book;
                // $form = $request->all();
                // unset($form['_token']);
                // $book->fill($form)->save();

                'publisher_id' => $request->publisher_id,
                // 'category' => $request->categories,
                'title' => $request->title,
                'price' => $request->price,
                'stock' => $request->stock,
            ]);
            $book->categories()->sync($request->category_id, false);

            return redirect('/books');
            // return view('books', compact('books'));
        }else{
            $categories = Category::all();
            // 登録画面を表示
        //     $categories => $categories
        //     $categories = MstPrefecture::all();

        //     return view('post.create')
        //         ->with([
        //             'prefectures' => $prefectures,
        //         ]);
        // }
            return view('book.add');
        }

        
    }
}