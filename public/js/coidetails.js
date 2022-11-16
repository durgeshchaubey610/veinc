$(function() {
            $(".modalbox").fancybox({'openEffect': 'none',fitToView: true});
			
            $( "#tabs" ).tabs();
			$( "#tabs" ).show();
            $( "#date_cp_in" ).datepicker({
             dateFormat:'mm/dd/yy',
             changeMonth: true,
             changeYear: true
             });
             $( "#date_cp_out" ).datepicker({
             dateFormat:'mm/dd/yy',
             changeMonth: true,
             changeYear: true
             });
          });


function checkNewcoidetails() 
{  
    parent.CheckForSessionpop(baseUrl);
    $('#addnewcoidetails').attr('disabled',true);
	var certificate_holder = $("#certificate_holder").val();
	var certificate_description = $("#certificate_description").val();
	
	var submit_flag = true;
	if(certificate_holder==''){
			$('#holder_name_error').html("Please Enter Certificate Holder Information");
			submit_flag = false;
	}
	if(certificate_description==''){
			$('#description_name_error').html("Please Enter Description of Special Terms");
			submit_flag = false;
	}
	
	if(!submit_flag) {
		$('#addnewcoidetails').attr('disabled',false);
	}
	if(submit_flag) {
		$('.loader').show();
		$.ajax({
				url         : baseUrl+"coi/createnewcoidetails",
				type        : "post",
				datatype    : 'json',
				data        : {coi_au_details_holder:certificate_holder,coi_au_details_specialterms:certificate_description},
				success     : function( data ) {
				var content = $.parseJSON(data);
                    if(content.status=='success'){
						$('.loader').hide();
						//parent.jQuery.fancybox.close();
						parent.location.reload();
						
					}else{
						alert('Error occurred');
						location.reload();
					}
				},
				error       : function(){
					alert('There was an error');
				}

			 });
	
	} else {
	    return false;
	}
}


function updateCoidetails() 
{
 $('#updatenewcoidetails').attr('disabled',true);
    var cid = $("#cid").val();
    var bid = $("#bid").val();
    var uniquecc = $("#uniquecc").val();
	var certificate_holder = $("#certificate_holder").val();
	var certificate_description = $("#certificate_description").val();
	var submit_flag = true;
	if(certificate_holder==''){
			$('#holder_name_error').html("Please Enter Certificate Holder Information");
			submit_flag = false;
	}
	if(certificate_description==''){
			$('#description_name_error').html("Please Enter Description of Special Terms");
			submit_flag = false;
	}
	
	if(!submit_flag) {
		$('#updatenewcoidetails').attr('disabled',false);
	}
	if(submit_flag) {
		$('.loader').show();
		$.ajax({
				url         : baseUrl+"coi/updatecoidetailstest",
				type        : "post",
				datatype    : 'json',
				data        : {coi_au_details_ID:cid,Building_ID:bid,uniqueCostCenter:uniquecc,coi_au_details_holder:certificate_holder,coi_au_details_specialterms:certificate_description},
				success     : function( data ) {
				var content = $.parseJSON(data);
                    if(content.status=='success'){
						$('.loader').hide();
						//parent.jQuery.fancybox.close();
						parent.location.reload();
						
					}else{
						alert('Error occurred');
						location.reload();
					}
				},
				error       : function(){
					alert('There was an error');
				}

			 });
	
	} else {
	    return false;
	}
		
		
}

function cancelReport() 
{
	parent.jQuery.fancybox.close();
}

function showEditCoidetails(id)
{
	
	$('.loader').show();
	if(id!='') {
		$.ajax({
					url         : baseUrl+"coi/editcoidetails",
					type        : "post",
					data        : {id:id},
					success     : function( data ) {
							$('.loader').hide();
							$('#show_Edit_Report_div').html(data);
							$('#show_Edit_Report_div_href').trigger('click');
							
							//reloadPage();
					},
					error       : function(){
						alert('There was an error');
					}

		});
	}
}

function deleteCoiDetails(cid) 
{
	var check_delete='YES';
    var return_value = jPrompt("For Deleting Coi Details, Enter Yes in Capital letters.", '', 'Vision Work Orders', function(return_value) { 
        if(return_value!=null){
                if(check_delete === return_value){
                $('.loader').show();
	if(cid!='') {
		$.ajax({
					url         : baseUrl+"coi/deletecoidetails",
					type        : "post",
					datatype    : 'json',
					data        : {cid:cid},
					success     : function( data ) {
					var content = $.parseJSON(data);
						if(content.status=='success'){
							$('.loader').hide();
							location.reload();
						}else{
							alert('Error occurred');
							location.reload();
						}
					},
					error       : function(){
						alert('There was an error');
					}

		});
	}
	 } else{
                $('#cw_error').html('You have entered wrong word.');
            }
        } } );
}

