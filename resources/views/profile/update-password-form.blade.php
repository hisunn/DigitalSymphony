<form class="user" method="POST" action="{{ route('user-password.update') }}">
    @csrf
    @method('PUT')
    <div class="container-sm">
        <div class="form-group">
            <label>{{ __('Current Password') }}</label>
            <input class="form-control form-control-user" type="password" name="current_password" required
                autocomplete="current-password" />

            <label>{{ __('Password') }}</label>
            <input class="form-control form-control-user" type="password" name="password" required
                autocomplete="new-password" />

            <label>{{ __('Confirm Password') }}</label>
            <input class="form-control form-control-user" type="password" name="password_confirmation" required
                autocomplete="new-password" />
        </div>
        <div>
            <button class="btn btn-outline-success mt-auto" type="submit">
                {{ __('Save') }}
            </button>
        </div>
    </div>
</form>

<hr>
