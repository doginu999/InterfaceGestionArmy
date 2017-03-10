[extend base.tpl]

[part body]
    <div id="corps">
        <div id="div_menu_left">[parent menu_left]</div>
        <div id="cadre_interface">
            Nombre de militaires : [@nombre]<br>
            Moyenne des soldes : [@moy_solde]<br>
            Total mensuel des soldes : [@total_solde]<br>
            Total annuel des soldes : [@total_annuel_solde]<hr>
            Nombre d'hommes : [@nb_homme]<br>
            Nombre de femmes : [@nb_femme]
            <h3>Origines</h3>
            [foreach origine :: orig, nb]
                [!orig] : [!nb] militaires<br>
            [/foreach]
            <h3>Rôles</h3>
            [foreach role :: r, nb]
                [!r] : [!nb] militaires<br>
            [/foreach]
            <h3>Grades</h3>
            [foreach grade :: g, nb]
                [!g] : [!nb] militaires<br>
            [/foreach]
        </div>
    </div>
[/part body]