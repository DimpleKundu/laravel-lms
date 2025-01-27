<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <!-- Edit User Form  -->
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>First Name</label>
        <input type="text" name="firstname" value="{{ $user->firstname }}" required>

        <label>Last Name</label>
        <input type="text" name="lastname" value="{{ $user->lastname }}" required>

        <label>Username</label>
        <input type="text" name="username" value="{{ $user->username }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ $user->email }}" required>

        <label>Mobile</label>
        <input type="text" name="mobile" value="{{ $user->mobile }}" required>

        <label>Branch</label>
        <select name="branch" required>
            <option value="IT" {{ $user->branch == 'IT' ? 'selected' : '' }}>IT</option>
            <option value="Computer Science" {{ $user->branch == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
            <option value="Electrical Engineering" {{ $user->branch == 'Electrical Engineering' ? 'selected' : '' }}>Electrical Engineering</option>
            <option value="Chemical Engineering" {{ $user->branch == 'Chemical Engineering' ? 'selected' : '' }}>Chemical Engineering</option>
        </select>

        <button type="submit">Update User</button>
    </form>
    <form action="{{ route('admin.dashboard') }}">
        @csrf
        <button type="submit" class="reject-btn">back to dashboard</button>
    </form>
</body>
</html>
