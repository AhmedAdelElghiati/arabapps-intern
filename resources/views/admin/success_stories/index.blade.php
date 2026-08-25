<x-admin-layout>
@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 text-dark mb-0">Success Stories</h2>
        <a href="{{ route('admin.success-stories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add New Story
        </a>
    </div>

    <!-- Success Flash Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Content Card / Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 80px;">Photo</th>
                            <th>Name</th>
                            <th>Track</th>
                            <th>Grade</th>
                            <th class="text-center">Order</th>
                            <th class="text-center">Top Scored</th>
                            <th class="text-center">Status</th>
                            <th class="text-end" style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stories as $story)
                            <tr>
                                <!-- Photo -->
                                <td>
                                    @if ($story->photo_url)
                                        <img src="{{ asset('storage/' . $story->photo_url) }}"
                                             alt="{{ $story->name }}"
                                             class="rounded-circle object-fit-cover"
                                             width="45"
                                             height="45">
                                    @else
                                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                                             style="width: 45px; height: 45px; font-size: 14px;">
                                            {{ strtoupper(substr($story->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </td>

                                <!-- Student Name & Quote Preview -->
                                <td>
                                    <div class="fw-bold text-dark">{{ $story->name }}</div>
                                    @if($story->description)
                                        <small class="text-muted d-block text-truncate" style="max-width: 250px;">
                                            "{{ $story->description }}"
                                        </small>
                                    @endif
                                </td>

                                <!-- Track -->
                                <td>
                                    {{ $story->track ?? '-' }}
                                </td>

                                <!-- Grade -->
                                <td>
                                    {{ $story->grade ?? '-' }}
                                </td>

                                <!-- Display Order -->
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border">
                                        {{ $story->display_order ?? 0 }}
                                    </span>
                                </td>

                                <!-- Top Scored Badge -->
                                <td class="text-center">
                                    @if ($story->is_top_scored)
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-star-fill me-1"></i> Top Scored
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>

                                <!-- Active Status Badge -->
                                <td class="text-center">
                                    @if ($story->is_active)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.success-stories.edit', $story->id) }}"
                                           class="btn btn-outline-primary"
                                           title="Edit Story">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.success-stories.destroy', $story->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this success story?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger rounded-end" title="Delete Story">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <p class="mb-2">No success stories found.</p>
                                    <a href="{{ route('admin.success-stories.create') }}" class="btn btn-sm btn-outline-primary">
                                        Create First Story
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination Footer -->
        @if ($stories->hasPages())
            <div class="card-footer bg-white py-3">
                {{ $stories->links() }}
            </div>
        @endif
    </div>
</div>
</x-admin-layout>
