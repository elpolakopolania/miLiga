@if (session('msg_error'))
    <div class="alert alert-danger">
        {{ session('msg_error') }}
    </div>
@endif
