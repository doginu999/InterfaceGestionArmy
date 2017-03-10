[extend base.tpl]

[part body]
    <div id="corps">
        <div id="div_menu_left">[parent menu_left]</div>
        <div id="cadre_interface">
            [parent menu_armee]<br>
            <table class="table table-striped table-bordered">
                <thead><tr><th>Matériel</th><th>Nombre</th><th>Utilisé</th><th>Valeur</th></tr></thead>
                <tbody>
                    [foreach liste :: key, data]
                        <tr>
                            <td>[!data.nom]</td>
                            <td>[!data.nb]</td>
                            <td>[!data.use]</td>
                            <td>[!data.value]</td>
                        </tr>
                    [/foreach]
                </tbody>
            </table>
        </div>
    </div>
[/part body]