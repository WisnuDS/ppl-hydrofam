<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Canvas\Models\Post;
use Canvas\Models\Tag;
use Canvas\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user'])
            ->where('published_at','<>','NULL')
            ->orderBy('published_at','DESC')
            ->paginate();
        $sidebar = $this->getTags();
        return view('blog',compact('posts','sidebar'));
    }

    public function singlePost($slug)
    {
        $post = Post::with(['user','tags','topic'])
            ->where('published_at','<>','NULL')
            ->where('slug','=',$slug)
            ->get()->first();
        $sidebar = $this->getTags();
        return view('post', compact('post','sidebar'));
    }

    public function getTags()
    {
        $tag = Tag::withoutTrashed()->limit(10)->orderBy('created_at')->get();
        $topics = Topic::withoutTrashed()->limit(10)->orderBy('created_at')->get();
        $recent = $posts = Post::with(['user'])
            ->where('published_at','<>','NULL')
            ->orderBy('published_at','DESC')
            ->limit(3)->get();
        return [
            "tags" => $tag,
            "topics" => $topics,
            "recent" => $recent
        ];
    }
}
