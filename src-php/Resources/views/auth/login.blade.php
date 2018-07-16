@extends('maxfactor::layouts.minimal')

@section('browser_title', 'Login')

@section('content')
    <section class="authentication authentication--login">
        <div class="authentication__panel">

            <h1>@lang('Login')</h1>

            <div class="form">
                <form method="POST" action="{{ route('login.submit') }}">
                    {{ csrf_field() }}

                    @include('maxfactor::partials.form.email')

                    @include('maxfactor::partials.form.password')

                    <div class="form__field form__field--flex">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('Remember Me')
                        </label>

                        <a class="authentication__forgotten-password" href="{{ route('password.request') }}">
                            @lang('Forgot your password?')
                        </a>
                    </div>

                    <div class="form__field">
                        <button type="submit" class="button button--primary">
                            @lang('Login')
                        </button>
                    </div>

                    @include('maxfactor::partials.form.message')
                </form>
            </div>

        </div>
    </section>
@endsection
