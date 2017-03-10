[extend base.tpl]

[part body]
    <div id="corps">
        <div id="div_menu_left">[parent menu_left]</div>
        <div id="cadre_interface">
        	[parent menu_armee]<br><br>
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr><td>Nom de la ville</td><td>[@detail.nom]</td></tr>
                    <tr><td>Nom SVG</td><td>[@detail.svg]</td></tr>
                    <tr><td>Nombre d'employés</td><td>[@nb_employe]</td></tr>
                </tbody>
            </table>
        </div>
    </div>
[/part body]