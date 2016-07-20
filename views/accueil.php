<div class="breadcrumbs" id="breadcrumbs">

    <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i> <a
                ui-sref="accueil">Accueil</a></li>
    </ul>
    <!-- /.breadcrumb -->

    <!-- #section:basics/content.searchbox -->
    <div class="nav-search" id="nav-search">
        <form class="form-search">
            <span class="input-icon"> <input type="text"
                                             placeholder="Rechercher ..." class="nav-search-input"
                                             id="nav-search-input" autocomplete="off" /> <i
                                             class="ace-icon fa fa-search nav-search-icon"></i>
            </span>
        </form>
    </div>
    <!-- /.nav-search -->

    <!-- /section:basics/content.searchbox -->
</div><br/>
<div class="page-content">
    <div class="row" ng-controller="StatCtrl">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="alert alert-block alert-success">

                <i class="ace-icon fa fa-check green"></i>

                Bienvenue &agrave;

                l'application
                <strong class="green">(Gestion Thiantacones)</strong>								,
                du Daara Touba UCAD.
            </div>

            <div class="row">
                <div class="space-6"></div>

                <div class="col-sm-6 infobox-container">
                    <!-- #section:pages/dashboard.infobox -->
                    <div class="infobox infobox-green">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-users"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">{{totalthiantacones}}</span>
                            <div class="infobox-content">Thiantacones</div>
                        </div>

                        <!-- #section:pages/dashboard.infobox.stat -->


                        <!-- /section:pages/dashboard.infobox.stat -->
                    </div>

                    <div class="infobox infobox-pink">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-users"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">{{nbrfemmes}}</span>
                            <div class="infobox-content">Femmes</div>
                        </div>
                        <div class="stat stat-important" ng-if="totalthiantacones != 0">{{nbrfemmes * 100 / totalthiantacones| number:0}}%</div>
                        <div class="stat stat-important" ng-if="totalthiantacones == 0">0%</div>
                    </div>

                    <div class="infobox infobox-red">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-users"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">{{nbrhommes}}</span>
                            <div class="infobox-content">Hommes</div>
                        </div>

                        <div class="stat stat-important" ng-if="totalthiantacones != 0">{{nbrhommes * 100 / totalthiantacones| number:0}}%</div>
                        <div class="stat stat-important" ng-if="totalthiantacones == 0">0%</div>
                    </div>

                    <div class="infobox infobox-orange2">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-users"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">{{nbrEtudiants}}</span>
                            <div class="infobox-content">Etudiants</div>
                        </div>
                            <div class="stat stat-important" ng-if="totalthiantacones != 0">{{nbrEtudiants * 100 / totalthiantacones| number:0}}%</div>
                            <div class="stat stat-important" ng-if="totalthiantacones == 0">0%</div>
                    </div>

                </div>


                <div class="col-sm-5">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-small">
                            <h5 class="widget-title">
                                <i class="ace-icon fa fa-signal"></i>
                                Statistiques
                            </h5>
                            <div class="widget-toolbar no-border">
                                <div class="inline dropdown-hover">
                                    <button class="btn btn-minier btn-primary">
                                        Année
                                        <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                                        <li class="active">
                                            <a class="blue" href="#">
                                                <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                                                2016
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                                2015
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                                2014
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <!-- #section:plugins/charts.flotchart -->
                                <div id="piechart-placeholder"></div>

                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div><!-- /.widget-box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="hr hr32 hr-dotted"></div>
            <div class="row">
            <div class="col-sm-6">
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Progressions Ndigueuls
                        </h4>

                        <div class="widget-toolbar">
                            <a data-action="collapse" href="#">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table class="table table-bordered table-striped">
                                <thead class="thin-border-bottom">
                                <tr>
                                    <th>
                                        <i class="ace-icon fa fa-caret-right blue"></i>Nom
                                    </th>

                                    <th class="hidden-480">
                                        <i class="ace-icon fa fa-caret-right blue"></i>Statut
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr ng-repeat="ndigueul in ndigueulsEnCours">
                                    <td>{{ndigueul.nom}}</td>

                                    <td>
                                        <div>
                                            <div class="clearfix">
                                                <span class="pull-right">{{ndigueul.percent | number : 2}}%</span>
                                            </div>

                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="width:{{ndigueul.percent | number : 4}}%"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div>
            <div class="col-sm-6">
                <div class="widget-box transparent" id="recent-box">
                    <div class="widget-header">
                        <h4 class="widget-title lighter smaller">
                            <i class="ace-icon fa fa-rss orange"></i>UTILISATEURS
                        </h4>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-4">
                            <div id="member-tab">
                                <!-- #section:pages/dashboard.members -->
                                <div class="clearfix">
                                    <div class="itemdiv memberdiv" ng-repeat="user in users">

                                        <div class="user" ng-show="user.avatar == null || user.avatar == ''">
                                            <img src="public/images/profils/unlogo.jpg"  width="48" height="48" class="nav-user-photo"/>
                                        </div>

                                        <div class="user" ng-show="user.avatar != null && user.avatar != ''">
                                            <img ng-src="rest/avatarUsers/{{user.avatar}}" width="48" height="48"   class="nav-user-photo"/>
                                        </div>
                                        <div class="body">
                                            <div class="name">
                                                <a href="#/profil/{{user.id}}">{{user.nom}} {{user.prenom}}</a>
                                            </div>

                                            <div ng-if="user.status == 'ON'">
                                                <span class="label label-success label-sm arrowed-in arrowed-in-right">En ligne</span>
                                            </div>

                                            <div ng-if="user.status == 'OFF'">
                                                <span class="label label-danger label-sm arrowed-in arrowed-in-right">Deconnect&eacute;</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-4"></div>

                                <div class="center">
                                    <i class="ace-icon fa fa-users fa-2x green middle"></i>

                                    &nbsp;
                                    <a href="#/membres" class="btn btn-sm btn-white btn-info">
                                        Voir tous les thiantacones &nbsp;
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </div>



                                <!-- /section:pages/dashboard.members -->
                            </div><!-- /.#member-tab -->

                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div>
            </div>
         </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->

