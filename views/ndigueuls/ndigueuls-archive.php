<div class="breadcrumbs" id="breadcrumbs">

    <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i> <a
                ui-sref="accueil">Accueil</a></li>
    </ul>
    <!-- /.nav-search -->

    <!-- /section:basics/content.searchbox -->
</div><br/>
<div class="page-content">
    <div class="page-header">
        <h1>
            Gestion <small> <i class="ace-icon fa fa-angle-double-right"></i>
                Ndigueuls archiv&eacute;s
            </small>
        </h1>
    </div>
    <div class="row" ng-controller="NdigueulArchCtrl">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <!-- 			#section:custom/widget-box -->
            <div class="widget-box ui-sortable-handle">
                <div class="widget-header"
                     style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
                    <h5 class="widget-title">LISTE DES NDIGUEULS ARCHIVES</h5>
                    <!-- 	/section:custom/widget-box.toolbar sdds -->
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <div id="gbox_grid-table"
                             class="ui-jqgrid ui-widget ui-widget-content ui-corner-all">
                            <table datatable="ng"
                                   class="table table-striped table-bordered table-hover row-border hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nom</th>
                                        <th>Collecteur</th>
                                        <th>Date D&eacute;but</th>
                                        <th>Date Fin</th>
                                        <th>Sass</th>
                                        <th>Tabis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="ndigueul in ndigueulsArchive" >
                                        <td title="" style="" role="gridcell">
                                            <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                 onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                 ng-click="popupRestoreNdigueul(ndigueul.id)"
                                                 class="ui-pg-div ui-inline-edit"
                                                 style="float: left; cursor: pointer;"
                                                 title="Restaurer Ndigueul"  ng-if="user.code_profil=='dieuwrigne'
                                                      || user.code_profil=='universel' || user.code_profil=='cheikh'">
                                                <span class="ui-icon ace-icon fa fa-undo"></span>
                                            </div>
                                        </td>
                                        <td>{{ndigueul.nom}}</td>
                                        <td>Dieuwrigne {{ndigueul.collecteur}}</td>
                                        <td>{{ndigueul.date_debut}}</td>
                                        <td>{{ndigueul.date_fin}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <modal title="Restauration Ndigueul"
                                   visible="showRestoreNdigueul">
                                <div
                                    ng-include="gOptions.appname + 'views/ndigueuls/restore.php'"></div>
                            </modal>
                            <div>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /section:custom/widget-box
            PAGE CONTENT ENDS -->
        </div>
        <!-- 		/.col -->
    </div>

</div>

