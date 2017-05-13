<nav class="navbar navbar-default navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">GCI Estimator</a>
        </div>
        {{ elements.getMenu() }}
    </div>
</nav>

<div class="container">
    {{ flash.output() }}
    {{ content() }}
    <hr>
    <footer class="footer">
        <div class="container">
            <p class="text-muted">&copy; 2017 GCI ALL RIGHTS RESERVED</p>
        </div>
    </footer>
</div>
