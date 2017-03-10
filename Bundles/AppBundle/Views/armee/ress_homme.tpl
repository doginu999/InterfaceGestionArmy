[extend base.tpl]

[part head]
    <link rel="stylesheet" media="screen" type="text/css" href="[bundle css/datatables.css]">
[/part head]

[part body]
    <div id="corps">
        <div id="div_menu_left">[parent menu_left]</div>
        <div id="cadre_interface">
        	[parent menu_armee]<br>
        	[if liste_militaire == !empty]
                <div id="liste_militaire_orga">
                    <table class="table table-striped table-bordered" id="tableMilit">
                        <thead>
                            <tr>
                                <th class="th_list text-center"><span class="title_table_rh">Nom</span></th>
                                <th class="th_list text-center"><span class="title_table_rh">Prénom</span></th>
                                <th class="th_list text-center"><span class="title_table_rh">Age</span></th>
                                <th class="th_list text-center"><span class="title_table_rh">Solde</span></th>
                                <th class="th_list text-center"><span class="title_table_rh">Grade</span></th>
                                <th class="th_list text-center"><span class="title_table_rh">Rôle</span></th>
                                <th class="th_list text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            [foreach liste_militaire :: key, data]
                                <tr>
                                    <td>[!data.nom]</td>
                                    <td>[!data.prenom]</td>
                                    <td>[!data.age]</td>
                                    <td>[!data.solde]</td>
                                    <td>[!data.grade]</td>
                                    <td>[!data.specialite]</td>
                                    <td><a href="[route armee/militaire/!data.id/]"><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-arrow-right"></span> Voir</button></a></td>
                                </tr>
                            [/foreach]
                        </tbody>
                    </table>
                </div>
            [/condition]
        </div>
    </div>
[/part body]

[part js_end]
    <script src="[bundle javascript/dataTable/datatables.js]"></script>
    <script src="[bundle javascript/dataTable/table_ress_homme.js]"></script>
[/part js_end]