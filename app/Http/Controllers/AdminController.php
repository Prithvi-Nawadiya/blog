<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $blogs = Blog::where('user_id', Auth::id())->latest()->paginate(10);
        return view('admin.dashboard', compact('blogs'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blogs', 'public');
            // store the storage disk path (e.g. 'blogs/..jpg')
            $data['image'] = $path;
        }

        $data['user_id'] = Auth::id();

        Blog::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Blog created successfully.');
    }

    /**
     * Handle CKEditor image uploads (AJAX).
     */
    public function uploadImage(Request $request)
    {
        // only allow authenticated users
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (!$request->hasFile('upload')) {
            return response()->json(['error' => 'No file uploaded'], 422);
        }

        $file = $request->file('upload');
        $validator = \Validator::make($request->all(), [
            'upload' => 'image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $path = $file->store('blogs', 'public');
        $url = Storage::url($path);

        // CKEditor expects { "url": "..." }
        return response()->json(['url' => $url], 201);
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->user_id !== Auth::id() && $blog->user_id !== null) { abort(403, 'Unauthorized action.'); }
        return view('admin.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->user_id !== Auth::id() && $blog->user_id !== null) { abort(403, 'Unauthorized action.'); }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blogs', 'public');
            // store disk path (e.g. 'blogs/xxxx.jpg')
            $data['image'] = $path;
        }

        $blog->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Blog updated successfully.');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->user_id !== Auth::id() && $blog->user_id !== null) { abort(403, 'Unauthorized action.'); }

        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Blog deleted successfully.');
    }
}
