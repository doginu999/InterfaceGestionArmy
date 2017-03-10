[extend base.tpl]

[part body]
    <div id="corps">
        <div id="div_menu_left">[parent menu_left]</div>
        <div id="cadre_interface">
        	[parent menu_admin]<br><br>
    		<div id="create_militaire">
    			<div class="panel panel-default">
                    <div class="panel-heading">Enregistrer un matériel</div>
                </div>
                [@form.start]
                    [@form.nom]
                    [@form.categorie]
                    [@form.submit]
                [@form.end]
    		</div>
        </div>
    </div>
[/part body]