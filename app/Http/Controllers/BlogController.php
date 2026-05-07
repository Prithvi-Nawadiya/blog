<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogController extends Controller
{
    /**
     * Get all blogs (latest first)
     */
    public function index()
    {
        // Fetch latest blogs with pagination (limit 10)
        $blogs = Blog::latest()->paginate(10);
        
        return response()->json([
            'success' => true,
            'message' => 'Blogs retrieved successfully',
            'data'    => $blogs
        ], 200);
    }

    /**
     * Create a new blog
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'category' => 'required|string|max:255',
            'image'    => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'data'    => $validator->errors()
            ], 422);
        }

        $blog = Blog::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Blog created successfully',
            'data'    => $blog
        ], 201);
    }

    /**
     * Get a single blog by ID
     */
    public function show($id)
    {
        try {
            // using findOrFail as per requirement
            $blog = Blog::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'message' => 'Blog retrieved successfully',
                'data'    => $blog
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Blog not found',
                'data'    => null
            ], 404);
        }
    }

    /**
     * Update an existing blog
     */
    public function update(Request $request, $id)
    {
        try {
            // using findOrFail to handle empty results
            $blog = Blog::findOrFail($id);
            
            $validator = Validator::make($request->all(), [
                'title'    => 'sometimes|required|string|max:255',
                'content'  => 'sometimes|required|string',
                'category' => 'sometimes|required|string|max:255',
                'image'    => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation errors',
                    'data'    => $validator->errors()
                ], 422);
            }

            $blog->update($validator->validated());

            return response()->json([
                'success' => true,
                'message' => 'Blog updated successfully',
                'data'    => $blog
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Blog not found',
                'data'    => null
            ], 404);
        }
    }

    /**
     * Delete a blog
     */
    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $blog->delete();

            return response()->json([
                'success' => true,
                'message' => 'Blog deleted successfully',
                'data'    => null
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Blog not found',
                'data'    => null
            ], 404);
        }
    }

    /**
     * Filter blogs (AJAX ready)
     */
    public function filter(Request $request)
    {
        $query = Blog::query();

        // Search by title (LIKE)
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category', $request->category);
        }

        // Exact date filter: YYYY-MM-DD (optional)
        if ($request->has('date') && !empty($request->date)) {
            // Expecting a single exact date: return blogs published on that date
            $query->whereDate('created_at', '=', $request->date);
        } else {
            // Backwards compatibility: support start_date/end_date
            if ($request->has('start_date') && !empty($request->start_date)) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }

            if ($request->has('end_date') && !empty($request->end_date)) {
                $query->whereDate('created_at', '<=', $request->end_date);
            }

            // Backwards compatibility for date_filter shortcuts (latest/oldest/this_week/this_month)
            if ($request->has('date_filter') && !empty($request->date_filter)) {
                $filter = $request->date_filter;
                if ($filter === 'this_week') {
                    $startOfWeek = now()->startOfWeek();
                    $query->where('created_at', '>=', $startOfWeek);
                } elseif ($filter === 'this_month') {
                    $startOfMonth = now()->startOfMonth();
                    $query->where('created_at', '>=', $startOfMonth);
                }
            }
        }

        // Sorting: default latest first; support 'oldest' via date_filter
        if ($request->has('date_filter') && $request->date_filter === 'oldest') {
            $blogs = $query->orderBy('created_at', 'asc')->paginate(10);
        } else {
            $blogs = $query->orderBy('created_at', 'desc')->paginate(10);
        }

        return response()->json([
            'success' => true,
            'message' => 'Filtered blogs retrieved successfully',
            'data'    => $blogs
        ], 200);
    }
}
