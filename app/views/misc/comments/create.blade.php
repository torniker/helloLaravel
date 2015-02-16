<div class="ibox float-e-margins">
    <div class="ibox-title"><h5>Add new comment</h5></div>
    <div class="ibox-content">
		{{ Form::open(['route'=>'comments.store','method'=>'post','class'=>'comment_form','id'=>'post_comment_form']) }}
			{{ Form::hidden('project_id',$project_id) }}
			<div class='form-group clearfix'>
				<div class='col-xs-18 nopadding-left'>
					{{ Form::textarea('message',null,['class'=>"form-control comment-form"])}}
				</div>
			</div>
			<div class='clearfix'>
				<div class='form-group pull-right col-xs-6 nopadding-right'>
					{{ Form::submit('Add Comment',['class'=>'btn btn btn-lg btn-primary col-xs-24 nopadding-left nopadding-right']) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
	<script>
		$(function(){
			$('#post_comment_form').validate({
				rules:{
					message: {
						required: true
					}
				}
			})
		})
	</script>
</div>