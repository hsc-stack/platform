<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NoticeController extends Controller
{
    public function edit()
    {
        return Inertia::render('admin/NoticeEdit', [
            'notice' => Notice::singleton(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'message'      => ['nullable', 'string'],
            'image'        => ['nullable', 'string', 'max:500'],
            'show_button'  => ['required', 'boolean'],
            'button_title' => ['nullable', 'required_if:show_button,true', 'string', 'max:100'],
            'button_link'  => ['nullable', 'required_if:show_button,true', 'string', 'max:500'],
            'is_active'    => ['required', 'boolean'],
        ]);

        // Clear button fields when show_button is off
        if (!$data['show_button']) {
            $data['button_title'] = null;
            $data['button_link']  = null;
        }

        Notice::singleton()->update($data);

        return redirect()->route('admin.notice.edit')->with('success', 'Notice updated.');
    }
}
