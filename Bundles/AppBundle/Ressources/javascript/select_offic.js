$('#select_offic').keyup(function(){
	var str = $('#select_offic').val();
	var prefix = ($('#prefix').text().length == 0) ? '' : $('#prefix').text();

	$.ajax({
        url : prefix+'ajax/select_offic/',
        type : 'POST',
        data : 'nom='+str,
        dataType : 'json',
        success: function(data){
        	var text = '';

        	for(i in data){
        		text += '<tr>'+
	        		'<td>'+data[i].id+'</td>'+
	        		'<td>'+data[i].nom+'</td>'+
	        		'<td>'+data[i].prenom+'</td>'+
	        		'<td>'+data[i].grade+'</td>'+
	        		'<td><a onclick="modifValInput('+data[i].id+')"><button class="btn btn-default btn-xs">Choisir</button></a></td>'+
	        	'</tr>';
			}

			$('#tbody_select_offic').html(text);
        }
    });
});

function modifValInput(id){
	$('#id_offic').val(id);
}