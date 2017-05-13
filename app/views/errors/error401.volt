{{ content() }}

<div class="jumbotron">
    <h1>Unauthorized</h1>
    <p>You're not authorized to perform this action. Please login first. </p>
    <p>{{ link_to('session', 'Login', 'class': 'btn btn-primary') }}</p>
</div>
