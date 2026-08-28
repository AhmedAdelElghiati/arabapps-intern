<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryIndexRequest;
use App\Http\Requests\GalleryStoreRequest;
use App\Http\Requests\GalleryUpdateRequest;
use App\Models\Gallery;
use App\Services\Admin\GalleryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function __construct(
        protected GalleryService $galleryService
    ) {}

    public function index(GalleryIndexRequest $request): View
    {
        $galleries = $this->galleryService->getPaginatedGalleries($request->query('q'), 15);
        return view('galleries.index', compact('galleries'));
    }

    public function show(Gallery $gallery): View
    {
        return view('galleries.show', compact('gallery'));
    }

    public function create(): View
    {
        return view('galleries.create');
    }

    public function store(GalleryStoreRequest $request): RedirectResponse
    {
        $gallery = $this->galleryService->createGallery($request->validated());
        return redirect()
            ->route('galleries.index')
            ->with('success', __('pages/galleries.messages.created'));
    }


    public function edit(Gallery $gallery): View
    {
        return view('galleries.edit', compact('gallery'));
    }


    public function update(GalleryUpdateRequest $request, Gallery $gallery): RedirectResponse
    {
        $this->galleryService->updateGallery($gallery, $request->validated());

        return redirect()
            ->route('galleries.index')
            ->with('success', __('pages/galleries.messages.updated'));
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        $this->galleryService->deleteGallery($gallery);

        return redirect()
            ->route('galleries.index')
            ->with('success', __('pages/galleries.messages.deleted'));
    }
}
