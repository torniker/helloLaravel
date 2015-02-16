<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    	<link href="{{ URL::to('res/css/bootstrap.min.css') }}" rel="stylesheet">
	    <link href="{{ URL::to('res/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
	    <link href="{{ URL::to('res/css/animate.css') }}" rel="stylesheet">
	    <link href="{{ URL::to('res/css/style.css') }}" rel="stylesheet">
	    
	    <script src="{{ URL::to('res/js/jquery-2.1.1.js') }}"></script>
    	<script src="{{ URL::to('res/js/bootstrap.min.js') }}"></script>

		<script src="{{ URL::to('res/js/inspinia.js') }}"></script>
    	
    	<!-- Plugins -->
	    <link href="{{ URL::to('res/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    	<script src="{{ URL::to('res/js/plugins/toastr/toastr.min.js') }}"></script>

    	<script src="{{ URL::to('res/js/plugins/validate/jquery.validate.min.js') }}"></script>
    	<script src="{{ URL::to('res/js/scripts.js') }}"></script>

    	<script src="{{ URL::to('res/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
		<script src="{{ URL::to('res/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
		<script src="{{ URL::to('res/js/plugins/pace/pace.min.js') }}"></script>
		<script src="{{ URL::to('res/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
		
	    @yield('master_head')
	</head>
	<body class='fixed-sidebar'>

		<script>
			notifications = {{ Notification::all()->toJson() }};

			for (var i=0; i<notifications.length; i++){
				if(notifications[i].type=='error'){
					toastr.error(notifications[i].message)
				} else if(notifications[i].type=='success'){
					toastr.success(notifications[i].message)
				} else if(notifications[i].type=='info'){
					toastr.info(notifications[i].message)
				} else if(notifications[i].type=='warning'){
					toastr.warning(notifications[i].message)
				}
			}

			$(function(){
				// $('body').addClass('fixed-sidebar');
			});
		</script>
		@yield('master_body')

	</body>
</html>