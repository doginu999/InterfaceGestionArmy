[extend base.tpl]

[part head]
    <link rel="stylesheet" media="screen" type="text/css" href="[bundle css/datatables.css]">
[/part head]

[part body]
    <div id="corps">
        <div id="div_menu_left">[parent menu_left]</div>
        <div id="cadre_interface">
            [parent menu_armee]<br>
            <div id="liste_depense">
                <table class="table table-striped table-bordered" id="tableMater">
                    <thead><tr><th>Matériel</th><th>Quantité</th><th>Total</th></tr></thead>
                    <tbody>
                        [foreach liste :: key, data]
                            <tr>
                                <td>[!data.materiel]</td>
                                <td>[!data.nombre]</td>
                                <td>[!data.valeur]</td>
                            </tr>
                        [/foreach]
                    </tbody>
                </table>
            </div>
            <h3>Somme totale : [@somme] drars</h3>
        </div>
    </div>
[/part body]

[part js_end]
    <script src="[bundle javascript/dataTable/datatables.js]"></script>
    <script src="[bundle javascript/dataTable/table_mat_use.js]"></script>
[/part js_end]