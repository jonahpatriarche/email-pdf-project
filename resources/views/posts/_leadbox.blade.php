<div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            Email PDF
        </header>
        <section class="modal-card-body">
            {{ Form::open(['route' => 'email.post-pdf']) }}
            {{ Form::hidden('post-url', request()->path()) }}
            {{ Form::email('email') }}

        </section>
        <footer class="modal-card-foot">
            {{ Form::submit('Send', ['class' => 'button is-success']) }}
            <button class="button">Cancel</button>
            {{ Form::close() }}
        </footer>
    </div>
</div>
