@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>All Registrations</h1>
    <a href="{{ route('admin.exportCsv') }}" class="btn btn-primary mb-3">Export to CSV</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th>
                <th>Job Title</th><th>Company</th><th>Country</th><th>Registered At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registrations as $reg)
                <tr>
                    <td>{{ $reg->first_name }}</td>
                    <td>{{ $reg->last_name }}</td>
                    <td>{{ $reg->email }}</td>
                    <td>{{ $reg->phone ?? '-' }}</td>
                    <td>{{ $reg->job_title ?? '-' }}</td>
                    <td>{{ $reg->company ?? '-' }}</td>
                    <td>{{ $reg->country ?? '-' }}</td>
                    <td>{{ $reg->created_at->format('d.m.Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $registrations->links() }}
</div>
@endsection
