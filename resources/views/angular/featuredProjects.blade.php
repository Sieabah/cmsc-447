<div id="featured-carousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#featured-carousel" data-slide-to="0" class="active"></li>
        <li data-target="#featured-carousel" data-slide-to="@{{$index+1}}" class="" ng-repeat="project in featuredProjs"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <img src="http://placehold.it/900x500/3c8dbc/ffffff&text=Welcome+To+The+UMBC+SGA+iTracker" alt="">
            <div class="carousel-caption">
                Welcome To The UMBC SGA iTracker
            </div>
        </div>
        <div class="item" data-ng-repeat="project in featuredProjs">
            <img src="http://placehold.it/900x500/39CCCC/ffffff&text=Featured:+@{{project.name}}" alt="@{{project.name}}">
            <div class="carousel-caption">
                @{{ project.name }}
            </div>
        </div>
    </div>
    <a class="left carousel-control" target="_self" href="#featured-carousel" data-slide="prev">
        <span class="fa fa-angle-left"></span>
    </a>
    <a class="right carousel-control" target="_self" href="#featured-carousel" data-slide="next">
        <span class="fa fa-angle-right"></span>
    </a>
</div>