<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\StoreResourceRequest;
use App\Http\Requests\Resource\UpdateResourceRequest;
use App\Models\Node;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ResourceController extends Controller
{

    public function create(Request $request)
    {
        $node = Node::findOrFail($request->node_id);


        return Inertia::render('admin/ResourceCreateOrEdit', [
            'redirect' => url()->previous(),
            'node' => $node
        ]);
    }
    public function edit(Resource $resource)
    {
        $node = $resource->node;


        return Inertia::render('admin/ResourceCreateOrEdit', [
            'redirect' =>  url()->previous(),
            'node' => $node,
            'resource' => $resource,
        ]);
    }

    public function store(StoreResourceRequest $request)
    {
        $validated = $request->validated();

        $fileUrl = null;

        if ($request->hasFile('file')) {
            $path    = $request->file('file')->store("resources/{$validated['resource_type']}s", 'public');
            $fileUrl = Storage::url($path);
            $validated['file_url'] = $fileUrl;
        }

        Resource::create($validated);

        $redirect = $validated['redirect'] ?? explode('/resources', url()->previous())[0];

        return redirect($redirect)->with('success', 'Resource created successfully.');
    }


    public function update(UpdateResourceRequest $request, Resource $resource)
    {

        $validated = $request->validated();

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($resource->file_url) {
                $oldPath = str_replace('/storage/', '', parse_url($resource->file_url, PHP_URL_PATH));
                Storage::disk('public')->delete($oldPath);
            }

            $type    = $validated['resource_type'] ?? $resource->resource_type;
            $path    = $request->file('file')->store("resources/{$type}s", 'public');
            $resource->file_url = Storage::url($path);
        }

        $resource->update($validated);

        $redirect = $validated['redirect'] ?? "/admin/subjects";

        return redirect($redirect)->with('success', 'Resource updated successfully.');
    }

    public function destroy(Resource $resource)
    {
        if ($resource->file_url) {
            $oldPath = str_replace('/storage/', '', parse_url($resource->file_url, PHP_URL_PATH));
            Storage::disk('public')->delete($oldPath);
        }

        $resource->delete();

        return redirect()->back()->with('success', 'Resource deleted successfully.');
    }
}
