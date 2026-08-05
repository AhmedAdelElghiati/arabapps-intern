

<x-admin-layout>
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Success Stories</h2>
        <a href="{{ route('success-stories.create') }}" class="btn btn-primary">
            + Add New Story
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Order</th>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Grade / Score</th>
                            <th>Top Scored</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stories as $story)
                            <tr>
                                <td>{{ $story->display_order }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($story->photo_url)
                                            <img src="{{ $story->photo_url }}" alt="{{ $story->name }}" class="rounded-circle me-2" width="40" height="40" style="object-fit: cover;">
                                        @endif
                                        <span class="fw-semibold">{{ $story->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $story->course->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-info text-dark">{{ $story->grade }}</span>
                                    <small class="text-muted">({{ $story->score }} / {{ $story->total_score }})</small>
                                </td>
                                <td>
                                    @if ($story->is_top_scored)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-secondary">No</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('success-stories.edit', $story->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                        Edit
                                    </a>
                                    <form action="{{ route('success-stories.destroy', $story->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this story?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    No success stories found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($stories->hasPages())
            <div class="card-footer bg-white py-3">
                {{ $stories->links() }}
            </div>
        @endif
    </div>
</div></x-admin-layout>
