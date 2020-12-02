<x-guest-layout>
<section id="wrapper">
    <div class="login-register" style="background-image:url(/theme/assets/images/background/megamenubg.jpg);">
        <div class="login-box card">
            <div class="card-header  bg-inverse">
                <h5 class="card-title">
                    Rest Password
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus/>
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password"/>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password"/>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button class="btn btn-secondary waves-effect">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</x-guest-layout>
