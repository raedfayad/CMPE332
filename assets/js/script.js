
$(document).ready(function() {
// Function to change form action.
	$("#sel_donate").change(function() {
		var selected = $(this).children(":selected").text();
		switch (selected) {
			case "Lookup Donor Statistics":
			$("#myform").attr('action', 'donor_stats.php');
			break;
			
			case "Lookup Organization Statistics":
			$("#myform").attr('action', 'org_donation_stats.php');
			break;
			
			case "Donate to an Organization":
			$("#myform").attr('action', 'donate.php');
			break;
			
			default:
			$("#myform").attr('action', '#');
		}
	});
});

$(document).ready(function() {
// Function to change form action.
	$("#sel_employee").change(function() {
		var selected = $(this).children(":selected").text();
		switch (selected) {
			case "Lookup Driver Information":
			$("#employeeform").attr('action', 'driver_info.php');
			break;
			
			case "Change Animal Location":
			$("#employeeform").attr('action', 'change_animal_location.php');
			break;
			
			default:
			$("#employeeform").attr('action', '#');
		}
	});
});
$(document).ready(function() {
	$("#sel_organization").change(function() {
		var selected = $(this).children(":selected").text();
		switch (selected) {
			case "SPCA":
			$("#org-form").attr('action', 'org_info.php');

			break;
			
			case "Rescue Organizations":
			$("#org-form").attr('action', 'rescue_stats.php');
			break;
			
			case "Shelter":
			$("#org-form").attr('action', 'org_info.php');
			break;
			
			default:
			$("#org-form").attr('action', '#'); 
		}
	});
});

jQuery(document).ready(function(){
  jQuery('#rescued').on('change', function(event){
    if(this.value === 'Yes'){
    	$('#driver').attr('required',true)
		$('#rescue_names').attr('required',true)
    }
    
  })
});

jQuery(document).ready(function(){
	  jQuery('#sel_organization').on('change', function(event){
		if(this.value === '1' ){
			$('#sel_location').attr('required',true)
		}
		if(this.value === '2' ){
			$('#sel_location').attr('required',false)
		}
		if(this.value === '3' ){
			$('#sel_location').attr('required',true)
		}
	  })
	});
	
function doubledropdown(first,second,req_num) {
	$(first).change(function(){

		var post_id = $(this).val();
		
		// Empty first and second dropdown
		$(second).find('option').not(':first').remove();

		// AJAX request
		$.ajax({
			url: 'ajaxfile.php',
			type: 'post',
			data: {request: req_num, post_id: post_id},
			dataType: 'json',
			success: function(response){
				
				var len = response.length;

				for( var i = 0; i<len; i++){
				   
					var name = response[i]['var_name'];
						
					$(second).append("<option value='"+name+"'>"+name+"</option>");

				}
			}
		});	
	});	
};
	