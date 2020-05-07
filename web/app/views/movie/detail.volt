{% extends 'layouts/default.volt' %}

{% block content %}

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">{{ 'Movie Details' }}</h1>
    </div>

    <div class="container" align="center">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ movie.backdropPath }}" width="70%" height="70%" alt="{{ movie.title }}">
                    <div class="card-body">
                        <p class="card-text">{{ movie.title }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            {% if isFavorite is true %}
                                <a href="{{ url("user/movies/unfav/")~movie.id }}" class="btn btn-sm btn-primary">Remove from Favorites</a>
                            {% else %}
                                <a href="{{ url("user/movies/fav/")~movie.id }}" class="btn btn-sm btn-primary">Add to Favorites</a>
                            {% endif %}
                        </div>
                    </div>
                </div>
                <dl class="row">
                    <dt class="col-sm-4">Movie Title: </dt>
                    <dd class="col-sm-8">{{ movie.title }}</dd>
                    <dt class="col-sm-4">Overview:</dt>
                    <dd class="col-sm-8">{{ movie.overview }}</dd>
                    <dt class="col-sm-4">Genre:</dt>
                    <dd class="col-sm-8">
                        {% for genre in genres %}
                            {{ genre.name }}
                            {% if loop.last is false %}
                                {{ ', ' }}
                            {% endif %}
                        {% else %}
                            {{ 'General' }}
                        {% endfor %}
                    </dd>
                    <dt class="col-sm-4">Movie Runtime: </dt>
                    <dd class="col-sm-8">{{ movie.runtime ~ ' (minutes)'}}</dd>
                    <dt class="col-sm-4">Rating (Average):</dt>
                    <dd class="col-sm-8">{{ movie.voteAverage }}</dd>
                    <dt class="col-sm-4">Released Status: </dt>
                    <dd class="col-sm-8">{{ movie.status }}</dd>
                    <dt class="col-sm-4">Released Date:</dt>
                    <dd class="col-sm-8">{{ movie.releaseDate }}</dd>
                </dl>
                <div class="card-body">
                    <h4>@TODO: Videos... </h4>
                </div>
            </div>
        </div>
    </div>
{% endblock %}

