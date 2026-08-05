<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSuccessStoryRequest;
use App\Http\Requests\UpdateSuccessStoryRequest;
use App\Models\Course;
use App\Models\SuccessStory;
use App\Services\SuccessStoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SuccessStoriesController extends Controller
{
    public function __construct(
        protected SuccessStoryService $successStoryService
    ) {
    }

    public function index(): View
    {
        $stories = $this->successStoryService->getPaginatedStories(15);

        return view('admin.success_stories.index', compact('stories'));
    }

    public function create(): View
    {
        $courses = Course::pluck('title', 'id');

        return view('admin.success_stories.create', compact('courses'));
    }

    public function store(StoreSuccessStoryRequest $request): RedirectResponse
{
    $this->successStoryService->createStory($request->validated());

    return redirect()
        ->route('success-stories.index')
        ->with('success', 'Success story created successfully.');
}
    public function edit(SuccessStory $successStory): View
    {
        $courses = Course::pluck('title', 'id');

        return view('admin.success_stories.edit', compact('successStory', 'courses'));
    }

    public function update(UpdateSuccessStoryRequest $request, SuccessStory $successStory): RedirectResponse
{
    $this->successStoryService->updateStory($successStory, $request->validated());

    return redirect()
        ->route('success-stories.index')
        ->with('success', 'Success story updated successfully.');
}

   public function destroy(SuccessStory $successStory): RedirectResponse
{
    $this->successStoryService->deleteStory($successStory);

    return redirect()
        ->route('success-stories.index')
        ->with('success', 'Success story deleted successfully.');
}
}
