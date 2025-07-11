@extends('layouts.app')

@section('content')
    <h1>Audit Logs</h1>
    <a href="{{ route('tasks.index') }}" class="btn btn-primary mb-3">Back to Tasks</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Event</th>
                <th>User</th>
                <th>Old Values</th>
                <th>New Values</th>
                <th>URL</th>
                <th>IP Address</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($audits as $audit)
                <tr>
                    <td>{{ $audit->id }}</td>
                    <td>{{ $audit->event }}</td>
                    <td>{{ $audit->user ? $audit->user->name : 'N/A' }}</td>
                    <td>{{ $audit->old_values ?? 'N/A' }}</td>
                    <td>{{ $audit->new_values ?? 'N/A' }}</td>
                    <td>{{ $audit->url ?? 'N/A' }}</td>
                    <td>{{ $audit->ip_address ?? 'N/A' }}</td>
                    <td>{{ $audit->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection