<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create(['name' => 'ゆきな',
        'email' => 'will@abc',
        'password' => Hash::make('willwillaa'),]);

        $category1 = Category::create(['category_name' => '雑誌']);
        Category::create(['category_name' => '漫画']);
        Category::create(['category_name' => '小説']);
        Category::create(['category_name' => 'ビジネス']);
        Category::create(['category_name' => '暮らし']);
        Category::create(['category_name' => '趣味']);
        Category::create(['category_name' => '芸能']);
        Category::create(['category_name' => '旅行']);
        Category::create(['category_name' => '絵本']);
        Category::create(['category_name' => 'その他（カテゴリー）']);

        $publisher1 = Publisher::create(['publisher_name' => 'A社']);
        Publisher::create(['publisher_name' => 'B社']);
        Publisher::create(['publisher_name' => 'C社']);
        Publisher::create(['publisher_name' => 'D社']);
        Publisher::create(['publisher_name' => 'その他(出版社)']);

        
     $book1 = new Book([
      'title' => 'VoVo',
     'price' => 500,
     'stock' => 30,
    ]); 
    $book1->category()->associate($category1);
    $book1->publisher()->associate($publisher1);
    $book1->user()->associate($user1);
    $book1->save();
    }
}
