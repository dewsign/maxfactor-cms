@extends('maxfactor::layouts.default')

@section('browser_title', 'Reset Password')

@section('content')
    <section class="authentication">

        <h1>@lang('Reset Password')</h1>

        <div class="form">
            <form method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                @include('maxfactor::partials.form.email')
                @include('maxfactor::partials.form.password')
                @include('maxfactor::partials.form.password-confirmation')

                <div class="form__field">
                    <button type="submit" class="button button--primary">
                        @lang('Reset Password')
                    </button>
                </div>

                @include('maxfactor::partials.form.message')
            </form>
        </div>

    </section>
@endsection
