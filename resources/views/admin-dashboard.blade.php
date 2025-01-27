<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
</head>
<body>
    <div class="header-container">
        <h1>Admin Dashboard - User Management</h1>
        <div class="buttons-container">
            <a href="{{ route('admin.users.add') }}" class="add-user-btn">Add User</a>
            <a href="{{ route('bookMaintain.dashboard') }}" class="book-maintain-btn">Book Maintain</a>
            <a href="{{ route('admin.borrow-requests') }}" class="view-requests-btn">View Borrow Requests</a>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- <a href="{{route('bookMaintain.dashboard')}}"> bookMaintain</a> -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Branch</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->branch }}</td>
                <td class="action-buttons">
                    <form action="{{ route('admin.users.edit', ['user' => $user->id]) }}" method="GET">
                        <button type="submit" class="edit-btn">Edit</button>
                    </form>
                    <form action="{{ route('admin.users.delete', ['user' => $user->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> 