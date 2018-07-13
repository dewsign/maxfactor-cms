@extends('maxfactor::layouts.minimal')

@section('browser_title', 'Reset Password')

@section('content')
    <section class="authentication">

        <h1>@lang('Send Password Reset')</h1>

        <div class="form">
            <form method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                @include('maxfactor::partials.form.email')

                <div class="form__field">
                    <button type="submit" class="button button--primary">
                        @lang('Send')
                    </button>
                </div>

                @include('maxfactor::partials.form.status')
                @include('maxfactor::partials.form.message')
            </form>
        </div>

    </section>
@endsection
