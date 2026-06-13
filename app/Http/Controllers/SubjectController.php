<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\Resource;
use App\Models\Subject;
use Inertia\Inertia;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('sort_order', 'asc')->withCount('nodes')->get();

        return Inertia::render('Home', [
            'subjects' => $subjects,
            'subjectCount' => $subjects->count(),
            'resourceCount' => Resource::count(),
            'siteTraffic' => 500,
        ]);
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
