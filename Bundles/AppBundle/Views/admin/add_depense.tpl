[extend base.tpl]

[part body]
    <div id="corps">
        <div id="div_menu_left">[parent menu_left]</div>
        <div id="cadre_interface">
        	[parent menu_admin]<br><br>
    		<div id="create_militaire">
    			<div class="panel panel-default">
                    <div class="panel-heading">Enregistrer une dépense</div>
                </div>
                [@form.start]
                    [@form.materiel]
                    [@form.nombre]
                    [@form.submit]
                [@form.end]
    		</div>
        </div>
    </div>
[/part body]