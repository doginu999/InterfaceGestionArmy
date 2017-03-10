<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>IGA</title>
        <link rel="stylesheet" media="screen" type="text/css" href="[bundle css/design.css]">
        <link rel="stylesheet" media="screen" type="text/css" href="[bundle css/sidebar.css]">
        <link rel="stylesheet" media="screen" type="text/css" href="[bundle css/bootstrap/bootstrap.css]">
        <link rel="icon" type="image/png" href="[bundle images/favicon.png]">
        <link rel="shortcut icon" type="image/x-icon" href="[bundle images/favicon.ico]">
        [part head][/part head]
    </head>
    <body>
        [part body]
            [part menu_left]
                <div class="sidebar-nav menu_left">
                    <div class="navbar navbar-default" role="navigation">
                        <div class="navbar-collapse collapse sidebar-navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="[route carte/]">Carte</a></li>
                                <li><a href="[route armee/]">Armée</a></li>
                                <li><a href="[route achat/]">Acheter</a></li>
                                <li><a href="[route statistique/]">Statistiques</a></li>
                                <li><a href="[route intranet/]">Intranet</a></li>
                                <li><a href="[route bddis/]">BDDIS</a></li>
                                <li><a href="[route admin/]">Administration</a></li>
                                <li><a href="[route deconnexion/]"><span class="glyphicon glyphicon-off"></span> Déconnexion</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            [/part menu_left]
            [part menu_armee]
                <a href="[route armee/ressources_humaines/]"><button class="btn btn-default">Ressources humaines</button></a>
                <a href="[route armee/ressources/vehicule/]"><button class="btn btn-default">Véhicules</button></a>
                <a href="[route armee/ressources/aeronef/]"><button class="btn btn-default">Aéronefs</button></a>
                <a href="[route armee/ressources/navire/]"><button class="btn btn-default">Navires</button></a>
                <a href="[route armee/ressources/arme_munition/]"><button class="btn btn-default">Armes et munitions</button></a>
                <a href="[route armee/ressources/equipement/]"><button class="btn btn-default">Equipements</button></a>
                <a href="[route armee/ressources/police/]"><button class="btn btn-default">Police</button></a>
                <a href="[route armee/ressources/satellite/]"><button class="btn btn-default">Satellites</button></a>
                <a href="[route armee/ressources/utilitaire/]"><button class="btn btn-default">Utilitaires</button></a>
                <a href="[route armee/ressources/medical/]"><button class="btn btn-default">Médical</button></a>
                <a href="[route armee/ressources/immobilier/]"><button class="btn btn-default">Immobilier</button></a>
                <a href="[route armee/organisation/]"><button class="btn btn-default">Organisation</button></a><br>
                <a href="[route armee/hist_action/]"><button class="btn btn-default">Historique actions</button></a>
                <a href="[route armee/depense_perte/]"><button class="btn btn-default">Dépense / perte</button></a>
                <a href="[route armee/ville/]"><button class="btn btn-default">Villes</button></a>
            [/part menu_armee]
            [part menu_admin]
                <a href="[route admin/]"><button class="btn btn-default">Admin</button></a>
                <a href="[route admin/add_depense/]"><button class="btn btn-default">Dépense / perte</button></a>
                <a href="[route admin/add_militaire/]"><button class="btn btn-default">Militaire</button></a>
                <a href="[route admin/add_materiel/]"><button class="btn btn-default">Matériel</button></a>
                <a href="[route admin/add_role/]"><button class="btn btn-default">Rôle</button></a>
                <a href="[route admin/add_immo/]"><button class="btn btn-default">Immobilier</button></a>
                <a href="[route admin/add_ville/]"><button class="btn btn-default">Ville</button></a>
            [/part menu_admin]
        [/part body]
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="[bundle javascript/bootstrap/bootstrap.min.js]"></script>
        [part js_end][/part js_end]
    </body>
</html>