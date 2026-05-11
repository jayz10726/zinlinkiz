<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::latest();
        if ($request->status) $query->where('status', $request->status);
        if ($request->rating) $query->where('rating', $request->rating);
        $reviews = $query->paginate(15);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'rating'        => 'required|integer|min:1|max:5',
            'review_text'   => 'required|string|min:5',
        ]);

        $name   = $request->customer_name;
        $parts  = explode(' ', trim($name));
        $initials = strtoupper(substr($parts[0],0,1).(isset($parts[1]) ? substr($parts[1],0,1) : ''));

        Review::create([
            'customer_name'  => $name,
            'customer_email' => $request->customer_email,
            'product_bought' => $request->product_bought,
            'location'       => $request->location,
            'rating'         => $request->rating,
            'review_text'    => $request->review_text,
            'status'         => 'approved',
            'is_featured'    => $request->has('is_featured'),
            'initials'       => $initials,
            'avatar_color'   => $request->avatar_color ?? 'bg-blue-600',
        ]);

        return redirect()->route('admin.reviews')->with('success', 'Review added and published.');
    }

    public function approve($id)
    {
        Review::findOrFail($id)->update(['status' => 'approved']);
        return back()->with('success', 'Review approved — now visible on the website.');
    }

    public function reject($id)
    {
        Review::findOrFail($id)->update(['status' => 'rejected']);
        return back()->with('success', 'Review rejected and hidden.');
    }

    public function toggleFeatured($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['is_featured' => !$review->is_featured]);
        $msg = $review->fresh()->is_featured ? 'Review featured on homepage.' : 'Review removed from featured.';
        return back()->with('success', $msg);
    }

    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return back()->with('success', 'Review deleted permanently.');
    }
}