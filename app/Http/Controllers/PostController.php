<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
  
    public function index(Request $request)
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
    }
}
