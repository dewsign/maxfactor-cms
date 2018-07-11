<div class="form__field {{ $errors->has('first_name') ? 'form__field--error' : '' }}">

    <label for="name" class="form__label">
        @lang('Name')
    </label>

    <input
        id="name"
        type="text"
        name="name"
        value="{{ old('name') }}"
        required
        aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
    >

    @if ($errors->has('name'))
        <span class="form__error">
            {{ $errors->first('name') }}
        </span>
    @endif

</div>
