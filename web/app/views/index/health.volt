{% extends 'layouts/unconnected.volt' %}

{% block content %}
    {%  if errors is defined %}
        <div class="alert alert-danger">
            {{ errors }}
        </div>
    {% endif %}

    <div class="form-center text-center">
        {{ message }}
    </div>
{% endblock %}