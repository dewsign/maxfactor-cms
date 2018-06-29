<div class="form__field {{ $errors->has('password') ? 'form__field--error' : '' }}">

    <label for="password" class="form__label">
        @lang('Password')
    </label>

    <input
        id="password"
        type="password"
        name="password"
        required
        aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
    >

    @if ($errors->has('password'))
        <span class="form__error">
            {{ $errors->first('password') }}
        </span>
    @endif

</div>
