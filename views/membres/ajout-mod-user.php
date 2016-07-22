<form method="POST"  class="form-horizontal"  enctype="multipart/form-data"  role="form" name="formAjoutUser" style="margin-top : 10px; margin-bottom :20px;" ng-submit="ajoutModUser()">
    <!-- #section:elements.form.input-state -->
<div class="modal-body">
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="sexe">Sexe</label>

        <div class="col-sm-9">
             <select  style="width: 100%;" class="form-control "  ng-model="user.civilite" >
                 <option value="M">Masculin</option>
                 <option value="F">F&eacute;minin</option>
            </select>
            
        </div>
    </div>

    
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="nom">Nom</label>

        <div class="col-sm-9">
            <input  style="width: 100%;" type="text" ng-model="user.nom"  name="nom" placeholder="Nom" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="prenom">Pr&eacute;nom</label>

        <div class="col-sm-9">
            <input  style="width: 100%;" type="text" ng-model="user.prenom"  name="prenom" placeholder="Prenom" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="Email">Email</label>

        <div class="col-sm-9">
            <input style="width: 100%;" type="email" ng-model="user.email"  name="Email" placeholder="Email" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="Telephone">Telephone</label>

        <div class="col-sm-9">   
            <input style="width: 100%;" ng-model="user.telephone" class="input-mask-phone" type="text" placeholder="T&eacute;l&eacute;phone" required>

        </div>
    </div>

     <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="Statut">Statut</label>

        <div class="col-sm-9">
            <select  style="width: 100%;" class="form-control "
                     id="form-field-select-3"  ng-model="user.statut"
                     ng-options="statut.nom as statut.nom for statut in statuts" required >
            </select>
        </div>
        </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="Profession">Profession</label>

        <div class="col-sm-9">
            <input style="width: 100%;"  ng-model="user.profession"  type="text" placeholder="Profession" required>
            </div>
        </div>
    
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="Adresse">Adresse</label>

        <div class="col-sm-9">   
            <textarea  style="width: 100%;" ng-model="user.adresse" type="text" placeholder="Adresse" required>
            </textarea>                      
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="Adresse">Login</label>

        <div class="col-sm-9">
            <textarea  style="width: 100%;" ng-model="user.login" type="text" placeholder="Login" required>
            </textarea>
        </div>
    </div>

    <div class="form-group" id="groupeAvatar">
        <label class="col-sm-3 control-label no-padding-right" for="photo">Photo</label>

        <div class="col-sm-9">
            <input   style="width: 100%;" type="text" ng-model="upload.avatar.name"  name="photo" placeholder="Photo" ng-click="launch()">
        </div>
    </div>  

    <div class="form-group" ng-controller="profilsDieuwrignesCtrl" ng-if="membreskurels ==undefined">
        <label class="col-sm-3 control-label no-padding-right" for="profil">Profil</label>
        <div class="col-sm-9" >
            <select  style="width: 100%;" class="form-control "  id="form-field-select-3"  ng-model="user.id_profil"  ng-options="profil.id as profil.code_profil for profil in profils" required >
            </select></div>

    </div>
 </div>
       <div class="modal-footer">
            <button class="btn btn-xs btn-primary" 
			type="submit">
			<i class="ace-icon fa fa-check green"></i>Valider
		</button>
            <button class="btn btn-xs" type="reset" 
			ng-click="annulerUser()">
			<i class="ace-icon fa fa-times red2"></i>Annuler
		</button>
        </div>
   
    <input type="file" name="icone" fileavatar="upload.avatar"  id="icone" style="display : none">
</form>


<script type="text/javascript">
    jQuery(function ($) {
        $('.input-mask-phone').mask('99 999-99-99');

        // $('#spinner1').ace_spinner({value:0,min:0,max:100,step:5, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
    });
</script>