<h1 class="text-center text-gray-900 mt-4">Update your account details</h1>
<form class="user" method="POST" action="{{ route('user-profile-information.update') }}">
    @csrf
    @method('PUT')
    <div class="container-sm mt-3">
        <div class="form-group">
            <label>{{ __('Name') }}</label>
            <input class="form-control form-control-user" type="text" name="name"
                value="{{ old('name') ?? auth()->user()->name }}" required autofocus autocomplete="name" />

            <label>{{ __('Email') }}</label>
            <input class="form-control form-control-user" type="email" name="email"
                value="{{ old('email') ?? auth()->user()->email }}" required autofocus />
        </div>
        <div>
            <button class="btn btn-outline-success mt-auto" type="submit">
                {{ __('Update Profile') }}
            </button>
        </div>
    </div>
</form>

<hr>
