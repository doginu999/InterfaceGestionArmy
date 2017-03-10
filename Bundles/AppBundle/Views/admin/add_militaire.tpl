[extend base.tpl]

[part body]
    <div id="corps">
        <div id="div_menu_left">[parent menu_left]</div>
        <div id="cadre_interface">
        	[parent menu_admin]<br><br>
    		<div id="create_militaire">
                <span id="prefix">[@prefix]</span>
    			<div class="panel panel-default">
                    <div class="panel-heading">Enregistrer un militaire</div>
                </div>
    			[@form.start]
    				[@form.nom]
                    [@form.prenom]
                    <hr>
                    [@form.password]
                    <div id="div_button_password"><button type="button" id="button_password" class="btn btn-info btn-md">Générer un password</button></div><hr>
                    [@form.naissance]
                    [@form.role]
                    [@form.ecole]
                    <hr>
                    [@form.orga]
                    <div id="div_button_orga">
                        <button type="button" id="button_orga" class="btn btn-info btn-md" data-toggle="modal" data-target="#modal_orga">Choisir une branche</button>
                    </div><hr>
                    [@form.offic]
                    [@form.orig]
                    [@form.grade]
                    [@form.sexe]
    				[@form.submit]
    			[@form.end]
    		</div>
        </div>
        <div id="modal_orga" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Sélection d'une branche</h4>
                    </div>
                    <div class="modal-body">
                        [@form.select_orga]<hr>
                        <table class="table table-bordered">
                            <thead><tr><td>ID</td><td>Nom</td></tr></thead>
                            <tbody id="tbody_select_sup"></tbody>
                        </table>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
                </div>
            </div>
        </div>
    </div>
[/part body]

[part js_end]
    <script src="[bundle javascript/gener_password.js]"></script>
    <script src="[bundle javascript/select_sup.js]"></script>
[/part js_end]