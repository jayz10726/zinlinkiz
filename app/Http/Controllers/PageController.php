<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        // Load team from DB if table exists, otherwise empty collection
        $team = collect();
        try {
            $team = \App\Models\TeamMember::where('is_active', true)
                        ->orderBy('sort_order')
                        ->get();
        } catch (\Exception $e) {
            // Table doesn't exist yet — run migrations
        }
        return view('pages.about', compact('team'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contactSend(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'email'   => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string|min:10',
        ]);

        return redirect()->route('contact')
                         ->with('contact_success', true);
    }

    public function reviews()
    {
        $reviews    = collect();
        $avgRating  = 5.0;
        $totalCount = 0;
        $breakdown  = [];

        // Build default breakdown
        for ($i = 5; $i >= 1; $i--) {
            $breakdown[$i] = ['count' => 0, 'pct' => 0];
        }

        try {
            $reviews    = \App\Models\Review::where('status', 'approved')
                              ->latest()
                              ->paginate(12);
            $avgRating  = \App\Models\Review::where('status', 'approved')->avg('rating') ?? 5.0;
            $totalCount = \App\Models\Review::where('status', 'approved')->count();

            for ($i = 5; $i >= 1; $i--) {
                $count        = \App\Models\Review::where('status', 'approved')->where('rating', $i)->count();
                $pct          = $totalCount > 0 ? round(($count / $totalCount) * 100) : 0;
                $breakdown[$i] = ['count' => $count, 'pct' => $pct];
            }
        } catch (\Exception $e) {
            // reviews table doesn't exist yet — run: php artisan migrate
            $reviews = new \Illuminate\Pagination\LengthAwarePaginator(
                [], 0, 12
            );
        }

        return view('pages.reviews', compact('reviews', 'avgRating', 'totalCount', 'breakdown'));
    }

    public function reviewsStore(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'product' => 'nullable|string|max:255',
            'rating'  => 'required|integer|min:1|max:5',
            'review'  => 'required|string|min:10',
        ]);

        try {
            $name   = $request->name;
            $parts  = explode(' ', trim($name));
            $initials = strtoupper(
                substr($parts[0], 0, 1) .
                (isset($parts[1]) ? substr($parts[1], 0, 1) : '')
            );

            $colors = [
                'bg-blue-600', 'bg-emerald-600', 'bg-pink-600',
                'bg-purple-600', 'bg-orange-600', 'bg-teal-600',
            ];

            \App\Models\Review::create([
                'customer_name'  => $name,
                'product_bought' => $request->product,
                'rating'         => $request->rating,
                'review_text'    => $request->review,
                'status'         => 'pending',
                'is_featured'    => false,
                'initials'       => $initials,
                'avatar_color'   => $colors[array_rand($colors)],
            ]);
        } catch (\Exception $e) {
            return redirect()->route('reviews')
                             ->with('review_error', 'Could not save review. Please try again.');
        }

        return redirect()->route('reviews')
                         ->with('review_success', true);
    }
}