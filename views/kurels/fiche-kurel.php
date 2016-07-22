<script type="text/javascript">
    try {
    ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
</script>
<script type="text/javascript">
    function ouvrirtab(tab1, tab2, tab3) {
    btn1 = document.getElementById(tab1);
            if (btn1 != null)
            btn1.className = "tab-pane fade active in";
            var btn = $("#" + tab2).removeClass("active in");
            var btn = $("#" + tab3).removeClass("active in");
    }
</script>

<div ng-controller="viewKurelCtrl">
<div class="breadcrumbs" id="breadcrumbs"  ng-if="user.id_profil == 2 || user.id_profil == 1">
 
    <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i> <a
                ui-sref="accueil">Accueil</a></li>

        <li>
            <a  ui-sref="kurels">Daaras</a>
        </li>
    </ul>
    <!-- /.breadcrumb -->

    <!-- /.nav-search -->

    <!-- /section:basics/content.searchbox -->
</div>

    <!-- /section:basics/content.breadcrumbs -->
    <div class="page-content">
        <div class="page-header">
            <h1>
                Gestion <small> <i class="ace-icon fa fa-angle-double-right"></i>
                    {{kurel.nom}}
                </small>
            </h1>
        </div>
        <div class="row" >
            <div class="col-xs-12 widget-container-col ui-sortable">
                <div class="tabbable">
                    <ul id="myTab" class="nav nav-tabs">
                        <li ng-class="{ 'active': tab == 'membres'}"><a href=""
                                                                        data-toggle="tab" aria-expanded="true"
                                                                        onclick="ouvrirtab('membres', 'sass', 'tabis')" ><i
                                    class="green ace-icon fa fa-user bigger-120" ></i>  Membres
                            </a></li>   
                        <li ng-class="{ 'active': tab == 'sass'}"><a href=""
                                                                     data-toggle="tab" aria-expanded="true"
                                                                     onclick="ouvrirtab('sass', 'tabis', 'membres')" ><i
                                    class="green ace-icon fa fa-folder-open bigger-120" ></i>  Sass
                            </a></li>

                        <li ng-class="{ 'active': tab == 'tabis'}"><a href=""
                                                                      data-toggle="tab" aria-expanded="true"
                                                                      onclick="ouvrirtab('tabis', 'sass', 'membres')"> <i
                                    class="green ace-icon fa fa-credit-card bigger-120" ></i> Tabis
                            </a></li>


                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in" id="membres"
                             ng-class="{ 'active': tab == 'membres'}">
                            <ng-include src="'views/kurels/fiche-membres.php'"></ng-include>
                        </div>
                        <div class="tab-pane fade in" id="sass"
                             ng-class="{ 'active': tab == 'sass'}">
                            <ng-include src="'views/kurels/fiche-sass.php'"></ng-include>
                        </div>
                        <div class="tab-pane fade in" id="tabis"
                             ng-class="{ 'active': tab == 'tabis'}">
                            <ng-include src="'views/kurels/fiche-tabis.php'"></ng-include>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
