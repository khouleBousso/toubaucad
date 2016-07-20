<form  class="form-horizontal" role="form" name="formAjoutSass" style="margin-top : 10px; margin-bottom :20px;" ng-submit="ajoutModSass()">
    <!-- #section:elements.form.input-state -->
   
    <div class="modal-body">
        <div class="form-group" >
            <label class="col-sm-3 control-label no-padding-right" for="profil">Membre </label>
            <div class="col-sm-9" >
                <select class="form-control" ng-disabled="sass.id_sass !=null" id="form-field-select-3"  ng-model="sass.membre"  ng-options="user.id_user as (user.nom_user+' '+user.prenom) for user in users" required >
                </select></div>

        </div>
  
</div>

    <div class="modal-footer">
        <button class="btn btn-xs" type="reset" 
                ng-click="annulerSituationSass()">
            <i class="ace-icon fa fa-times red2"></i>Annuler
        </button>
        
        <button class="btn btn-xs btn-primary" 
                type="submit">
            <i class="ace-icon fa fa-file-pdf-o green"></i>Editer
        </button>
    </div>
</form>