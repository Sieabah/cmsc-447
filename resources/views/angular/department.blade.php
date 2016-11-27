<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @{{department.name}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
        <li>Departments</li>
        <li class="active">@{{department.name}}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        About this Department
                    </h3>
                </div>
                <div class="box-body">
                    @{{department.description}}
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Meet the Department
                    </h3>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr data-ng-repeat="person in department.memberships | orderBy:'name'">
                                <td style="vertical-align:middle;">
                                    <a data-ng-href="{{url('/people')}}/@{{person.id}}">
                                        <img data-ng-src="@{{person.avatar_url}}" class="img-circle"" title="@{{person.name}}" alt="@{{person.name}}">
                                    </a>
                                </td>
                                <td>
                                    <a data-ng-href="{{url('/people')}}/@{{person.id}}"><h4>@{{person.name}}</h4></a>
                                    <h5>@{{person.position}}</h5>
                                    <h5>@{{person.email_address}}</h5>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Departmental Projects
                    </h3>
                </div>
                <div class="box-body">
                    <div ng-show="department.projets.count == 0">This department does not have any active projects...YET!</div>
                    <div class="box box-warning box-solid" ng-repeat="project in department.projects | orderBy: 'name'" style="margin-bottom:20px;">
                        <a data-toggle="collapse" data-parent="#accordion" data-ng-href="#projectCollapse-@{{project.id}}" target="_self" style="text-decoration:none; color:black;">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    @{{project.name}}
                                </h4>
                            </div>
                        </a>
                        <div id="projectCollapse-@{{project.id}}" class="panel-collapse collapse">
                            <div class="box-body no-padding">
                                <table class="table table-responsive table-condensed">
                                    <tbody>
                                    <tr>
                                        <td style="width:150px;" align="right">Name</td>
                                        <td>@{{project.name}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px;" align="right">Description</td>
                                        <td>@{{project.description}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px;" align="right">Created By</td>
                                        <td>@{{project.creator.name}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px;" align="right">Created At</td>
                                        <td>@{{project.created_at | date}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px;" align="right">Last Updated</td>
                                        <td>@{{project.updated_at | date}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px;" align="right"># of Topics</td>
                                        <td>@{{project.topics.count}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px;" align="right">Completed To-Do Lists</td>
                                        <td>@{{project.todolists.completed_count}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px;" align="right">Outstanding To-Do Lists</td>
                                        <td>@{{project.todolists.remaining_count}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px;" align="right"># of People</td>
                                        <td>@{{project.accesses.count}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px;" align="right"># of Documents</td>
                                        <td>@{{project.documents.attachments + project.attachments.count}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px;" align="right"># of Events</td>
                                        <td>@{{project.calendar_events.count}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-footer">
                                <a href="{{url('/projects')}}/@{{project.id}}"><button type="button" class="btn btn-primary btn-block btn-flat">Read More!</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /.col -->
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Departmental Timeline
                    </h3>
                </div>
                <div class="box-body">
                    Coming soon!
                </div>
            </div>
        </div>
    </div>
</section>