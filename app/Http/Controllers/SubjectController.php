<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Inertia\Inertia;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('sort_order', 'asc')->withCount('nodes')->get();

        return Inertia::render('Home', [
            'subjects' => $subjects
        ]);
    }
}
