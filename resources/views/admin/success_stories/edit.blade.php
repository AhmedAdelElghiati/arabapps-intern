
<x-admin-layout>
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Success Story</h2>
        <a href="{{ route('success-stories.index') }}" class="btn btn-secondary">
            Back to List
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('success-stories.update', $successStory->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Student Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $successStory->name) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="course_id" class="form-label">Course</label>
                        <select name="course_id" id="course_id" class="form-select" required>
                            <option value="">Select Course</option>
                            @foreach($courses as $id => $name)
                                <option value="{{ $id }}" {{ old('course_id', $successStory->course_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="grade" class="form-label">Grade</label>
                        <input type="text" name="grade" id="grade" class="form-control" value="{{ old('grade', $successStory->grade) }}" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="score" class="form-label">Score</label>
                        <input type="number" step="0.01" name="score" id="score" class="form-control" value="{{ old('score', $successStory->score) }}" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="total_score" class="form-label">Total Score</label>
                        <input type="number" step="0.01" name="total_score" id="total_score" class="form-control" value="{{ old('total_score', $successStory->total_score) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="photo_url" class="form-label">Photo URL</label>
                        <input type="url" name="photo_url" id="photo_url" class="form-control" value="{{ old('photo_url', $successStory->photo_url) }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="display_order" class="form-label">Display Order</label>
                        <input type="number" name="display_order" id="display_order" class="form-control" value="{{ old('display_order', $successStory->display_order) }}" required>
                    </div>

                    <div class="col-md-3 mb-3 d-flex align-items-end">
                        <div class="form-check mb-2">
                            <input type="checkbox" name="is_top_scored" id="is_top_scored" value="1" class="form-check-input" {{ old('is_top_scored', $successStory->is_top_scored) ? 'checked' : '' }}>
                            <label for="is_top_scored" class="form-check-label">Is Top Scored?</label>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $successStory->description) }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Story</button>
            </form>
        </div>
    </div>
</div></x-admin-layout>
