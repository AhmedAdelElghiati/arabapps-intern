<x-admin-layout>
@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 text-dark mb-0">{{ __('pages/top_students.index.title') }}</h2>
        <a href="{{ route('success-stories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> {{ __('pages/top_students.index.add_new') }}
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
                            <th style="width: 80px;">{{ __('pages/top_students.index.photo') }}</th>
                            <th>{{ __('pages/top_students.index.name') }}</th>
                            <th>{{ __('pages/top_students.index.track') }}</th>
                            <th>{{ __('pages/top_students.index.grade') }}</th>
                            <th class="text-center">{{ __('pages/top_students.index.order') }}</th>
                            <th class="text-center">{{ __('pages/top_students.index.top_scored') }}</th>
                            <th class="text-center">{{ __('pages/top_students.index.status') }}</th>
                            <th class="text-end" style="width: 150px;">{{ __('pages/top_students.index.actions') }}</th>
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
                                            {{ strtoupper(mb_substr($story->name, 0, 2)) }}
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
                                            <i class="bi bi-star-fill me-1"></i> {{ __('pages/top_students.index.top_scored') }}
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>

                                <!-- Active Status Badge -->
                                <td class="text-center">
                                    @if ($story->is_active)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                            {{ __('pages/top_students.index.active') }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1">
                                            {{ __('pages/top_students.index.inactive') }}
                                        </span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('success-stories.edit', $story->id) }}"
                                           class="btn btn-outline-primary"
                                           title="{{ __('pages/top_students.index.edit') }}">
                                            {{ __('pages/top_students.index.edit') }}
                                        </a>

                                        <form action="{{ route('success-stories.destroy', $story->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('{{ __('pages/top_students.index.confirm_delete') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger rounded-end" title="{{ __('pages/top_students.index.delete') }}">
                                                {{ __('pages/top_students.index.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <p class="mb-2">{{ __('pages/top_students.index.no_records') }}</p>
                                    <a href="{{ route('success-stories.create') }}" class="btn btn-sm btn-outline-primary">
                                        {{ __('pages/top_students.index.create_first') }}
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
