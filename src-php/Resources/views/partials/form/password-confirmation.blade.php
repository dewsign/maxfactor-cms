<div class="form__field {{ $errors->has('password_confirmation') ? 'form__field--error' : '' }}">

    <label for="passwordConfirm" class="form__label">
        @lang('Confirm Password')
    </label>

    <input
        id="passwordConfirm"
        type="password"
        name="password_confirmation"
        required
        aria-invalid="{{ $errors->has('password_confirmation') ? 'true' : 'false' }}"
    >

    @if ($errors->has('password_confirmation'))
        <span class="form__error">
            {{ $errors->first('password_confirmation') }}
        </span>
    @endif

</div>
