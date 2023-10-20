<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;

class PostController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:post-list|post-create|post-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:post-create', ['only' => ['create','store']]);
        $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }
  
    /*public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Post::select(['id', 'title', 'content', 'created_at'])
                ->orderBy('created_at', 'desc');

            if ($request->has('search') && !empty($request->input('search'))) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%$search%")
                        ->orWhere('content', 'like', "%$search%");
                });
            }

            return DataTables::of($query)
                ->make(true);
        }

        return view('posts.index');
    }*/

public function index(Request $request)
{
    if ($request->ajax()) {
        $query = Post::query()
            ->orderBy('created_at', 'desc');
        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('content', 'like', "%$search%");
            });
        }

        return DataTables::of($query)
            ->addColumn('action', function (Post $post) {
                
                $editRoute = route('posts.edit', $post->id);
                
                $showRoute = route('posts.show', $post->id);
    
                $deleteRoute = route('posts.destroy', $post->id);
            
                return '<a href="' . $editRoute . '" class="btn btn-primary">Edit</a>' .
                       '<a href="' . $showRoute . '" class="btn btn-success">View</a>' .
                       '<form method="POST" action="' . $deleteRoute . '" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('posts.index');
}




/*public function show(Post $post)
{
    dd($post);
    return view('posts.show', compact('post'));
}*/

/*public function show($postId)
{
    $post = Post::find($postId);
    $comments = $post->comments; // Assuming you have a "comments" relationship in your Post model
    $comments = Comment::where('post_id', $id)->with('user')->get();


    return view('posts.show', compact('post', 'comments'));
}
 */


 public function show($id)
    {
        // Retrieve the specific post
        $post = Post::findOrFail($id);

        // Retrieve comments associated with the post, along with their users
        $comments = Comment::where('post_id', $id)->with('user')->get();

        // Return the view with the post and comments data
        return view('posts.show', compact('post', 'comments'));
    }
    public function show1(Request $request)
{
    if ($request->ajax()) {
        $data = Post::select('id', 'title', 'content', 'created_at')
            ->with('user:name') // Assuming 'user' is the relationship between Post and User models
            ->get();

        return Datatables::of($data)
            ->addColumn('author', function ($row) {
                return $row->user->name ?? 'N/A';
            })
            ->make(true);
    }

    return view('posts.show');
}


// app/Http/Controllers/PostController.php
/*public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'comments_enabled' => 'boolean',
    ]);

    $data['comments_enabled'] = $request->has('comments_enabled');

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('public/images');
        $data['image'] = basename($imagePath);
    }

    $post = Post::create($data);

    return redirect()->route('posts.index', $post->id)->with('success', 'Post created successfully.');
}
*/


    
 public function create()
{
    $commentsEnabled = true;
    return view('posts.create',compact('commentsEnabled'));
}


public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        //'comments_enabled'  => 'boolean',
        'user_id'=>'integer',
    ]);
    $input = $request->all();
    $input['comments_enabled'] = $request->has('comments_enabled');
    $input['user_id'] = auth()->user()->id;

    
    if ($image = $request->file('image')) {
        $destinationPath = 'images/';
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);
        $input['image'] = "$profileImage";
    }
    //dd($input);
    $post = Post::create($input);
        //dd($input);
    return redirect()->route('posts.index')->with('success', 'Post created successfully.');

}


public function edit(Post $post)
{
return view('posts.edit',compact('post'));
}

/*public function update(Request $request, Post $post)
{
$request->validate([
'title' => 'required',
'content' => 'required',


]);
$post->update($request->all());

return redirect()->route('posts.index')
->with('success','Post updated successfully');
}*/



public function update(Request $request, POST $post)
    {
        //dd($request->all());
        $request->validate([
            'title' => 'required',
          'content' => 'required',
            //'is_admin'=>'required|boolean',

            // 'password' => 'required|string|min:6',
            //'roles' => 'required|array'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }
        $post->comments_enabled = $request->has('comments_enabled');
        $post->update($input);
        
        return redirect()->route('posts.index')->with('success', 'User update successfully');
    }




public function destroy(Post $post)
{
$post->delete();
return redirect()->route('posts.index')
->with('success','Post deleted successfully');
}



}