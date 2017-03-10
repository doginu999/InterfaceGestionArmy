$('#select_sup').keyup(function(){
	var str = $('#select_sup').val();
	var prefix = ($('#prefix').text().length == 0) ? '' : $('#prefix').text();

	$.ajax({
        url : prefix+'ajax/select_sup/',
        type : 'POST',
        data : 'nom='+str,
        dataType : 'json',
        success: function(data){
        	var text = '';

        	for(i in data){
        		text += '<tr>'+
	        		'<td>'+data[i].id+'</td>'+
	        		'<td>'+data[i].nom+'</td>'+
	        		'<td><a onclick="modifValInputSup('+data[i].id+')"><button class="btn btn-default btn-xs">Choisir</button></a></td>'+
	        	'</tr>';
			}

			$('#tbody_select_sup').html(text);
        }
    });
});

function modifValInputSup(id){
	$('#id_sup').val(id);
}