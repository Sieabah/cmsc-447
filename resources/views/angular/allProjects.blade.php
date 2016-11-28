<input type="text" ng-model="search.name" class="form-control" placeholder="Filter by project name" />
<div class="row" style="margin-top:20px; display: flex; flex-wrap: wrap; align-items: stretch">
    <div class="col-xs-12 col-md-4 col-lg-3" style="margin: auto" ng-repeat="proj in projects | filter: search | orderBy : 'name'">
        <a href="{{url('/project')}}/@{{proj.id}}/" style="text-decoration: none;">
            <div class="projectView" data-project="proj"></div>
        </a>
    </div>
</div>