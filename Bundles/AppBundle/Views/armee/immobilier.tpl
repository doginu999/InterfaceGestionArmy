[extend base.tpl]

[part body]
    <div id="corps">
        <div id="div_menu_left">[parent menu_left]</div>
        <div id="cadre_interface">
        	[parent menu_armee]<br>
            <table class="table table-striped table-bordered">
                <thead><tr><th>Nom</th><th>Ville</th><th>Quartier</th><th>Nombre d'employés</th></tr></thead>
                <tbody>
                    [foreach liste :: key, data]
                        <tr>
                            <td><a href="[route armee/ressources/immobilier/!data.id/]">[!data.nom]</a></td>
                            <td><a href="[route armee/ville/!data.id_ville/]">[!data.ville]</a></td>
                            <td>[!data.quartier]</td>
                            <td>[!data.nb_employe]</td>
                        </tr>
                    [/foreach]
                </tbody>
            </table>
        </div>
    </div>
[/part body]