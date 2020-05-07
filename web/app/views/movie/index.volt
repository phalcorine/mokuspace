{% extends 'layouts/default.volt' %}

{% block content %}
    {% set pageRoute = 'movies' %}

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">All Movies</h1>
    </div>

    <div class="container">
        <div class="row">
            {% for movie in page.items %}
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        {#<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                            <rect width="100%" height="100%" fill="#55595c"></rect>
                            <text x="40%" y="50%" fill="#eceeef" dy=".3em">{{ movie.title }}</text>
                        </svg>#}
                        <img src="{{ movie.backdropPath }}" width="100%" height="225" alt="{{ movie.title }}">
                        <div class="card-body">
                            <p class="card-text"><h3>{{ movie.title }}</h3></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ url("movie/")~movie.id }}" class="btn btn-sm btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            {% else %}
                <p>No movies have been uploaded yet.</p>
            {% endfor %}
        </div>

        {# Pagination #}
        <div class="row">
            <div class="col-sm-1">
                <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
                    {{ page.current ~ ' / ' ~ page.total_pages }}
                </p>
            </div>
            <div class="col-sm-11">
                <nav>
                    <ul class="pagination">
                        <li>{{ linkTo([ pageRoute, 'First', 'class': 'page-link' ]) }}</li>
                        <li>{{ linkTo([ pageRoute ~ '?page=' ~ page.before, 'Previous', 'class': 'page-link' ]) }}</li>
                        <li>{{ linkTo([ pageRoute ~ '?page=' ~ page.next, 'Next', 'class': 'page-link' ]) }}</li>
                        <li>{{ linkTo([ pageRoute ~ '?page=' ~ page.last, 'Last', 'class': 'page-link' ]) }}</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
{% endblock %}