[extend base.tpl]

[part body]
    <div id="corps">
        <div id="div_menu_left">[parent menu_left]</div>
        <div id="cadre_interface">
        	[parent menu_armee]<br>
            <table class="table table-striped table-bordered">
                <thead><tr><th>Nom</th><th>Carte</th><th></th></tr></thead>
                <tbody>
                    [foreach liste :: key, data]
                        <tr>
                            <td>[!data.nom]</td>
                            <td>[!data.svg]</td>
                            <td><a href="[route armee/ville/!data.id/]"><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-arrow-right"></span> Voir</button></a></td>
                        </tr>
                    [/foreach]
                </tbody>
            </table>
        </div>
    </div>
[/part body]