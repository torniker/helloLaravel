var request; 

function searchBySkill(params){
	console.log(params);
	if (request != null){ 
	    request.abort();
	    request = null;
	}
	
	request = $.ajax({
	    data: {"skills":params},
	    success: function(resp){
	    	console.log(resp);

	    	var usersList = $("#users-list");
	    	usersList.empty();
	        resp.forEach(function(el,index){ 
	        	skillsLabels = '';
	        	
	        	el.skills.forEach(function(skillel){
	        		debugger;
	        		goodSkill = skills.some(function(element, i) {
					    if (skillel.name.toLowerCase() === element.toLowerCase()) {
					        return true;
					    }
					});

	        		if(goodSkill==false){
						skillsLabels += '<span class="label label-default">'+skillel.name+'</span> '; 
	        		} else {
	        			skillsLabels += '<span class="label label-success">'+skillel.name+'</span> '; 
	        		}

	        	});

	       		usersList.append("<tr><td>"+el['firstname']+" "+el['firstname']+"</td><td>"+el['gender']+"</td><td>"+skillsLabels+"</td></tr>"); 
	       	})
	    },
	  	fail:function(){
	  		alert('Search failed!');
	  	}  
	});
	
}

$(function(){
	skillsField = $('#skill-search input[name="skills"]');
	skillsField.on('keyup',function(){
		skills = $(this).val();
		
		skills = skills.replace(new RegExp(' ', 'g'), ',')
		skills = skills.replace(new RegExp(',,+', 'g'), ',');

		skills = skills.split(',');

		total = 0; 
		params = ''; 

		skills.forEach(function(el,i){ params+="skill"+(total++)+"="+el+"&" })
		
		searchBySkill(skills); 
	})

})