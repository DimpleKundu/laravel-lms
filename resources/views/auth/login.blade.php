
<h1>Login Page</h1>

<form action="{{ route('login.post') }}" method="POST">
    @csrf
    <label for="username">Username:</label>
    <input type="string"  value="{{old('username')}}" name="username" id="username" required>
    @error('username')
        <div >{{ $message }}</div>
    @enderror
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <button type="submit">Login</button>
</form>

<!-- if new user than Registration-->
<a href="/register">New User</a>