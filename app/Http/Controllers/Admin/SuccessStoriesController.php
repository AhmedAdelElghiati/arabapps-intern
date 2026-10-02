<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSuccessStoryRequest;
use App\Http\Requests\UpdateSuccessStoryRequest;
use App\Models\SuccessStory;
use App\Services\Admin\SuccessStoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class SuccessStoriesController extends Controller
{
    public function __construct(
        protected SuccessStoryService $successStoryService
    ) {}

    public function index(): View
    {
        $stories = $this->successStoryService->getPaginatedStories(15);

        return view('admin.success_stories.index', compact('stories'));
    }

    public function create(): View
    {
        return view('admin.success_stories.create');
    }

    public function store(StoreSuccessStoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_top_scored'] = $request->boolean('is_top_scored');

        if ($request->hasFile('photo')) {
            $data['photo_url'] = $request->file('photo')->store('success_stories', 'public');
        }

        $data['created_by'] = auth()->id() ?? 1;
        $this->successStoryService->createStory($data);

        return redirect()
            ->route('success-stories.index')
            ->with('success', __('pages/top_students.messages.created_success') ?? 'Success story created.');
    }

    public function show(SuccessStory $successStory): View
    {
        return view('admin.success_stories.show', compact('successStory'));
    }

    public function edit(SuccessStory $successStory): View
    {
        return view('admin.success_stories.edit', compact('successStory'));
    }

    public function update(UpdateSuccessStoryRequest $request, SuccessStory $successStory): RedirectResponse
    {
        $data = $request->validated();
        $data['is_top_scored'] = $request->boolean('is_top_scored');
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($successStory->photo_url && Storage::disk('public')->exists($successStory->photo_url)) {
                Storage::disk('public')->delete($successStory->photo_url);
            }

            $data['photo_url'] = $request->file('photo')->store('success_stories', 'public');
        }

        $this->successStoryService->updateStory($successStory, $data);

        return redirect()
            ->route('success-stories.index')
            ->with('success', __('pages/top_students.index.success_update'));
    }

    public function destroy(SuccessStory $successStory): RedirectResponse
    {
        if ($successStory->photo_url && Storage::disk('public')->exists($successStory->photo_url)) {
            Storage::disk('public')->delete($successStory->photo_url);
        }

        $this->successStoryService->deleteStory($successStory);

        return redirect()
            ->route('success-stories.index')
            ->with('success', __('pages/top_students.index.success_delete'));
    }
}
