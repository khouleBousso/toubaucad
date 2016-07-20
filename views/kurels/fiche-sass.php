

<!-- /section:basics/content.breadcrumbs -->
<div class="page-content" ng-controller="SassCtrl">

    <div class="row">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <div id="rootwizard" class="tabbable tabs-left" >
                <ul class="nav nav-tabs nav-stacked">
                    <li  ng-repeat="ndigueul in ndigueulsEnCours" ng-class="{ 'active': $index == 0} " ><a href="#"  data-toggle="tab" aria-expanded="false"   ng-click="ouvrirTab(ndigueul.id)" ><span>{{ndigueul.nom}}: {{ndigueul.date_debut}}</span><span ng-if="ndigueul.date_fin !=null && ndigueul.date_fin !='00/00/0000'"> - {{ndigueul.date_fin}}</span></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane in active" >
                        <!-- 			#section:custom/widget-box -->
                        <div class="clearfix">
                            <div class="pull-right tableTools-container">
                                <div class="btn-group btn-overlap">
                                    <a class="btn btn-white btn-primary  btn-bold" ng-click="editSass()" ng-show="sasses.length !=0" target="_blank">
                                        <span><i class="fa fa-file-pdf-o bigger-110 red"></i></span>
                                        <div data-original-title="Export to PDF" title="" style="position: absolute; left: 0px; top: 0px; width: 39px; height: 35px; z-index: 99;"></div>
                                    </a></div></div>
                        </div>

                        <div class="widget-box ui-sortable-handle">
                            <div class="widget-header"
                                 style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
                                <h5 class="widget-title">Liste des Sass</h5>
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
                                                    <th>№ Sass</th>
                                                    <th>Membre</th>
                                                    <th>Montant Sass</th>
                                                    <th>Date</th>
                                                    <th>Solde</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="sass in sasses" >
                                                    <td title="" style="" role="gridcell">
                                                        <div style="margin-left: 8px;">
                                                            <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                                 onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                                 class="ui-pg-div ui-inline-edit"
                                                                 style="float: left; cursor: pointer;"
                                                                 title="Modifier Sass "
                                                                 
                                                                <a ng-click="popupModifierSass(sass.id_sass)" style="cursor: pointer" ng-if="user.code_profil!='thiantacone'">
                                                                    <span class="ui-icon ui-icon-pencil"></span></a>

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{sass.code}}</td>
                                                    <td>{{sass.membreInf}}</td>
                                                    <td>{{sass.montant}}</td>
                                                    <td>{{sass.date}}</td>
                                                    <td ng-class="{ 'alert-danger': sass.solde <0, 'alert-success': sass.solde >=0 } "><span ng-if=" sass.solde >0">+</span>{{sass.solde | number : fractionSize}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table cellspacing="0" cellpadding="0" border="0"
                                               style="float: left; table-layout: auto;"
                                               class="ui-pg-table navtable">
                                            <tbody>
                                                <tr>
                                                    <td class="ui-pg-button ui-corner-all" title=""
                                                        id="add_grid-table" data-original-title="Add new row"><div
                                                            class="ui-pg-div">
                                                            <a ng-click="popupAjoutSass()" style="cursor: pointer" ng-if="user.code_profil!='thiantacone'">
                                                                <span class="ui-icon ace-icon fa fa-plus-circle purple"></span>Nouveau sass</a>
                                                            <modal title="Ajout Sass" visible="showAjoutSass">
                                                                <div
                                                                    ng-include="gOptions.appname + 'views/sass/ajout-mod-sass.php'"></div> 
                                                            </modal>
                                                        </div>
                                                    </td>
                                                    <td class="ui-pg-button ui-corner-all" title=""
                                                        id="add_grid-table" data-original-title="Add new sass"><div
                                                            class="ui-pg-div">
                                                            <a ng-click="refreshSass()" style="cursor: pointer">
                                                                <span class="ui-icon ace-icon fa fa-refresh green"></span>Actualiser sass</a>

                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                            <br /><br />
                                             <div ng-show="sasses.length != 0" style="text-align:center">
                                            <strong class="alert-success" style="font-size:18px;">Total Sass: &nbsp;&nbsp;{{totalsass| number : fractionSize}} FCFA</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <strong ng-class="{ 'alert-danger': totalsolde <0, 'alert-success': totalsolde >=0 } " style="font-size:18px;">Solde : &nbsp;&nbsp;<span ng-if=" totalsolde >0">+</span>{{totalsolde| number : fractionSize}} FCFA</strong>
                                            
                                        </div>
                                        <modal title="Modifier Sass" visible="showModSass">
                                            <div
                                                ng-include="gOptions.appname +  'views/sass/ajout-mod-sass.php'"></div> 
                                        </modal> 
                                    </div>
                                </div>
                          
                            </div>
                        </div>
                    </div>
                </div>	</div></div>

        <!-- /section:custom/widget-box
        PAGE CONTENT ENDS -->
    </div>
    <!-- 		/.col -->
</div>
<!-- /.row -->

