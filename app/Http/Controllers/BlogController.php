<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::query()
            ->select([
                'id',
                'user_id',
                'title',
                'slug',
                'excerpt',
                'featured_image',
                'is_featured',
                'views',
                'created_at',
            ])
            ->with('user:id,name')
            ->where('is_published', true);

        if ($request->filled('q')) {
            $blogs->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->q . '%')
                    ->orWhere('excerpt', 'like', '%' . $request->q . '%')
                    ->orWhere('seo_tags', 'like', '%' . $request->q . '%');
            });
        }

        $blogs = $blogs
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return Inertia::render('Blog/Index', [
            'blogs' => $blogs,
        ]);
    }

    public function show(Blog $blog)
    {
        abort_unless($blog->is_published, 404);

        $blog->load('user:id,name');

        $blog->increment('views');

        return Inertia::render('Blog/Show',[
            'blog' => $blog,
        ]);
    }
}
