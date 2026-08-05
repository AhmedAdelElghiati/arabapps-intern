<?php

namespace App\Http\Controllers;

use App\Models\SuccessStory;
use App\Models\Course;
use App\Http\Requests\StoreSuccessStoryRequest;
use App\Http\Requests\UpdateSuccessStoryRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SuccessStoryController extends Controller
{
    /**
     * Display a paginated listing of success stories.
     */
    public function index(): View
    {
    $stories = SuccessStory::with('course')
        ->ordered()
        ->paginate(10);

    return view('success_stories.index', compact('stories'));
    }

    /**
     * Show the form for creating a new success story.
     */
    public function create(): View
    {
        $courses = Course::pluck('name', 'id');

        return view('success_stories.create', compact('courses'));
    }

    public function store(StoreSuccessStoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_top_scored'] = $request->has('is_top_scored');

        SuccessStory::create($data);

        return redirect()
            ->route('success-stories.index')
            ->with('success', 'Success story created successfully.');
    }

    /**
     * Display the specified success story.
     */
    public function show(SuccessStory $successStory): View
    {
        $successStory->load(['course', 'creator']);

        return view('success_stories.show', compact('successStory'));
    }

    /**
     * Show the form for editing the specified success story.
     */
    public function edit(SuccessStory $successStory): View
    {
        $courses = Course::pluck('name', 'id');

        return view('success_stories.edit', compact('successStory', 'courses'));
    }

    /**
     * Update the specified success story in storage.
     */
    public function update(UpdateSuccessStoryRequest $request, SuccessStory $successStory): RedirectResponse
    {
        $data = $request->validated();
        $data['is_top_scored'] = $request->has('is_top_scored');

        $successStory->update($data);

        return redirect()
            ->route('success-stories.index')
            ->with('success', 'Success story updated successfully.');
    }

    /**
     * Remove the specified success story from storage.
     */
    public function destroy(SuccessStory $successStory): RedirectResponse
    {
        $successStory->delete();

        return redirect()
            ->route('success-stories.index')
            ->with('success', 'Success story deleted successfully.');
    }
}
