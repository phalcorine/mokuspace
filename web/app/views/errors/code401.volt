{% extends 'layouts/unconnected.volt' %}

{% block content %}
    <div class="alert alert-danger">
        <h1>Error 401 - Access prohibited to the requested page</h1>
    </div>
    <div class="form-center text-center">
        <img class="mb-4" src="{{ url('img/favicon-32x32.png')}}" alt="logo">

        <small>To login,<a href="{{ url("/") }}"> click here </a></small><br>
        <small>If you don't have an account,<a href="{{ url("register") }}"> click here to register </a></small>
    </div>
{% endblock %}