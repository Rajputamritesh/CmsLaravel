<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\Category;
use App\Post;
use Illuminate\Support\Facades\Hash;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $user1=App\User::create([
            'name'=>'john doe',
            'email'=>'jonny@123',
            'role'=>'writer',
            'password'=>Hash::make('password')
    
        ]);
    
    
    
        $user2=App\User::create([
            'name'=>'jsepho doe',
            'email'=>'joy@123',
            'role'=>'writer',
            'password'=>Hash::make('password')
    
        ]);
        $user3=App\User::create([
            'name'=>'ani  doe',
            'email'=>'anny@123',
            'role'=>'writer',
            'password'=>Hash::make('password')
    
        ]);

        //
    $category1=Category::create([
        'title'=>'News'


    ]);


    $category2=Category::create([
        'title'=>'Partnership'


    ]);


    $category3=Category::create([
        'title'=>'Marketing'


    ]);

    $category4=Category::create([
        'title'=>'finanace'


    ]);


    $post1=$user1->posts()->create([
        'title'=>"We relocate our office",
        'description'=>'lorem10 ipsumlorem10 ipsumlorem10 ipsumlorem10 ipsumlorem10 ipsumlorem10 ipsumlorem10 ipsum',
        'content'=>'lorem lorem lorem lorem lorem lorem lorem lorem lorem ',
        'category_id'=>$category1->id,

        'image' => 'storage/posts/6.jpg' 



    ]);
    
    $post2=$user1->posts()->create([
        'title'=>"We relocate our office",
        'description'=>'lorem10 ipsumlorem10 ipsumlorem10 ipsumlorem10 ipsumlorem10 ipsumlorem10 ipsumlorem10 ipsum',
        'content'=>'lorem lorem lorem lorem lorem lorem lorem lorem lorem ',
        'category_id'=>$category2->id,

        'image' => 'storage/posts/7.jpg' 


    ]);
    
    $post3= $user2->posts()->create([
        'title'=>"We relocate our office",
        'description'=>'lorem10 ipsumlorem10 ipsumlorem10 ipsumlorem10 ipsumlorem10 ipsumlorem10 ipsumlorem10 ipsum',
        'content'=>'lorem lorem lorem lorem lorem lorem lorem lorem lorem ',
        'category_id'=>$category3->id,

        'image' => 'storage/posts/8.jpg' 


    ]);
    
    $post4=$user3->posts()->create([
        'title'=>"We relocate our office",
        'description'=>'lorem10 ipsumlorem10 ipsumlorem10 ipsumlorem10 ipsumlorem10 ipsumlorem10 ipsumlorem10 ipsum',
        'content'=>'lorem lorem lorem lorem lorem lorem lorem lorem lorem ',
        'category_id'=>$category4->id,
        'image' => 'storage/posts/9.jpg' 



    ]);

    $tag1=Tag::create([

        'name'=>'customers'

    ]);
    $tag2=Tag::create([

        'name'=>'programming'

    ]);

    $tag3=Tag::create([
        
        
        'name'=>'lifestyle'

    ]);












    $post1->tags()->attach([$tag1->id,$tag2->id]);
    $post2->tags()->attach([$tag3->id,$tag2->id]);
    $post3->tags()->attach([$tag1->id,$tag3->id]);
    $post4->tags()->attach([$tag3->id,$tag2->id]);


    }


     


}



