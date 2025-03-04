@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manage User Roles</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Current Roles</th>
                <th>Assign Role</th>
                <th>Remove Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
                <td>
                    <form action="{{ route('user.assignRole', $user->id) }}" method="POST">
                        @csrf
                        <select name="role" class="form-control" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary mt-1">Assign</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('user.removeRole', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <select name="role" class="form-control" required>
                            @foreach($user->getRoleNames() as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-danger mt-1">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
