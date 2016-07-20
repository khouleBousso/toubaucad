<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
                try {
                    ace.settings.check('navbar', 'fixed')
                } catch (e) {
                }
    </script>

<div id="navbar-container" class="navbar-container">
        <button data-target="#sidebar" id="menu-toggler" class="navbar-toggle menu-toggler pull-left" type="button">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a class="navbar-brand" ng-href="#/accueil">
                <small>
                    <i class="fa fa-leaf"></i>
                    Gestion Daara Touba UCAD
                </small>
            </a>
        </div>

        <div role="navigation" class="navbar-buttons navbar-header pull-right"  ng-controller="NavCtrl">
            <ul class="nav ace-nav">
                <li class="purple">
<!--                    <a target="_blank" ng-href="chat?inf={{user.nom}};{{user.prenom}};{{user.code_profil}}">-->
                    <a target="_blank" >
                        <span><i class="fa fa-weixin bigger-180"></i></span>
                    </a>
                </li>
                <li class="light-blue" >
                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="cursor: pointer">
                        <img src="public/images/profils/unlogo.jpg"  ng-show="user.avatar == null || user.avatar == ''"  class="nav-user-photo"/>

                        <img  width="50" height="40" ng-src="rest/avatarUsers/{{user.avatar}}" ng-show="user.avatar != null && user.avatar != ''" class="nav-user-photo"/>

                        <span 
                            class="user-info "> <small>Bienvenue 
                                <span ng-if=" user.nom != null && user.nom != ''">,</span></small><span ng-if=" user.nom != null && user.nom != ''">{{user.nom}}</span>
                        </span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#/motdepasse/{{user.id}}">
                                <i class="ace-icon fa fa-cog"></i>
                                Param&egrave;tres
                            </a>
                        </li>

                        <li ng-if=" user.id_profil !=5">
                            <a href="#/profil/{{user.id}}" >
                                <i class="ace-icon fa fa-user"></i>
                                Profil
                            </a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="" data-ng-click="logout()">
                                <i class="ace-icon fa fa-power-off"></i>
                                D&eacute;connexion
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>