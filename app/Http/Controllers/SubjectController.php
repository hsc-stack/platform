<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\Notice;
use App\Models\Resource;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class SubjectController extends Controller
{
    public function index()
    {
        $homeData = Cache::rememberForever("home_page_data", function () {
            $subjects = Subject::orderBy('sort_order', 'asc')->withCount('nodes')->get();

            return  [
                'subjects' => $subjects->toArray(),
                'subjectCount' => $subjects->count(),
                'resourceCount' => Resource::count(),
                'contributorCount' => User::count(),
                'notice' => Notice::activeForDisplay()?->toArray(),
            ];
        });

        return Inertia::render('Home', $homeData);
    }

    public function show(Subject $subject)
    {
        $nodes = Node::where('subject_id', $subject->id)
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->withCount(['children', 'resources'])
            ->get(['id', 'name', 'slug']);

        return Inertia::render('Node', [
            'subject'   => $subject,
            'nodes'     => $nodes,
            'breadcrumb' => [],
            'resources' => [],
        ]);
    }
}
