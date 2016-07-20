<div class="page-content" >
    <div class="page-header">
        <h1>
            Accueil <small> <i class="ace-icon fa fa-angle-double-right"></i>
                Mot de passe
            </small>
        </h1>
    </div>

    <div class="row" ng-controller="MotdepasseCtrl">
        <div class="col-xs-12">
	 <div class="alert alert-block alert-danger" ng-show="error != null && error != ''">{{error}}</div>
<form class="form-horizontal">
												
												
					<uib-tabset>
												<uib-tab heading="Mot de passe"  active="tab.active">
												<div class="space-10"></div>

															<div class="form-group">
																<label for="form-field-pass1" class="col-sm-3 control-label no-padding-right">Nouveau mot de passe </label>

																<div class="col-sm-9">
																	<input type="password"  ng-model="motdepasse.newPassword" id="form-field-pass1">
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label for="form-field-pass2"" class="col-sm-3 control-label no-padding-right">Confirmer mot de passe</label>

																<div class="col-sm-9">
																	<input type="password"  ng-model="motdepasse.confirmPassword" id="form-field-pass2">
																</div>
															</div>
														</div>
</uib-tab>
							</uib-tabset>
												<div class="clearfix form-actions">
													<div class="col-md-offset-3 col-md-9">
														<button type="button" class="btn btn-info" ng-click="validerNewPassword()">
															<i class="ace-icon fa fa-check bigger-110"></i>
															Valider
														</button>

														&nbsp; &nbsp;
														<button type="reset" class="btn" ng-click="annulerNewPassword()">
															<i class="ace-icon fa fa-undo bigger-110"></i>
															Annuler
														</button>
													</div>
												</div>
											</form>
											</div>
											</div>
											</div>