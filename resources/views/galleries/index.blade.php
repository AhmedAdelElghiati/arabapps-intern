<x-admin-layout>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h1 class="app-page-title">{{ __('pages/galleries.index.title') }}</h1>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <form class="d-flex me-2" method="GET" action="{{ route('galleries.index') }}">
                        <input name="q" value="{{ request('q') }}" class="form-control form-control-sm"
                            placeholder="{{ __('pages/galleries.index.search_placeholder') }}" aria-label="Search">
                        <button class="btn btn-sm btn-outline-secondary ms-2" type="submit"><i
                                class="bi bi-search"></i></button>
                    </form>
                    <a href="{{ route('galleries.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i> {{ __('pages/galleries.index.add_new') }}
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
                                    <th>{{ __('pages/galleries.fields.title') }}</th>
                                    <th>{{ __('pages/galleries.fields.image') }}</th>
                                    <th>{{ __('pages/galleries.fields.created_at') }}</th>
                                    <th>{{ __('pages/galleries.fields.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($galleries as $gallery)
                                    <tr>
                                        <td>{{ app()->getLocale() === 'ar' ? $gallery->title_ar : $gallery->title_en }}
                                        </td>
                                        <td>
                                            <img src="{{ filter_var($gallery->image, FILTER_VALIDATE_URL) ? $gallery->image : asset('storage/' . $gallery->image) }}"
                                                alt="{{ app()->getLocale() === 'ar' ? $gallery->title_ar : $gallery->title_en }}"
                                                class="img-thumbnail">
                                        </td>
                                        <td>{{ $gallery->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <a href="{{ route('galleries.show', $gallery->id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i> {{ __('pages/galleries.actions.show') }}
                                            </a>
                                            <a href="{{ route('galleries.edit', $gallery->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i> {{ __('pages/galleries.actions.edit') }}
                                            </a>
                                            <form action="{{ route('galleries.destroy', $gallery->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('{{ __('pages/galleries.messages.delete_confirmation') }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                    {{ __('pages/galleries.actions.delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">{{ __('pages/galleries.index.empty') }}
                                        </td>
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
