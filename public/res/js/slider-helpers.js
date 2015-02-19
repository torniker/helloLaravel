function sliderSetValues(){
	var value,min,max,slider_name,sliders;

	sliders = document.getElementsByClassName('slider');

	for(var i=0; i<sliders.length; i++){
		// debugger;
		slider_name = sliders[i].id;

		min = parseInt(document.querySelector('.min.'+slider_name).value);
		max = parseInt(document.querySelector('.max.'+slider_name).value);

		$("#"+slider_name).data("ionRangeSlider").update({
		    from: min,
		    to: max
		});
		// debugger;
	}
}

function sliderChanges(data){
	var value,min,max,slider_name;
	slider_name = data.input[0].id;
	value = data.input.val().split(';');
	min = value[0];
	max = value[1];

	document.querySelector('.min.'+slider_name).value = min;
	document.querySelector('.max.'+slider_name).value = max;

}