$('#button_password').click(function(){
	var prefix = ($('#prefix').text().length == 0) ? '' : $('#prefix').text();

    $.ajax({
        url : prefix+'ajax/gener_password/',
        type : 'POST',
        dataType : 'json',
        success: function(data){
        	$('#password_input').val(data);
        }
    });
});