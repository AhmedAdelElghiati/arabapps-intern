<x-admin-layout>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h1 class="app-page-title">{{ $gallery->title }}</h1>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('galleries.edit', $gallery->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i> {{ __('pages/galleries.actions.edit') }}
                    </a>
                    <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Are you sure you want to delete this gallery item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-2"></i> {{ __('pages/galleries.actions.delete') }}
                        </button>
                    </form>
                    <a href="{{ route('galleries.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i> {{ __('pages/galleries.actions.back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                @if ($gallery->image)
                                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                                        class="img-fluid rounded" style="max-width: 100%; height: auto;">
                                @else
                                    <div class="alert alert-info">No image available</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">Gallery Details</h5>
                                    <dl class="row">
                                        <dt class="col-sm-4">Title:</dt>
                                        <dd class="col-sm-8">{{ $gallery->title }}</dd>

                                        <dt class="col-sm-4">Created:</dt>
                                        <dd class="col-sm-8">{{ $gallery->created_at->format('Y-m-d H:i') }}</dd>

                                        <dt class="col-sm-4">Updated:</dt>
                                        <dd class="col-sm-8">{{ $gallery->updated_at->format('Y-m-d H:i') }}</dd>

                                        <dt class="col-sm-4">ID:</dt>
                                        <dd class="col-sm-8">{{ $gallery->id }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
