<div class="form__field {{ $errors->has('email') ? 'form__field--error' : '' }}">

    <label for="email" class="form__label">
        @lang('Email Address')
    </label>

    <input
        id="email"
        type="email"
        name="email"
        required
        value="{{ old('email') }}"
        aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
    >

    @if ($errors->has('email'))
        <span class="form__error">
            {{ $errors->first('email') }}
        </span>
    @endif

</div>
