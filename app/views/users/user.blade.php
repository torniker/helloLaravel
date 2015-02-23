@extends('layouts.guest')
@section('content')
<div class="job_add_form">
<div class="job_form_center">
<div class="row users_row left" style="border:none">
	<div class="single_user">
		<div class="well profile">
			<div class="col-sm-12 trainings_wrapper">
				<div class="col-xs-12 col-sm-8">
					<h2>
						<a href="#" class="mylink">
							{{ $user->firstname." ".$user->lastname }}
						</a>
					</h2>
					<div><strong>ძირითადი პროფილი </strong></div>
					<div class="main_training">
						{{Training::find($user->mainprofile)->name}}
					</div> 
					<p><strong>ტრენინგები: </strong>
						@foreach($user->trainings as $training)
						<div>
							<span class="tags">{{$training->name}}</span>
						</div> 
						@endforeach
					</p>
					<p><strong>პროექტები: </strong>
						@foreach($user->jobs as $job)
						<div>
							<a href="{{URL::to('jobs/show/'.$job->id)}}" class="whitelink"><span class="tags">{{$job->heading}}</span></a>
						</div> 
						@endforeach
					</p>
				</div>             
				<div class="col-xs-12 col-sm-4 text-center">
					<figure>
						@if(empty($user->avatar))
						<img src="{{URL::to('uploads/default_avatar.png')}}" alt="" class="img-circle img-responsive">
						@else
						<img src="{{URL::to('uploads/'.$user->avatar)}}" width="100px" height="100px" id="zoom_04"
						data-zoom-image="{{URL::to('uploads/'.$user->avatar)}}">
						@endif
						<figcaption class="ratings">
							<div class="point">ITDC Point: 80</div>
							<div class="point_slider">
								<div class="point_slide" style="width:100px"></div>
							</div>
						</figcaption>
					</figure>
				</div>
			</div>            
			<div class="col-xs-12 divider text-center">
				<div class="col-xs-12 col-sm-4 emphasis">
					<button class="btn btn-success btn-block my_btn github"> Github </button>
				</div>
				<div class="col-xs-12 col-sm-4 emphasis">
					<button class="btn btn-info btn-block my_btn"><span class="fa fa-user"></span> პროფილი </button>
				</div>
				<div class="col-xs-12 col-sm-4 emphasis">
					<div class="btn-group dropup btn-block">
						<button type="button" class="btn btn-primary my_btn facebook"> Facebook </button>
					</div>
				</div>
			</div>
		</div>                 
	</div>
</div>
<div class="clear"></div>
</div>
</div>
<script type="text/javascript">
	$("#zoom_04").elevateZoom({zoomWindowPosition: 1, zoomWindowOffetx: 2, borderSize:0, zoomLens:false, containLensZoom:true});
</script>
@stop