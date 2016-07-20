<form method="POST"  class="form-horizontal"   role="form" name="formAjoutNdigueul" style="margin-top : 10px; margin-bottom :20px;" ng-submit="ajoutModNdigueul()">
    <!-- #section:elements.form.input-state -->
    <div class="modal-body">
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="nom">Nom</label>

            <div class="col-sm-9">
                <input  style="width: 100%;" type="text" ng-model="ndigueul.nom"  name="nom" placeholder="Nom" required>
            </div>
        </div>


        <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="inputDateDebut">Date de début</label>

        <div  class="col-sm-9">
            <input ng-model="ndigueul.date_debut" type="text" id="inputDateDebut" class="form-control input-mask-date" placeholder="Date de début" required>
        </div>
    </div>
         <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="inputDateFin">Date de fin</label>

        <div class="col-sm-9">
            <input ng-model="ndigueul.date_fin" type="text" id="inputDateFin" class="form-control input-mask-date" placeholder="Date de fin">
        </div>
    </div>
        <div class="form-group" ng-controller="alluserCtrl" >
            <label class="col-sm-3 control-label no-padding-right" for="profil">Collecteur </label>
            <div class="col-sm-9" >
                <select style="width: 100%;" class="form-control "  id="form-field-select-3"  ng-model="ndigueul.collecteur"  ng-options="user.id as (user.nom+' '+user.prenom) for user in users" required >
                </select></div>

        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-xs btn-primary" 
                type="submit">
            <i class="ace-icon fa fa-check green"></i>Valider
        </button>
        <button class="btn btn-xs" type="reset" 
                ng-click="annulerNdigueul()">
            <i class="ace-icon fa fa-times red2"></i>Annuler
        </button>
    </div>

</form>


<script type="text/javascript">
    jQuery(function ($) {
        $('.input-mask-date').mask('99/99/9999');
    });
</script>