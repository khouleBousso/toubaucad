

<!-- /section:basics/content.breadcrumbs -->
<div class="page-content" ng-controller="TabisCtrl">

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
                                    <a class="btn btn-white btn-primary  btn-bold" target="_blank" >
                                        <span><i class="fa fa-file-pdf-o bigger-110 red"></i></span>
                                        <div data-original-title="Export to PDF" title="" style="position: absolute; left: 0px; top: 0px; width: 39px; height: 35px; z-index: 99;"></div>
                                    </a></div></div>
                        </div>

                        <div class="widget-box ui-sortable-handle">
                            <div class="widget-header"
                                 style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
                                <h5 class="widget-title">Liste des Tabis</h5>
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
                                                    <th>Membre</th>
                                                    <th>Tabi</th>
                                                    <th>Date</th>
                                                    <th>Mode</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="tabi in tabis" >
                                                    <td title="" style="" role="gridcell">
                                                    <td>{{tabi.membreInf}}</td>
                                                    <td>{{tabi.tabi}}</td>
                                                    <td>{{tabi.date_tabi}}</td>
                                                    <td>{{tabi.mode}}</td>
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
                                                            <a ng-click="popupAjoutTabi()" style="cursor: pointer" ng-if="user.code_profil!='thiantacone'">
                                                                <span class="ui-icon ace-icon fa fa-plus-circle purple"></span>Nouveau tabi</a>
                                                            <modal title="Ajout Tabi" visible="showAjoutTabi">
                                                                <div
                                                                    ng-include="gOptions.appname + 'views/tabis/ajout-mod-tabi.php'"></div> 
                                                            </modal>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                            <br /><br />
                                        <div ng-show="tabis.length != 0" style="text-align:center">
                                            <strong class="alert-success" style="font-size:18px;">Total Tabis : &nbsp;&nbsp;&nbsp;{{totaltabis| number : fractionSize}} FCFA</strong>
                                        </div>
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

