@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ _('Edit Profile') }}</h5>
                </div>
                @include('admin.alerts.success')
                <form id="update-form" method="post" action="{{ url('profile/' . auth()->user()->user_id) }}"
                    autocomplete="off">
                    <div class="card-body">
                            @csrf
                            @method('put')

                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>{{ _('Name') }}</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ _('Name') }}" value="{{ old('name', auth()->user()->name) }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>{{ _('Email address') }}</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ _('Email address') }}" value="{{ old('email', auth()->user()->email) }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ _('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ _('Password') }}</h5>
                </div>
                <form method="post" action="{{ url('profile/password/' . auth()->user()->user_id) }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @include('admin.alerts.success', ['key' => 'password_status'])

                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label>{{ __('Current Password') }}</label>
                            <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'old_password'])
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label>{{ __('New Password') }}</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>

                        <div class="form-group">
                            <label>{{ 'Konfirmasi Password' }}</label>
                            <input type="password" name="password_confirmation"
                                class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                placeholder="{{ 'Konfirmasi Password' }}" value="">
                            @include('admin.alerts.feedback', ['field' => 'password_confirmation'])
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ _('Change password') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                                <img class="avatar" src="{{ asset('white') }}/img/emilyz.jpg" alt="">
                                <h5 class="title">{{ auth()->user()->name }}</h5>
                            </a>
                            <p class="description">
                                {{ _('Ceo/Co-Founder') }}
                            </p>
                        </div>
                    </p>
                    <div class="card-description">
                        {{ _('Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...') }}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="button-container">
                        <button class="btn btn-icon btn-round btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-google">
                            <i class="fab fa-google-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@stack('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('update-form');
        var saveButton = document.getElementById('save-button');

        // Cache initial form values
        var initialValues = {};
        new FormData(form).forEach((value, key) => initialValues[key] = value);

        // Function to check if form values have changed
        function checkFormChanges() {
            var hasChanged = false;
            var formData = new FormData(form);

            for (var key in initialValues) {
                if (formData.get(key) !== initialValues[key]) {
                    hasChanged = true;
                    break;
                }
            }

            saveButton.disabled = !hasChanged;
        }

        // Add event listeners to inputs
        form.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', checkFormChanges);
        });

        // Initial check
        checkFormChanges();
    });

    window.addEventListener("DOMContentLoaded", function() {
        // Menangani toggle untuk password
        const toggleOldPassword = document.querySelector("#toggleOldPassword");
        const togglePassword = document.querySelector("#togglePassword");
        const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");

        // Fungsi untuk toggle tipe password dan mengganti ikon
        function togglePasswordVisibility(inputSelector, icon) {
            const passwordField = document.querySelector(inputSelector);
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);

            // Toggle ikon mata antara "fa-eye" dan "fa-eye-slash"
            icon.classList.toggle("fa-eye-slash");
            icon.classList.toggle("fa-eye");
        }

        // Event listener untuk ikon "toggleOldPassword"
        if (toggleOldPassword) {
            toggleOldPassword.addEventListener("click", function() {
                togglePasswordVisibility("input[name='old_password']", this);
            });
        }

        // Event listener untuk ikon "togglePassword"
        if (togglePassword) {
            togglePassword.addEventListener("click", function() {
                togglePasswordVisibility("input[name='password']", this);
            });
        }

        // Event listener untuk ikon "toggleConfirmPassword"
        if (toggleConfirmPassword) {
            toggleConfirmPassword.addEventListener("click", function() {
                togglePasswordVisibility("input[name='password_confirmation']", this);
            });
        }
    });
</script>
