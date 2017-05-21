$(document).ready(function() {
	$('#user_form').validate();

	$("#submit").click(function() {

		var id = $('#fid').val();
		var name = $('#fname').val();
		var email = $('#femail').val();
		var birthdate = $('#fbirthdate').val();
		var favcolor = $('#ffavcolor').val();
		var url = $('#faction').val();
		var homepage = $('#fhomepage').val();
		var formData;
		formData = {
			id : id,
			name : name,
			email : email,
			birthdate : birthdate,
			favcolor : favcolor

		};

		$.ajax({
			type : 'POST',
			url : url,
			data : formData,
			success : function(data) {
				if(data['result'] == 'success') {
					$(location).attr('href', homepage);
				} else {
					$('#errors').append('<div class="alert alert-danger">'+data['errors']+'</div>')
				}
			}
		});
		return false;
	});

});
