<x-admin-layout>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h1 class="app-page-title">Gallery Items</h1>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <form class="d-flex me-2" method="GET" action="{{ route('galleries.index') }}">
                        <input name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Search title..." aria-label="Search">
                        <button class="btn btn-sm btn-outline-secondary ms-2" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                    <a href="{{ route('galleries.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i> Add New Item
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
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($galleries as $gallery)
                                        <tr>
                                            <td>{{ $gallery->title }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="img-thumbnail" style="max-width: 50px; max-height: 50px;">
                                            </td>
                                            <td>{{ $gallery->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <a href="{{ route('galleries.show', $gallery->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i> Show
                                                </a>
                                                <a href="{{ route('galleries.edit', $gallery->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this gallery item?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No gallery items found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-center">
                    {{ $galleries->links('pagination::bootstrap-4') }}
                </div>
        </div>
    </div>
</x-admin-layout>
