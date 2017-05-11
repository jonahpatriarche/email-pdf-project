@if (session()->has('success'))
    <div class="notification is-success">
        <ul>
            <li>{{ session('success') }}</li>
        </ul>
    </div>
@endif

