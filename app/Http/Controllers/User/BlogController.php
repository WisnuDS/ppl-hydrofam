<?php

namespace App\Http\Controllers\User;

use App\Comment;
use App\Http\Controllers\Controller;
use Canvas\Models\Post;
use Canvas\Models\Tag;
use Canvas\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class BlogController
 * @package App\Http\Controllers\User
 */
class BlogController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::with(['user'])
            ->where('published_at','<>','NULL')
            ->orderBy('published_at','DESC')
            ->paginate();
        $sidebar = $this->getSidebarData();
        return view('blog',compact('posts','sidebar'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     */
    public function singlePost($slug)
    {
        $post = Post::with(['user','tags','topic'])
            ->where('published_at','<>','NULL')
            ->where('slug','=',$slug)
            ->get()->first();
        if (empty($post)){
            return abort(404);
        }
        $sidebar = $this->getSidebarData();
        return view('post', compact('post','sidebar'));
    }

    /**
     * @return array
     */
    public function getSidebarData()
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

    public function getComments($post_id)
    {
        $comment = Comment::with(['user'])->where('post_id','=',$post_id)->get();
        return response()->json($comment);
    }

    public function getAuth()
    {
        return response()->json(auth()->user());
    }

    public function createComment(Request $request)
    {
        $validation = $request->validate([
            'comment' => 'required|string',
            'post_id' => 'required|integer|exists:canvas_posts,id'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $request->get('post_id');
        $comment->comment = $request->get('comment');
        $comment->save();

        return response()->json([
            "status" => 200,
            "message" => 'success up comment',
            "comment" => $comment
        ]);
    }
}
