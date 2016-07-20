<form  class="form-horizontal" role="form" name="formAjoutSass" style="margin-top : 10px; margin-bottom :20px;" ng-submit="ajoutModTabi()">
    <!-- #section:elements.form.input-state -->

    <div class="modal-body">
        <div class="form-group" >
            <label class="col-sm-3 control-label no-padding-right" for="profil">Membre </label>
            <div class="col-sm-9" >
                <select class="form-control" ng-disabled="tabi.id_tabi != null" id="form-field-select-3" ng-change="chooseMembre()"  ng-model="tabi.membre"  ng-options="user.id_user as (user.nom_user+' '+user.prenom) for user in users" required >
                </select></div>

        </div>
        <div class="form-group">
            <br/>
            <label class="col-sm-3 control-label no-padding-right" for="id_sass">№ Sass</label>

            <div class="col-sm-9">
                <select class="form-control"  name="id_sass" id="id_sass"  
                        ng-options="sass.id_sass as sass.code for sass in sassChosen" ng-disabled="tabi.id_tabi != null"  ng-change="getSolde()"  ng-model="tabi.id_sass">

                </select> 
            </div>
        </div>


        <div class="form-group" id="groupeMontant">
            <label class="col-sm-3 control-label no-padding-right" for="tabi">Tabi</label>

            <div class="col-sm-9">
                <input  type="text" ng-model="tabi.tabi" placeholder="Tabi" class="form-control" name="tabi" id="Tabi" required> <br>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="inputOperaton">Mode</label>

            <div class="col-sm-9">
                <select name="operation" id="operation" class="form-control"   ng-model="tabi.mode" required>
                    <option value=""></option>
                    <option value="Especes">Esp&egrave;ces</option>
                    <option value="Cheque">Ch&egrave;que</option>
                    <option value="Orange Money">Orange Money</option>
                    <option value="Virement">Virement</option>
                    <option value="Wari">Wari</option>
                    <option value="Joni Joni">Joni Joni</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="inputDate">Date</label>

            <div class="col-sm-9">
                <input ng-model="tabi.date_tabi" type="text" id="date_tabi" class="form-control input-mask-date" placeholder="Date" required>
            </div>
        </div>

        <div class="form-group" ng-if="tabi.id_sass !=null && tabi.solde > 0 ">
            <label class="col-sm-3 control-label no-padding-right" for="Solde">Restant à verser</label>

            <div class="col-sm-9">
                <input  type="text" ng-model="tabi.solde"  class="form-control" ng-disabled="true">
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-xs btn-primary" 
                type="submit">
            <i class="ace-icon fa fa-check green"></i>Valider
        </button>
        <button class="btn btn-xs" type="reset" 
                ng-click="annulerTabi()">
            <i class="ace-icon fa fa-times red2"></i>Annuler
        </button>
    </div>
</form>
<script type="text/javascript">
    jQuery(function ($) {
        $('.input-mask-date').mask('99/99/9999');
    });
</script>