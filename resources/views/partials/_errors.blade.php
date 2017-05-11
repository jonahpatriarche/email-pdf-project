@if (isset($errors))
    @foreach ($errors->all() as $error)
        <div class="notification is-warning">
            <ul>
                <li>{{ $error }}</li>
            </ul>
        </div>
    @endforeach
@endif
