@extends('layouts.guest')

@section('content')
    <main class="authentication-content mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-5 mx-auto">
                    <div class="card shadow rounded-5 overflow-hidden">
                        <div class="card-body p-4 p-sm-5">
                            <h5 class="card-title">Register</h5>
                            @if (Session::has('message'))

                            <div class="alert alert-danger alert-dismissible show" role="alert">
                                <strong>{{ Session::get('message') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            @endif
                            <form class="form-body" method="POST">
                                @csrf
                                <div class="row g-3 mt-3">
                                    <div class="col-md-6">
                                        <label for="inputFirstName" class="form-label">First Name</label>
                                        <div class="ms-auto position-relative">
                                            <div
                                                class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control radius-30 ps-5 @error('first_name') is-invalid @enderror"
                                                id="inputFirstName" placeholder="First Name" autofocus required>
                                            </div>
                                        @error('first_name')
                                            <small class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputLastName" class="form-label">Last Name</label>
                                        <div class="ms-auto position-relative">
                                            <div
                                                class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control radius-30 ps-5 @error('last_name') is-invalid @enderror"
                                                id="inputLastName" placeholder="Last Name" required>
                                        </div>
                                        @error('last_name')
                                            <small class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Email Address</label>
                                        <div class="ms-auto position-relative">
                                            <div
                                                class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                <i class="bi bi-envelope-fill"></i>
                                            </div>
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control radius-30 ps-5 @error('email') is-invalid @enderror"
                                                id="inputEmailAddress" placeholder="Email Address" required>
                                        </div>
                                        @error('email')
                                            <small class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPhoneNumber" class="form-label">Phone Number</label>
                                        <div class="ms-auto position-relative">
                                            <div
                                                class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                <i class="bi bi-telephone-fill"></i>
                                            </div>
                                            <input type="text" name="phone" value="{{ old('phone') }}"
                                                class="form-control radius-30 ps-5 @error('phone') is-invalid @enderror" id="inputPhoneNumber"
                                                placeholder="Enter Phone Number" required>
                                        </div>
                                        @error('phone')
                                            <small class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputGender" class="form-label">Gender</label>
                                        <div class="ms-auto position-relative">
                                            <div
                                                class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                <i class="bi bi-people-fill"></i>
                                            </div>
                                            <select class="form-control radius-30 ps-5 @error('gender') is-invalid @enderror" name="gender" id="inputGender" required>
                                                <option value="">- Select Gender -</option>
                                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>
                                        @error('gender')
                                            <small class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputChoosePassword" class="form-label">Password</label>
                                        <div class="ms-auto position-relative">
                                            <div
                                                class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                <i class="bi bi-lock-fill"></i>
                                            </div>
                                            <input type="password" name="password"
                                                class="form-control radius-30 ps-5 @error('password') is-invalid @enderror" id="inputChoosePassword"
                                                placeholder="Enter Password" required>
                                            </div>
                                            @error('password')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
                                        <div class="ms-auto position-relative">
                                            <div
                                                class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                <i class="bi bi-lock-fill"></i>
                                            </div>
                                            <input type="password" name="password_confirmation"
                                                class="form-control radius-30 ps-5" id="inputConfirmPassword"
                                                placeholder="Confirm Password" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="flexSwitchCheckChecked" checked="">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end"> <a
                                            href="authentication-forgot-password.html">Forgot Password ?</a>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary radius-30">Sign Up</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="text-center mb-0 mt-2">Already have an account? <a href="/login">Sign In</a> </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
