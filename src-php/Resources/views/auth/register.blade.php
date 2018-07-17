@extends('maxfactor::layouts.minimal')

@section('browser_title', 'Register')

@section('content')
    <section class="authentication authentication--register">
        <div class="authentication__panel">

            <h1>@lang('Register')</h1>

            <div class="form">
                <form method="POST" action="{{ route('register.submit') }}">
                    {{ csrf_field() }}

                    @include('maxfactor::partials.form.name')
                    @include('maxfactor::partials.form.email')
                    @include('maxfactor::partials.form.password')
                    @include('maxfactor::partials.form.password-confirmation')

                    <div class="form__field">
                        <button type="submit" class="button button--authentication">
                            @lang('Register')
                        </button>
                    </div>

                    @include('maxfactor::partials.form.message')
                </form>
            </div>

        </div>
    </section>
@endsection
