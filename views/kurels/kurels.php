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
                Kurels
            </small>
        </h1>
    </div>
      <div class="row" ng-controller="KurelCtrl">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <!-- 			#section:custom/widget-box -->
            <div class="widget-box ui-sortable-handle">
                <div class="widget-header"
                     style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
                    <h5 class="widget-title">LISTE DES KURELS</h5>
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
                                        <th>Dieuwrigne</th>
                                        <th>Nombre de thiantacones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="kurel in kurels" >
                                        <td title="" style="" role="gridcell">
                                            <div style="margin-left: 8px;">
                                                <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                     onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                     class="ui-pg-div ui-inline-edit"
                                                     style="float: left; cursor: pointer;"
                                                     title="Fiche kurel">
                                                    <a ng-href="#/kurel/{{kurel.id}}">
                                                        <span class="ui-icon ace-icon fa fa-search-plus blue"></span></a>
                                                </div>
                                                <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                     onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                     class="ui-pg-div ui-inline-edit"
                                                     style="float: left; cursor: pointer;"
                                                     title="Modifier kurel">
                                                    <a ng-click="popupModKurel(kurel.id)">
                                                        <span class="ui-icon ui-icon-pencil"></span></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{kurel.nom}}</td>
                                        <td>{{kurel.dieuwrigne}}</td>
                                        <td>{{kurel.nbthiantacones}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table cellspacing="0" cellpadding="0" border="0"
                                   style="float: left; table-layout: auto;"
                                   class="ui-pg-table navtable">
                                <tbody>
                                    <tr>
                                        <td class="ui-pg-button ui-corner-all" title=""
                                            id="add_grid-table" ><div
                                                class="ui-pg-div">
                                                <a ng-click="popupAjoutKurel()" style="cursor: pointer">
                                                    <span class="ui-icon ace-icon fa fa-plus-circle purple"></span>Nouveau kurel</a>
                                                   
                                                <modal title="Ajout Kurel" visible="showAjoutKurel">
                                                    <div
                                                        ng-include="gOptions.appname + 'views/kurels/ajout-mod-kurel.php'"></div> 
                                                </modal>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <modal title="Modifier Kurel" visible="showModKurel">
                                <div
                                    ng-include="gOptions.appname + 'views/kurels/ajout-mod-kurel.php'"></div> 
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

