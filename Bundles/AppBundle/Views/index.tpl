[extend base.tpl]

[part body]
    <div id="corps">
        <div id="emplac_form_conn_home">
            [@form.start]
                <h2 class="text-info">Connexion</h2>
                [@form.ident]<br>
                [@form.password]
                <div id="form_conn_two_droite">
                    <p id="p_submit_conn">[@form.submit]</p>
                    [traduction mdp_oubli] ? <a href="[route mdp_oubli/]">[traduction mdp_modif]</a>
                </div>
            [@form.end]
        </div>
    </div>
[/part body]