{{ get_doctype() }}
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{ get_title() }}
    {{ assets.outputCss('head') }}
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('img/favicon.ico') }}"/>
</head>
<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <a class="btn btn-outline-primary pull-left" href="{{ url("/movies") }}">Movies</a> &nbsp; &nbsp;
        <h5 class="my-0 mr-md-auto font-weight-normal">
            {% if user is defined %}
                Hi {{ user.firstName }}
            {% else %}
                Hi, Guest,
            {% endif %}
        </h5>
        <a class="btn btn-outline-primary" href="{{ url("/user/movies") }}">My Favorites</a> &nbsp; &nbsp;
        <a class="btn btn-outline-primary" href="{{ url("/logout") }}">Log out</a>
    </div>

    <div class="container">
        <div class="col-md-8">
            {# Error Messages #}
            {% if flashSession.has() %}
                {{ flashSession.output() }}
            {% endif %}
        </div>
    </div>
    {% block content %}

        {# Main Content goes here... #}

    {% endblock %}
    <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
            <div class="col-12 col-md">
                <img class="mb-2" src="{{ url('img/favicon-32x32.png')}}" alt="" width="24" height="24">
                <small class="d-block mb-3 text-muted">MovieSpace &copy; {{ date('Y') }}</small>
            </div>
            <div class="col-6 col-md">
                <h5>About</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">The Team</a></li>
                    <li><a class="text-muted" href="#">Contact us</a></li>
                </ul>
            </div>
        </div>
    </footer>
    {{ assets.outputJs('footer') }}
</body>
</html>
