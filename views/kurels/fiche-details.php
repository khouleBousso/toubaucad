<div class="row"> 
    <div class="col-md-12">
        <div class="profile-user-info profile-user-info-striped">
              <div class="profile-info-row">
                <div class="profile-info-name"> Nom </div>

                <div class="profile-info-value">
                        <span> {{nomKurel}} </span>
                        
                   
                </div>
            </div><br/>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Membres </div>

                <div class="profile-info-value">
                    <div  ng-repeat="kurel in kurels">
                        <a href="#/profil/{{kurel.id_user}}"> <span ng-if="kurel.profile_id==3">Dieuwrigne </span> <span> {{kurel.prenom}}  {{kurel.nom_user}} </span></a><br/><br/>
                        
                    </div>
                   
                </div>
            </div>


        </div>
    </div>
</div>