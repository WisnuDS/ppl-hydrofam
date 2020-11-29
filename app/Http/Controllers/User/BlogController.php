<?php

namespace App\Http\Controllers\User;

use App\Comment;
use App\Http\Controllers\Controller;
use Canvas\Models\Post;
use Canvas\Models\PostsTags;
use Canvas\Models\PostsTopics;
use Canvas\Models\Tag;
use Canvas\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

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
        $posts = \App\Post::with(['user','comment'])
            ->where('published_at','<>','NULL')
            ->orderBy('published_at','DESC')->get();
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
        $topics = Topic::with("posts")->limit(10)->orderBy('created_at')->get();
        $recent = $posts = \App\Post::with(['user','comment'])
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
            'post_id' => 'required|string|exists:canvas_posts,id'
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

    public function createNewBlog(Request $request)
    {
        $validation = $request->validate([
            "title" => ["required","string"],
            "slug" => ["required","string","unique:canvas_posts,slug"],
            "category" => ["required","string"],
            "tag" => ["required","string"],
            "content" => ["required","string"],
            "photo" => ["required","image"]
        ]);

        try {
            if ($request->hasFile("photo")){
                $extension = $request->photo->extension();
                $name = uniqid("photo");
                $request->photo->storeAs('/public', $name.".".$extension);
                $url = Storage::url($name.".".$extension);
            }
            //create new post
            $newPost = Post::create([
                "id" => uniqid("post"),
                "slug" => $request->get("slug"),
                "user_id" => \auth()->id(),
                "title" => $request->get("title"),
                "body" => $request->get("content"),
                "published_at" => date("Y-m-d h:m:s",now()->getTimestamp()),
                "featured_image" => $url
            ]);

            //check category exists
            $category_exist = Topic::where('name',$request->get("category"))->get();
            if (sizeof($category_exist)> 0){
                PostsTopics::create([
                    "post_id" => $newPost->id,
                    "topic_id" => $category_exist[0]->id
                ]);
            }else{
                $newTopic = Topic::create([
                    "id" => uniqid("topic"),
                    "slug" => str_replace(" ","-",strtolower($request->get("category"))),
                    "name" => $request->get("category"),
                    "user_id" => \auth()->id()
                ]);

                PostsTopics::create([
                    "post_id" => $newPost->id,
                    "topic_id" => $newTopic->id
                ]);
            }

            $tag_exist = Tag::where('name',$request->get("tag"))->get();
            if (sizeof($tag_exist)> 0){
                PostsTags::create([
                    "post_id" => $newPost->id,
                    "tag_id" => $tag_exist[0]->id
                ]);
            }else{
                $newTag = Tag::create([
                    "id" => uniqid("tag"),
                    "slug" => str_replace(" ","-",strtolower($request->get("tag"))),
                    "name" => $request->get("tag"),
                    "user_id" => \auth()->id()
                ]);

                PostsTags::create([
                    "post_id" => $newPost->id,
                    "tag_id" => $newTag->id
                ]);
            }
            toastSuccess("Success add new post");
            return redirect('blog');
        }catch (Exception $exception){
            return redirect()->back()->withErrors(["Something went wrong"]);
        }
    }

    public function editBlog($id)
    {
        $posts = Post::with(["tags","topic"])->where('id',$id)->get()->first();
        return view('edit_blog')->with(compact('posts'));
    }

    public function updateBlog(Request $request, $id)
    {
        $validation = $request->validate([
            "title" => ["required","string"],
            "slug" => ["required","string"],
            "category" => ["required","string"],
            "tag" => ["required","string"],
            "editor" => ["required","string"],
        ]);

        try {
            if ($request->hasFile("photo")){
                $extension = $request->photo->extension();
                $name = uniqid("photo");
                $request->photo->storeAs('/public', $name.".".$extension);
                $url = Storage::url($name.".".$extension);
            }

            //create new post
            if (isset($url)){
                Post::where('id',$id)->update([
                    "slug" => $request->get("slug"),
                    "user_id" => \auth()->id(),
                    "title" => $request->get("title"),
                    "body" => $request->get("editor"),
                    "published_at" => date("Y-m-d h:m:s",now()->getTimestamp()),
                    "featured_image" => $url
                ]);
            }else{
                Post::where('id',$id)->update([
                    "slug" => $request->get("slug"),
                    "user_id" => \auth()->id(),
                    "title" => $request->get("title"),
                    "body" => $request->get("editor"),
                    "published_at" => date("Y-m-d h:m:s",now()->getTimestamp())
                ]);
            }

            $post = Post::with(["tags","topic"])
                ->where("id",$id)
                ->get()->first();

            //check category exists
            $category_exist = Topic::where('name',$request->get("category"))->get();
            if (sizeof($category_exist)> 0){
                PostsTopics::where('post_id',$id)
                    ->where('topic_id',$post->topic[0]->id)
                    ->update([
                    "topic_id" => $category_exist[0]->id
                ]);
            }else{
                $newTopic = Topic::create([
                    "id" => uniqid("topic"),
                    "slug" => str_replace(" ","-",strtolower($request->get("category"))),
                    "name" => $request->get("category"),
                    "user_id" => \auth()->id()
                ]);

                PostsTopics::where('post_id',$id)->update([
                    "topic_id" => $newTopic->id
                ]);
            }

            $tag_exist = Tag::where('name',$request->get("tag"))->get();
            if (sizeof($tag_exist)> 0){
                PostsTags::where('post_id',$id)
                    ->where('tag_id',$post->tags[0]->id)
                    ->update([
                    "tag_id" => $tag_exist[0]->id
                ]);
            }else{
                $newTag = Tag::create([
                    "id" => uniqid("tag"),
                    "slug" => str_replace(" ","-",strtolower($request->get("tag"))),
                    "name" => $request->get("tag"),
                    "user_id" => \auth()->id()
                ]);

                PostsTags::where('post_id',$id)->update([
                    "tag_id" => $newTag->id
                ]);
            }
            toastSuccess("Success update post");
            return redirect('blog');
        }catch (Exception $exception){
            return redirect()->back()->withErrors(["Something went wrong"]);
        }
    }
}
