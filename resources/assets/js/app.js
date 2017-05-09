Vue.component('modal', {
    template: `
        <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                Email PDF
            </header>
            <section class="modal-card-body">
                <form method="post" action="email/pdf"
                <!-- link = {{ request()->path() . '/pdf }} -->
               <!-- {{ Form::email('email') }}-->

            </section>
            <footer class="modal-card-foot">
               <!-- {{ Form::submit('Send', ['class' => 'button is-success']) }}-->
                <button class="button">Cancel</button>
               </form>
            </footer>
        </div>
   `
});

new Vue({
    el: '#app'
});
