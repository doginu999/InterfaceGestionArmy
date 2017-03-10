$(document).ready(function(){
  oTable=$('#tableMater').dataTable({
    "sDom": '<"top"rf>t<"bottom"ip><"clear">',
    "bProcessing": true,
    "bAutoWidth":false,
    "sPaginationType": "full_numbers",
    "bFilter": true,
    "bSort": true,
    "iDisplayLength": 12,
    "bLengthChange": false,
    "columns": [ 
      {"bSearchable": true, "sWidth" : "10px", "bSortable": true },
      {"bSearchable": true, "sWidth" : "10px", "bSortable": true },
      {"bSearchable": true, "sWidth" : "10px", "bSortable": true }
    ],
    "oLanguage": {
      "sProcessing": "Recherche...",
      "sLengthMenu": "affichage _MENU_ fiche par page",
      "sZeroRecords": "Aucune correspondance",
      "sInfo": "Matériels _START_ à _END_ sur _TOTAL_",
      "sInfoEmpty": "0 fiche",
      "sInfoFiltered": "",
      "sInfoPostFix": "",
      "sSearch": "Recherche &nbsp;",
      "sUrl": "",
      "oPaginate": {
        "sFirst":    "D&eacutebut",
        "sPrevious": "Pr&eacutec&eacutedent",
        "sNext":     "Suivant",
        "sLast":     "Fin"
      }
    }
  });
});