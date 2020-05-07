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
<body class="fond-img">
    <div class="container">
        {% block content %} {% endblock %}
    </div>
    {{ assets.outputJs('footer') }}
</body>
</html>
