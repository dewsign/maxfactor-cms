@if (session('message'))
    <div class="form__message">
        <span>{{ session('message') }}</span>
    </div>
@endif
