<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use Auth;
use Validator;

class PostsController extends Controller
{
    public function show(Request $request){
        $posts = Post::with('user', 'postComments')->get();
        $main_categories = MainCategory::get();
        $sub_categories = SubCategory::get();
        $like = new Like;
        $post_comment = new Post;
        if(!empty($request->keyword)){
            $posts = Post::with('user', 'postComments','subCategories')
            ->where('post_title', 'like', '%'.$request->keyword.'%')
            ->orWhere('post', 'like', '%'.$request->keyword.'%')
            ->orWhereHas('subCategories',function ($q) use ($request){
                $q->where('sub_category',$request->keyword);
            })
            ->get();
        }else if($request->category_word){
            $sub_category = $request->category_word;
            $posts = Post::with('user', 'postComments')->get();
        }else if($request->like_posts){
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments')
            ->whereIn('id', $likes)->get();
        }else if($request->my_posts){
            $posts = Post::with('user', 'postComments')
            ->where('user_id', Auth::id())->get();
        }
        return view('authenticated.bulletinboard.posts', compact('posts', 'main_categories','sub_categories', 'like', 'post_comment'));
    }

    public function postDetail($post_id){
        $post = Post::with('user', 'postComments','subCategories')->findOrFail($post_id);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    public function postInput(){
        $main_categories = MainCategory::get();
        $sub_categories = SubCategory::get();
        return view('authenticated.bulletinboard.post_create', compact('main_categories','sub_categories'));
    }

    public function postCreate(PostFormRequest $request){
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        $sub_category_id = $request->sub_category;
        $post->subCategories()->attach($sub_category_id);
        return redirect()->route('post.show');
    }

    public function postEdit(Request $request){
        $request->validate([
            'post_title' => ['required', 'string', 'max:100'],
            'post_body' => ['required', 'string', 'max:5000']
        ],
        [
            'post_title.required' => '※タイトルは必須です。',
            'post_title.max' => '※タイトルは100文字以内で記入してください。',
            'post_body.required' => '※投稿内容は必須です。',
            'post_body.max' => '※投稿内容は5000文字以内で記入してください。。',
        ]);
        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function postDelete($id){
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }
    public function mainCategoryCreate(Request $request){
        $request->validate([
            'main_category' => ['required', 'string', 'max:100','unique:main_categories']
        ],
        [
            'main_category.required' => '※メインカテゴリー名は必須です。',
            'main_category.max' => '※100文字以内で記入してください。',
            'main_category.unique' => '※既に登録されています。',
        ]);
        MainCategory::create(['main_category' => $request->main_category]);
        return redirect()->route('post.input');
    }
    public function subCategoryCreate(Request $request){
        $request->validate([
            'main_category_id' => ['required', 'exists:main_categories,id'],
            'sub_category' => ['required', 'string', 'max:100','unique:sub_categories'],
        ],
        [
            'main_category_id.required' => '※メインカテゴリーは必須です。',
            'main_category_id.exists' => '※登録済みのメインカテゴリーから選択してください。',
            'sub_category.required' => '※サブカテゴリーは必須です。',
            'sub_category.max' => '※サブカテゴリー100文字以内で記入してください。',
            'sub_category.unique' => '※既に登録されています。',
        ]);

        SubCategory::create([
            'main_category_id' => $request->main_category_id,
            'sub_category' => $request->sub_category
        ]);
        return redirect()->route('post.input');
    }

    public function commentCreate(Request $request){
        $request->validate([
            'comment' => ['required', 'string', 'max:2500']
        ],
        [
            'comment.required' => '※コメント内容は必須です。',
            'comment.max' => '※コメントは2500文字以内で記入してください。',
        ]);

        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard(){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }

    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        return response()->json();
    }

    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
             ->where('like_post_id', $post_id)
             ->delete();

        return response()->json();
    }
}
