<div ng-controller="ProjectController">

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				@{{project.name}}
			</h1>
			<ol class="breadcrumb">
				<li><a href="/itracker/"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="/itracker/projects/by-name/">Projects</a></li>
				<li class="active">@{{project.name}}</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-5">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">
								Progress Bar
							</h3>
						</div>
						<div class="box-body">
							<div class="progress progress-xl progress-striped active" style="height:30px;">
		                    	<div class="progress-bar progress-bar-primary" style="width: @{{(((activeTodoListsCompletedCount + completedTodoListsCompletedCount) * (100 / (activeTodoListsRemainingCount + activeTodoListsCompletedCount + completedTodoListsRemainingCount + completedTodoListsCompletedCount))) || '0') | number:0}}%">
		                    		<h6>@{{(((activeTodoListsCompletedCount + completedTodoListsCompletedCount) * (100 / (activeTodoListsRemainingCount + activeTodoListsCompletedCount + completedTodoListsRemainingCount + completedTodoListsCompletedCount))) || '0') | number:0}}%</h6>
		                    	</div>
		                    </div>
						</div>
					</div>
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">
								People on this Project
							</h3>
						</div>
						<div class="box-body">
							<a ng-repeat="person in people | orderBy:'name'" href="/itracker/people/@{{person.id}}" ng-hide="person.email_address == 'sga@umbc.edu'"><img src="@{{person.avatar_url}}" class="img-circle" style="margin-bottom:15px;margin-right:15px;" title="@{{person.name}}" alt="@{{person.name}}"></a>
						</div>
						<div class="box-footer">
							<form action="/itracker/join" method="get" style="display:inline;">
								<input type="text" name="proj" value="@{{project.id}}" hidden="">
								<input type="text" name="projname" value="@{{project.name}}" hidden="">
								<button type="submit" class="btn btn-primary btn-block btn-flat ">Join the team!</button>
							</form>
						</div>
					</div>
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">
								Project At-A-Glance
							</h3>
						</div>
						<div class="box-body">
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
						</div> <!-- /.box-body -->
					</div> <!-- /.box -->
					<div class="box box-primary" ng-show="project.todolists.remaining_count > 0">
						<div class="box-header with-border">
							<h3 class="box-title">Active To-Do Lists <small>(Click on list name to expand)</small> </h3>
						</div>
						<div class="box-body">
				            <div class="box-group" id="accordion">
				                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
				                <div class="panel box box-warning box-solid" ng-repeat="list in activeTodoLists | orderBy: 'name'" style="margin-bottom:20px;">
						            <a data-toggle="collapse" data-parent="#accordion" href="#todoCollapse-@{{list.id}}" target="_self" style="text-decoration:none; color:black;">
						                <div class="progress progress-md progress-striped active" style="height: 30px; margin-bottom: 0px;">
						                	<div class="box-header with-border progress-bar progress-bar-warning" style="width:@{{(list.completed_count * (100 / (list.remaining_count + list.completed_count))) || '0' | number:0}}%"></div>
						                	<h4 class="box-title todoTitle">
					                    		@{{list.name}}
						                    </h4>
						                    <h6 class="pull-right">
						                    	@{{(list.completed_count * (100 / (list.remaining_count + list.completed_count))) || '0' | number:0}}% complete
						                    </h6>
						                </div>
						            </a>

				                	<div id="todoCollapse-@{{list.id}}" class="panel-collapse collapse">
				                    	<div class="box-body no-padding">
				                    		<h4 ng-show="list.description.length > 0">@{{list.description}}</h4>
				                    		<table class="table table-bordered" ng-show="(list.todos.remaining.length + list.todos.completed.length) > 0">
				                    			<tr>
										            <th>Task To Do</th>
										            <th style="width: 150px;">Assigned To</th>
										        </tr>
				                    			<tr ng-repeat="todo in list.todos.remaining">
				                    				<td valign="middle">
				                    					<h5>@{{todo.content}}</h5>
				                    					<h6 ng-show="todo.due_on != null">Due: @{{todo.due_on | date}}</h6>
										                <h6>Created: @{{todo.created_at | date}} | Last update: @{{todo.updated_at | date}}</h6>
										            </td>
										            <td align="center" valign="middle">
										                <span ng-show="todo.assignee != null" ng-repeat="person in people | filter: {id:todo.assignee.id}">
											                <a href="/itracker/people/@{{todo.assignee.id}}/"><img src="@{{person.avatar_url}}" class="img-circle" title="@{{todo.assignee.name}}" alt="@{{todo.assignee.name}}">
																<h5>@{{todo.assignee.name}}</h5>
															</a>
											            </span>
										            </td>
				                    			</tr>
				                    			<tr ng-repeat="todo in list.todos.completed">
				                    				<td valign="middle">
				                    					<h5><i class="fa fa-check"></i> <span style="text-decoration: line-through;">@{{todo.content}}</span></h5>
										                <h6 ng-show="todo.due_on != null">Due: @{{todo.due_on | date}}</h6>
										                <h6>Created: @{{todo.created_at | date}} | Last update: @{{todo.updated_at | date}}</h6>
										            </td>
										            <td align="center" valign="middle">
										               <span ng-show="todo.assignee != null" ng-repeat="person in people | filter: {id:todo.assignee.id}">
											                <a href="/itracker/people/@{{todo.assignee.id}}/"><img src="@{{person.avatar_url}}" class="img-circle" title="@{{todo.assignee.name}}" alt="@{{todo.assignee.name}}">
																<h5>@{{todo.assignee.name}}</h5>
															</a>
											            </span>
										            </td>
				                    			</tr>
				                    		</table>
				                    		<span ng-show="(list.todos.remaining.length + list.todos.completed.length) == 0">
				                    			<h5>No items in this list yet!</h5>
				                    		</span>
				                    	</div>
				                  	</div>
				                </div>
				            </div>
						</div>
					</div>
					<div class="box box-primary" ng-show="project.todolists.completed_count > 0">
						<div class="box-header with-border">
							<h3 class="box-title">Completed To-Do Lists <small>(Click on list name to expand)</small> </h3>
						</div>
						<div class="box-body">
				            <div class="box-group" id="accordion">
				                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
				                <div class="panel box box-success" ng-repeat="list in completedTodoLists | orderBy: 'name'" style="margin-bottom:20px;">
						            <a data-toggle="collapse" data-parent="#accordion" href="#todoCollapse-@{{list.id}}" target="_self" style="text-decoration:none; color:black;">
						                <div class="progress progress-md progress-striped active" style="height: 30px; margin-bottom: 0px;">
						                	<div class="box-header with-border progress-bar progress-bar-success" style="width:100%"></div>
						                	<h4 class="box-title todoTitle">
					                    		@{{list.name}}
						                    </h4>
						                    <h6 class="pull-right">
						                    	100% complete
						                    </h6>
						                </div>
						            </a>

				                	<div id="todoCollapse-@{{list.id}}" class="panel-collapse collapse">
				                    	<div class="box-body no-padding">
				                    		<h4 ng-show="list.description.length > 0">@{{list.description}}</h4>
				                    		<table class="table table-bordered" ng-show="(list.todos.remaining.length + list.todos.completed.length) > 0">
				                    			<tr>
										            <th>Task To Do</th>
										            <th>Assigned To</th>
										        </tr>
				                    			<tr ng-repeat="todo in list.todos.remaining">
				                    				<td valign="middle">
				                    					<h5>@{{todo.content}}</h5>
										                <h6 ng-show="todo.due_on != null">Due: @{{todo.due_on | date}}</h6>
										                <h6>Created: @{{todo.created_at | date}} | Last update: @{{todo.updated_at | date}}</h6>
										            </td>
										            <td align="center" valign="middle">
										                <span ng-show="todo.assignee != null" ng-repeat="person in people | filter: {id:todo.assignee.id}">
											                <a href="/itracker/people/@{{todo.assignee.id}}/"><img src="@{{person.avatar_url}}" class="img-circle" title="@{{todo.assignee.name}}" alt="@{{todo.assignee.name}}">
																<h5>@{{todo.assignee.name}}</h5>
															</a>
											            </span>
										            </td>
				                    			</tr>
				                    			<tr ng-repeat="todo in list.todos.completed">
				                    				<td valign="middle">
				                    					<h5><i class="fa fa-check"></i> <span style="text-decoration: line-through;">@{{todo.content}}</span></h5>
										                <h6 ng-show="todo.due_on != null">Due: @{{todo.due_on | date}}</h6>
										                <h6>Created: @{{todo.created_at | date}} | Last update: @{{todo.updated_at | date}}</h6>
										            </td>
										            <td align="center" valign="middle">
										            	<span ng-show="todo.assignee.length != null" ng-repeat="person in people | filter: {id:todo.assignee.id}">
											                <a href="/itracker/people/@{{todo.assignee.id}}/"><img src="@{{person.avatar_url}}" class="img-circle" title="@{{todo.assignee.name}}" alt="@{{todo.assignee.name}}">
																<h5>@{{todo.assignee.name}}</h5>
															</a>
											            </span>
										            </td>
				                    			</tr>
				                    		</table>
				                    		<span ng-show="(list.todos.remaining.length + list.todos.completed.length) == 0">
				                    			<h5>No items in this list yet!</h5>
				                    		</span>
				                    	</div>
				                  	</div>
				                </div>
				            </div>
						</div>
					</div>
					<!-- <div class="box box-primary" ng-show="project.attachments.count > 0">
						<div class="box-header with-border">
							<h3 class="box-title">Documents</h3>
						</div>
						<div class="box-body">
							<table class="table table-bordered">
                    			<tr>
						            <th>Document</th>
						            <th>Added By</th>
						            <th></th>
						        </tr>
                    			<tr ng-repeat="doc in attachments">
                    				<td valign="middle">
                    					<h5>@{{doc.name}}</h5>
						                <h6>Created: @{{doc.created_at | date}} | Last update: @{{doc.updated_at | date}}</h6>
						            </td>
						            <td align="center" valign="middle">
					                    <a href="/itracker/people/@{{doc.creator.id}}/">
					                    	<img src="@{{doc.creator.avatar_url}}" class="img-circle" title="@{{doc.creator.name}}" alt="@{{doc.creator.name}}">
											<h5>@{{doc.creator.name}}</h5>
										</a>
						            </td>
	                    			<td>
	                    				<h5>@{{doc.content_type}}</h5>
	                    				<a class="btn btn-app" ng-show="doc.link_url != null" href="@{{doc.link_url}}">
	                    					<i class="fa" ng-class="{'fa-file-image-o':docType(doc.content_type), 'fa-refresh': !docType(doc.content_type)}"></i>
	                    					<i class="fa @{{getClass(doc.content_type)}}" ></i>
	                    					<h5>Download</h5>
	                    				</a>
	                    			</td>
	                    		</tr>
                    		</table>
						</div>
					</div> -->
				</div> <!-- /.col -->
				<div class="col-md-7">
					<ul class="timeline">
						<li class="time-label" ng-repeat="event in events | limitTo: limit" >
							<span class="bg-red" ng-show ='event.created_at.length > 0'> 
								@{{event.created_at}}
							</span>
							<img ng-class="{timeline_afterDate: event.created_at.length > 0, timeline_otherwise: event.created_at.length == 0}" class=" fa fa-user img-circle bg-blue" src="@{{event.creator.avatar_url}}" title = "@{{event.creator.name}}">

							<div class="timeline-item" style="margin-top:10px;">
								<span class="time">
									<!-- <i class="fa fa-clock-o"></i> TIME -->
								</span>
								<h3 class="timeline-header">
									<a href="/itracker/people/@{{event.creator.id}}" ng-show="event.creator.id != 13421831">@{{event.creator.name}} </a>
									<span ng-show="event.creator.id == 13421831">The Main SGA Account </span>
									<span ng-bind-html="event.summary"></span>
								</h3>
							</div>
						</li>
						<li>
							<button type="button" class="btn btn-primary" ng-hide = "!more" ng-click = "limit = limit + 5; getEventSet()"><i class="fa fa-clock-o"></i> Show Previous Events</button>
						</li>
					</ul>
					
				</div>
			</div> <!-- /.row -->
			
		</section> <!-- /.content -->
	</div> <!-- /.content-wrapper -->
</div>

