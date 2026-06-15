<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\Notice;
use App\Models\Resource;
use App\Models\Subject;
use App\Models\User;
use Inertia\Inertia;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('sort_order', 'asc')->withCount('nodes')->get();
        $notice = Notice::activeForDisplay();

        return Inertia::render('Home', [
            'subjects' => $subjects,
            'subjectCount' => $subjects->count(),
            'resourceCount' => Resource::count(),
            'contributorCount' => User::count(),
            'notice' => $notice,
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
