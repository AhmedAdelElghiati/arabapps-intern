<x-admin-layout>
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Success Stories</h1>
        <a href="{{ route('success-stories.create') }}" class="btn btn-primary">Add Story</a>
    </div>
 
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table border">
        <thead>
            <tr>
                <th>Name</th>
                <th>Grade</th>
                <th>Score</th>
                <th>Percentage</th>
                <th>Top Scored</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

</div>
</x-admin-layout>
