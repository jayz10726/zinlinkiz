<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $slides = CarouselSlide::orderBy('sort_order')->get();
        return view('admin.carousel.index', compact('slides'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'subtitle'         => 'nullable|string|max:255',
            'description'      => 'nullable|string|max:500',
            'image'            => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'badge_text'       => 'nullable|string|max:100',
            'btn_primary_text' => 'required|string|max:100',
            'btn_primary_url'  => 'required|string|max:255',
            'btn_secondary_text' => 'nullable|string|max:100',
            'btn_secondary_url'  => 'nullable|string|max:255',
            'stat_1_value'     => 'nullable|string|max:50',
            'stat_1_label'     => 'nullable|string|max:50',
            'stat_2_value'     => 'nullable|string|max:50',
            'stat_2_label'     => 'nullable|string|max:50',
            'stat_3_value'     => 'nullable|string|max:50',
            'stat_3_label'     => 'nullable|string|max:50',
        ]);

        $data = $request->except('image');
        $data['is_active']  = $request->has('is_active');
        $data['sort_order'] = CarouselSlide::count();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('carousel', 'public');
        }

        CarouselSlide::create($data);

        return redirect()->route('admin.carousel')
                         ->with('success', 'Slide "' . $request->title . '" added successfully.');
    }

    public function update(Request $request, $id)
    {
        $slide = CarouselSlide::findOrFail($id);

        $request->validate([
            'title'            => 'required|string|max:255',
            'subtitle'         => 'nullable|string|max:255',
            'description'      => 'nullable|string|max:500',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'btn_primary_text' => 'required|string|max:100',
            'btn_primary_url'  => 'required|string|max:255',
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($slide->image) {
                Storage::disk('public')->delete($slide->image);
            }
            $data['image'] = $request->file('image')->store('carousel', 'public');
        }

        $slide->update($data);

        return redirect()->route('admin.carousel')
                         ->with('success', 'Slide updated successfully.');
    }

    // Move slide up or down
    public function reorder(Request $request)
    {
        $request->validate([
            'id'        => 'required|exists:carousel_slides,id',
            'direction' => 'required|in:up,down',
        ]);

        $slide = CarouselSlide::findOrFail($request->id);

        if ($request->direction === 'up') {
            $swap = CarouselSlide::where('sort_order', '<', $slide->sort_order)
                                 ->orderBy('sort_order', 'desc')
                                 ->first();
        } else {
            $swap = CarouselSlide::where('sort_order', '>', $slide->sort_order)
                                 ->orderBy('sort_order', 'asc')
                                 ->first();
        }

        if ($swap) {
            $oldOrder  = $slide->sort_order;
            $slide->update(['sort_order' => $swap->sort_order]);
            $swap->update(['sort_order' => $oldOrder]);
        }

        return redirect()->route('admin.carousel')
                         ->with('success', 'Slide order updated.');
    }

    public function toggleActive($id)
    {
        $slide = CarouselSlide::findOrFail($id);
        $slide->update(['is_active' => !$slide->is_active]);

        $status = $slide->fresh()->is_active ? 'activated' : 'hidden';
        return back()->with('success', 'Slide "' . $slide->title . '" ' . $status . '.');
    }

    public function destroy($id)
    {
        $slide = CarouselSlide::findOrFail($id);

        if ($slide->image) {
            Storage::disk('public')->delete($slide->image);
        }

        $title = $slide->title;
        $slide->delete();

        return back()->with('success', 'Slide "' . $title . '" deleted.');
    }
}