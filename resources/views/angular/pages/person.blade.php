<div class="content-wrapper">
	<section class="content-header">
		<h1>
			@{{ person.id != null ? person.name+"'s Profile" : '' }}
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="{{url('/people')}}">People</a></li>
			<li class="active">@{{person.name}}</li>
		</ol>
	</section>

	<section class="content person"></section>
</div>
