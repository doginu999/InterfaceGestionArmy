[extend base.tpl]

[part head]
    <link rel="stylesheet" media="screen" type="text/css" href="[bundle css/datatables.css]">
[/part head]

[part body]
    <div id="corps">
        <div id="div_menu_left">[parent menu_left]</div>
        <div id="cadre_interface">
        	[parent menu_armee]<br>
        	<div id="liste_orga">
                <div id="entete_orga">
                    > <a href="[route armee/organisation/0/]">Armée</a>
                    [foreach hierar_orga :: key, data]
                        > <a href="[route armee/organisation/!data.id/]">[!data.nom]</a> 
                    [/foreach]
                </div>
                <div>
                    <div id="liste_organisation">
                        <table class="table table-bordered">
                            <tr>
                                <td>Nom</td>
                                <td>Officier</td>
                                <td>Localisation</td>
                            </tr>
                            [foreach liste :: key, tree]
                                <tr>
                                    <td><a href="[route armee/organisation/!tree.id/]">[!tree.nom]</a></td>
                                    <td><a href="[route armee/militaire/!tree.resp.id/]">[!tree.resp.ident]</a></td>
                                    <td>[!tree.local]</td>
                                </tr>
                            [/foreach]
                        </table>
                    </div>
            		<div id="create_organisation">
                        <div id="div_button_liste_milit">
                            <button type="button" id="button_liste_milit" class="btn btn-info btn-md" data-toggle="modal" data-target="#modal_liste_militaire">Liste des militaires</button>
                        </div>
                        <span id="prefix">[@prefix]</span>
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab">
                                    <h4 class="panel-title"><a role="collapsed" data-toggle="collapse" data-parent="#accordion" href="#branche" aria-expanded="true">Créer une branche</a></h4>
                                </div>
                                <div id="branche" class="panel-collapse collapse" role="tabpanel">
                                    <div class="panel-body">
                                        [@form.start]
                                            [@form.nom]
                                            [@form.type]<hr>
                                            [@form.offic]
                                            <div id="div_button_milit">
                                                <button type="button" id="button_milit" class="btn btn-info btn-md" data-toggle="modal" data-target="#modal_militaire">Choisir un militaire</button>
                                            </div><hr>
                                            [@form.sup]
                                            <div id="div_button_sup">
                                                <button type="button" id="button_sup" class="btn btn-info btn-md" data-toggle="modal" data-target="#modal_orga_sup">Choisir une branche supérieure</button>
                                            </div><hr>
                                            [@form.immo]
                                            <div id="div_button_immo">
                                                <button type="button" id="button_immo" class="btn btn-info btn-md" data-toggle="modal" data-target=#modal_immobilier>Choisir une propriété immobilière</button>
                                            </div><hr>
                                            [@form.submit]
                                        [@form.end]
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab">
                                    <h4 class="panel-title"><a role="collapsed" data-toggle="collapse" data-parent="#accordion" href="#materiel" aria-expanded="true">Matériel</a></h4>
                                </div>
                                <div id="materiel" class="panel-collapse collapse" role="tabpanel">
                                    <div class="panel-body">
                                        [foreach materiel :: mat, nb]
                                            [!mat] x[!nb]<br>
                                        [/foreach]
                                    </div>
                                </div>
                            </div>
                            [if orga != 0]
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab">
                                        <h4 class="panel-title"><a role="collapsed" data-toggle="collapse" data-parent="#accordion" href="#rename" aria-expanded="true">Renommer</a></h4>
                                    </div>
                                    <div id="rename" class="panel-collapse collapse" role="tabpanel">
                                        <div class="panel-body">
                                            [@form_rename.start]
                                                [@form_rename.nom]
                                                [@form_rename.id]
                                                [@form_rename.submit]
                                            [@form_rename.end]
                                        </div>
                                    </div>
                                </div>
                            [/condition]
                        </div>
            		</div>
                </div>
        	</div>
        </div>
        <div id="modal_liste_militaire" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Liste des militaires</h4>
                    </div>
                    <div class="modal-body">
                        [if liste_militaire == !empty]
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
                                            <td><a href="[route iga/militaire/!data.id/]"><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-arrow-right"></span> Voir</button></a></td>
                                        </tr>
                                    [/foreach]
                                </tbody>
                            </table>
                        [/condition]
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
                </div>
            </div>
        </div>
        <div id="modal_militaire" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Sélection d'un militaire</h4>
                    </div>
                    <div class="modal-body">
                        [@form.select_offic]<hr>
                        <table class="table table-bordered">
                            <thead><tr><td>ID</td><td>Nom</td><td>Prénom</td><td>Grade</td><td></td></tr></thead>
                            <tbody id="tbody_select_offic"></tbody>
                        </table>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
                </div>
            </div>
        </div>
        <div id="modal_orga_sup" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Sélection d'une branche supérieure</h4>
                    </div>
                    <div class="modal-body">
                        [@form.select_sup]<hr>
                        <table class="table table-bordered">
                            <thead><tr><td>ID</td><td>Nom</td><td></td></tr></thead>
                            <tbody id="tbody_select_sup"></tbody>
                        </table>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
                </div>
            </div>
        </div>
        <div id="modal_immobilier" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Sélection d'une propriété immobilière</h4>
                    </div>
                    <div class="modal-body">
                        [@form.select_immo]<hr>
                        <table class="table table-bordered">
                            <thead><tr><td>ID</td><td>Nom</td><td></td></tr></thead>
                            <tbody id="tbody_select_immo"></tbody>
                        </table>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
                </div>
            </div>
        </div>
    </div>
[/part body]

[part js_end]
    <script src="[bundle javascript/select_immo.js]"></script>
    <script src="[bundle javascript/select_offic.js]"></script>
    <script src="[bundle javascript/select_sup.js]"></script>
    <script src="[bundle javascript/dataTable/datatables.js]"></script>
    <script src="[bundle javascript/dataTable/table_ress_homme.js]"></script>
[/part js_end]