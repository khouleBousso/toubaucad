 <div class="row" ng-controller="MembresKurelCtrl">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <!-- 			#section:custom/widget-box -->
            <div class="widget-box ui-sortable-handle">
                <div class="widget-header"
                     style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
                    <h5 class="widget-title">LISTE DES MEMBRES</h5>
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
                                        <th>Prenom</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="user in membreskurels" >
                                        <td title="" style="" role="gridcell">
                                            <div style="margin-left: 8px;">
                                                <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                     onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                     class="ui-pg-div ui-inline-edit"
                                                     style="float: left; cursor: pointer;"
                                                     title="Fiche utilisateur">
                                                    <a ng-href="#/profil/{{user.id_user}}">
                                                        <span class="ui-icon ace-icon fa fa-search-plus blue"></span></a>
                                                </div>
                                                <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                     onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                     class="ui-pg-div ui-inline-edit"
                                                     style="float: left; cursor: pointer;"
                                                     title="Modifier utilisateur" ng-if="userConnect.code_profil!='thiantacone'">
                                                    <a ng-click="popupModUserKurel(user.id_user)">
                                                        <span class="ui-icon ui-icon-pencil"></span></a>
                                                </div>
                                                <div ng-click="popupNotifUserKurel(user)"
                                                    onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                    onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                    class="ui-pg-div ui-inline-edit"
                                                    style="float: left; cursor: pointer;"
                                                    title="Notifier utilisateur" ng-if="userConnect.code_profil!='thiantacone'">
                                                    <span class="ui-icon ace-icon fa fa-external-link green" ></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{user.nom_user}}</td>
                                        <td>{{user.prenom}}</td>
                                        <td>{{user.email}}</td>
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
                                                <a ng-click="popupAjoutUserKurel()" style="cursor: pointer" ng-if="userConnect.code_profil!='thiantacone'">
                                                    <span class="ui-icon ace-icon fa fa-plus-circle purple"></span>Nouveau membre</a>
                                                   
                                                <modal title="Ajout Membre" visible="showAjoutUserKurel">
                                                    <div
                                                        ng-include="gOptions.appname + 'views/membres/ajout-mod-user.php'"></div> 
                                                </modal>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <modal title="Modifier Membre" visible="showModUserKurel">
                                <div
                                    ng-include="gOptions.appname + 'views/membres/ajout-mod-user.php'"></div> 
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
   