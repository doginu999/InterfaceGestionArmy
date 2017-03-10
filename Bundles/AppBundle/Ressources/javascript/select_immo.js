$('#select_immo').keyup(function(){
	var str = $('#select_immo').val();
	var prefix = ($('#prefix').text().length == 0) ? '' : $('#prefix').text();

	$.ajax({
        url : prefix+'ajax/select_immo/',
        type : 'POST',
        data : 'nom='+str,
        dataType : 'json',
        success: function(data){
        	var text = '';

        	for(i in data){
        		text += '<tr>'+
	        		'<td>'+data[i].id+'</td>'+
	        		'<td>'+data[i].nom+'</td>'+
	        		'<td><a onclick="modifValInputImmo('+data[i].id+')"><button class="btn btn-default btn-xs">Choisir</button></a></td>'+
	        	'</tr>';
			}

			$('#tbody_select_immo').html(text);
        }
    });
});

function modifValInputImmo(id){
	$('#id_immo').val(id);
}