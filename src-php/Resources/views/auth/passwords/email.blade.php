@extends('maxfactor::layouts.minimal')

@section('browser_title', 'Reset Password')

@section('content')
    <section class="authentication authentication--email">
        <div class="authentication__panel">

            <h1>@lang('Send Password Reset')</h1>

            <div class="form">
                <form method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

                    @include('maxfactor::partials.form.email')

                    <div class="form__field">
                        <button type="submit" class="button button--authentication">
                            @lang('Send')
                        </button>
                    </div>

                    @include('maxfactor::partials.form.status')
                    @include('maxfactor::partials.form.message')
                </form>
            </div>

        </div>
    </section>
@endsection
