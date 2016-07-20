<form method="POST"  class="form-horizontal"   role="form" name="formAjoutKurel" style="margin-top : 10px; margin-bottom :20px;" ng-submit="ajoutModKurel()">
    <!-- #section:elements.form.input-state -->
<div class="modal-body">
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="nom">Nom</label>

        <div class="col-sm-9">
            <input  style="width: 100%;" type="text" ng-model="kurel.nom"  name="nom" placeholder="Nom" required>
        </div>
    </div>

    

    <div class="form-group" ng-controller="dieuwrignekurelCtrl" >
        <label class="col-sm-3 control-label no-padding-right" for="profil">Dieuwrigne kurel </label>
        <div class="col-sm-9"  ng-if="kurel.id ==null">
            <select  ng-disabled="kurel.id !=null" style="width: 100%;" class="form-control "  id="form-field-select-3"  ng-model="kurel.dieuwrigne"  ng-options="dieuwrigne.id as (dieuwrigne.nom+' '+dieuwrigne.prenom) for dieuwrigne in dieuwrignekurelsAdd" required >
            </select></div>
        <div class="col-sm-9"  ng-if="kurel.id !=null">
            <select  ng-disabled="kurel.id !=null" style="width: 100%;" class="form-control "  id="form-field-select-3"  ng-model="kurel.dieuwrigne"  ng-options="dieuwrigne.id as (dieuwrigne.nom+' '+dieuwrigne.prenom) for dieuwrigne in dieuwrignekurelsMod" required >
            </select></div>
    </div>
 </div>
       <div class="modal-footer">
            <button class="btn btn-xs btn-primary" 
			type="submit">
			<i class="ace-icon fa fa-check green"></i>Valider
		</button>
            <button class="btn btn-xs" type="reset" 
			ng-click="annulerKurel()">
			<i class="ace-icon fa fa-times red2"></i>Annuler
		</button>
        </div>
   
</form>
