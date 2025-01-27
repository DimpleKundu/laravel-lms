<form action="{{ route('register.post') }}" method="POST">
  @csrf
  @if (session()->has("success "))
    <div class="alert alert-success">
      {{session()->get("success")}}
    </div>
  @endif

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  @if(session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
  @endif



  <fieldset>
    <legend>Registration Page</legend>

    <div class="mb-3">
      <label for="firstname" class="form-label">FirstName</label>
      <input type="text" name="firstname" id="firstname" value="{{old('firstname')}}" class="form-control" placeholder="Enter your first name">
    </div>
    <div class="mb-3">
      <label for="lastname" class="form-label">LasttName</label>
      <input type="text" name="lastname" id="lastname" value="{{old('lastname')}}" class="form-control" placeholder="Enter your last name">
    </div>

    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" name="username" id="username" value="{{old('username')}}" class="form-control" placeholder="Enter your username">
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" name="email" id="email" value="{{old(key: 'email')}}" class="form-control" placeholder="Enter your email">
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
    </div>

    <div class="mb-3">
      <label for="confirm-password" class="form-label">Confirm Password</label>
      <input type="password" name="password_confirmation" id="confirm-password" class="form-control" placeholder="Confirm your password">
    </div>

    <div class="mb-3">
      <label for="mobile" class="form-label">Mobile</label>
      <input type="text" name="mobile" id="mobile" value="{{old('mobile')}}" class="form-control" placeholder="Enter your mobile number">
    </div>

    <div class="mb-3">
      <label for="branch" class="form-label">Branch</label>
      <select id="branch" name="branch" class="form-select">
        <option value="">Select Branch</option>
        <option value="IT" {{ old('branch') == 'IT' ? 'selected' : '' }}>IT</option>
        <option value="Computer Science" {{ old('branch')== 'Computer Science' ? 'selected' : ''}}>Computer Science</option> 
        <option value="Electrical Engineering" {{ old('branch')== 'Electrical Engineering' ? 'selected' : ''}}>Electrical Engineering</option>
        <option value="Chemical Engineering" {{old('branch')== 'Chemical Engineering' ? 'selected' : ''}}>Chemical Engineering</option>
      </select>
    </div>

    <div class="mb-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="terms" name="terms" value="1">
        <label class="form-check-label" for="terms">
          I agree to the terms and conditions
        </label>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Register</button>
  </fieldset>
</form>