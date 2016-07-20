<form  class="form-horizontal" role="form" name="formAjoutSass" style="margin-top : 10px; margin-bottom :20px;" ng-submit="ajoutModSass()">
    <!-- #section:elements.form.input-state -->
   
    <div class="modal-body">
        <div class="form-group" >
            <label class="col-sm-3 control-label no-padding-right" for="profil">Membre </label>
            <div class="col-sm-9" >
                <select class="form-control" ng-disabled="sass.id_sass !=null" id="form-field-select-3"  ng-model="sass.membre"  ng-options="user.id_user as (user.nom_user+' '+user.prenom) for user in users" required >
                </select></div>

        </div>
        
    <div class="form-group" id="groupeMontant">
        <label class="col-sm-3 control-label no-padding-right" for="inputMontant">Montant</label>

        <div class="col-sm-9">
            <input  type="text" ng-model="sass.montant" placeholder="Montant" ng-blur="changeMontant()" class="form-control" name="montant" id="Montant"> <br>
	   </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="inputDate">Date</label>

        <div class="col-sm-9">
            <input ng-model="sass.date" type="text" id="date_naissance" class="form-control input-mask-date" placeholder="Date">
        </div>
    </div>
</div>

    <div class="modal-footer">
        <button class="btn btn-xs btn-primary" 
                type="submit">
            <i class="ace-icon fa fa-check green"></i>Valider
        </button>
        <button class="btn btn-xs" type="reset" 
                ng-click="annulerSass()">
            <i class="ace-icon fa fa-times red2"></i>Annuler
        </button>
    </div>
</form>
<script type="text/javascript">
    jQuery(function ($) {
        $('.input-mask-date').mask('99/99/9999');
    });
</script>