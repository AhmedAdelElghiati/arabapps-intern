<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSuccessStoryRequest;
use App\Http\Requests\UpdateSuccessStoryRequest;
use App\Models\Course;
use App\Models\SuccessStory;
use App\Services\Admin\SuccessStoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class SuccessStoriesController extends Controller
{
    private SuccessStoryService $successStoryService;
    public function __construct(
        protected SuccessStoryService $SuccessStoryService
    ) {
        $this->successStoryService = $SuccessStoryService;
    }

    public function index()
    {
        $stories = $this->successStoryService->getPaginatedStories(15);

        return view('admin.success_stories.index', compact('stories'));
    }

    public function create(): View
    {
        return view('admin.success_stories.create');
    }

    public function store(StoreSuccessStoryRequest $request)
{   $data = $request->validated();
    $data['is_top_scored'] = $request->has('is_top_scored');
    if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('success_stories', 'public');
    }
    $data['created_by'] = 1;
    $this->successStoryService->createStory($data);

    return redirect()
        ->route('admin.success-stories.index')
        ->with('success', '');
}
    public function edit(SuccessStory $successStory)
    {

        return view('admin.success_stories.edit', compact('successStory'));
    }

    public function update(UpdateSuccessStoryRequest $request, SuccessStory $successStory)
{
    $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($successStory->photo_url && Storage::disk('public')->exists($successStory->photo_url)) {
                Storage::disk('public')->delete($successStory->photo_url);
            }

            $data['photo_url'] = $request->file('photo')->store('success_stories', 'public');
        }
    $this->successStoryService->updateStory($successStory, $data);

    return redirect()
        ->route('admin.success-stories.index')
        ->with('success', __('pages/top_students.index.success'));
}

   public function destroy(SuccessStory $successStory)
{
    if ($successStory->photo_path && Storage::disk('public')->exists($successStory->photo_path)) {
            Storage::disk('public')->delete($successStory->photo_path);
        }
    $this->successStoryService->deleteStory($successStory);

    return redirect()
        ->route('admin.success-stories.index')
        ->with('success', __('pages/top_students.index.success'));
}
}
