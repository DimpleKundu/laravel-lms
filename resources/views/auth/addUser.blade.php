<form action="{{ route('admin.users.store') }}" method="POST">
  @csrf
  @if (session()->has("success"))
  <div class="alert alert-success">
    {{ session()->get("success") }}
  </div>
  @endif


  <fieldset>
    <legend>Add New User</legend>

    <div>
      <label for="firstname" class="form-label">FirstName</label>
      <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter your first name">
      @error('firstname')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <label for="lastname" class="form-label">LastName</label>
      <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter your last name">
      @error('lastname')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <label for="username" class="form-label">Username</label>
      <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username">
      @error('username')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <label for="email" class="form-label">Email address</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
      @error('email')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
      @error('password')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <label for="confirm-password" class="form-label">Confirm Password</label>
      <input type="password" name="password_confirmation" id="confirm-password" class="form-control" placeholder="Confirm your password">
      @error('password_confirmation')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <label for="mobile" class="form-label">Mobile</label>
      <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter your mobile number">
      @error('mobile')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <label for="branch" class="form-label">Branch</label>
      <select id="branch" name="branch" class="form-select">
        <option value="">Select Branch</option>
        <option value="IT">IT</option>
        <option value="Computer Science">Computer Science</option>
        <option value="Electrical Engineering">Electrical Engineering</option>
        <option value="Chemical Engineering">Chemical Engineering</option>
      </select>
      @error('branch')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
        <label class="form-check-label" for="terms">
          I agree to the terms and conditions
        </label>
        @error('terms')
        <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Add User</button>
  </fieldset>
</form>

<form action="{{ route('admin.dashboard') }}">
  @csrf
  <button type="submit" class="reject-btn">back to dashboard</button>
</form>