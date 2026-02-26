<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;    

class BlogController extends Controller
{
    /**
     * Display a listing of published blogs.
     */
    public function index(Request $request)
{
    $blogs = Blog::published()
        ->latest()
        ->paginate($request->query('per_page', 12))->withQueryString()->fragment('blog')->onEachSide(12)->withPath('blog');
   
    if ($request->ajax()) {
        return view('frontend.blog.partials.blog-items', compact('blogs'))->render();
    }

    return view('frontend.blog.index', compact('blogs'));
}


    /**
     * Display the specified blog.
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        if (!$blog || $blog->status !== 'published') {
            abort(404);
        }

        $relatedBlogs = Blog::published()
            ->where('id', '!=', $blog->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('frontend.blog.blog-detail', compact('blog', 'relatedBlogs'));
    }


    /**
     * Get latest published blogs for homepage.
     */
    public function latest($limit = 3)
    {
        return Blog::published()
                   ->latest()
                   ->limit($limit)
                   ->get();
    }
}
