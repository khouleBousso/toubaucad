var appAdmin = angular.module('appAdmin', ['user', 'ui.router', 'ngCookies', 'ngResource', 'datatables', 'angular-growl']);
appAdmin.run(
        function (DTDefaultOptions) {
            var oPaginate = {};
            oPaginate["sFirst"] = "|<";
            oPaginate["sPrevious"] = "<";
            oPaginate["sNext"] = ">";
            oPaginate["sLast"] = ">|";
            var oLanguage = {};
            oLanguage["oPaginate"] = oPaginate;
            oLanguage["sLengthMenu"] = "Afficher _MENU_ &eacute;l&eacute;ments";
            oLanguage["sInfo"] = "_START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments";
            oLanguage["sSearch"] = "Recherche";
            oLanguage["sProcessing"] = "Traitement en cours...";
            oLanguage["sZeroRecords"] = "Aucun &eacute;l&eacute;ment &agrave; afficher";
            oLanguage["sEmptyTable"] = "Aucune donn&eacute;e disponible dans le tableau";
            oLanguage["sInfoEmpty"] = "0 &eacute;l&eacute;ment &agrave; afficher";
            oLanguage["sInfoFiltered"] = "";
            oLanguage["sInfoPostFix"] = "";
            DTDefaultOptions.setLanguage(oLanguage);
        }).run(
        ['$rootScope', '$state', '$stateParams',
            function ($rootScope, $state, $stateParams) {
                $rootScope.$state = $state;
                $rootScope.$stateParams = $stateParams;
            }
        ]).run(['$rootScope', '$state', 'Auth', 'growl', function ($rootScope, $state, Auth, growl) {

        $rootScope.$on("$stateChangeStart", function (event, toState, toParams, fromState, fromParams) {
            if (gOptions.auth_check != undefined && !gOptions.auth_check) {
                $rootScope.isPageLogin = false;
            }
            else {
                if (toState.name != 'login') {
                    $rootScope.isPageLogin = false;

                    if (Auth.isLoggedIn()) {
                        if (toState.data != undefined && toState.data != null) {
                            if (!Auth.authorize(toState.data.access)) {

                                growl.warning("Vous n'avez pas le droit d'acc\351der \340 la page demand\351e", {ttl: 3000});
                                if (Auth.user.code_profil == 'cheikh' || Auth.user.code_profil == 'universel') {
                                    $rootScope.isPageLogin = false;
                                    event.preventDefault();
                                    $state.go('accueil');
                                }
                                else if (Auth.user.code_profil == 'dieuwrigne_daara') {
                                    $rootScope.isPageLogin = false;
                                    event.preventDefault();
                                    $state.go('kurel', {id: Auth.user.id_kurel});
                                }
                                else if (Auth.user.code_profil == 'thiantacone' || Auth.user.code_profil == 'top_dieuwrigne' ) {
                                    $rootScope.isPageLogin = false;
                                    event.preventDefault();
                                    $state.go('kurel', {id: Auth.user.id_kurel_member});
                                }
                                else
                                {
                                    $rootScope.isPageLogin = true;
                                    event.preventDefault();
                                    $state.go('login');
                                }
                            }
                            else{
                                var idkurel = -1;
                                 if (Auth.user.id_kurel == null)
                                     idkurel = Auth.user.id_kurel_member;
                                 else idkurel = Auth.user.id_kurel;

                                if(toState.name === 'kurel' && Auth.user.code_profil !='universel' && Auth.user.code_profil != 'cheikh'){
                                   if(idkurel != toParams.id){
                                       growl.warning("Vous n'avez pas le droit d'acc\351der \340 la page demand\351e", {ttl: 3000});
                                       event.preventDefault();
                                       $state.go('kurel', {id: idkurel});
                                   }

                                }
                            }
                        }

                    }
                    else {
                        $rootScope.error = "Veuillez d'abord vous authentifier";
                        $rootScope.isPageLogin = true;
                        event.preventDefault();
                        $state.go('login');
                    }
                }
                else {
                    $rootScope.isPageLogin = true;
                }
            }
        });

    }]);
appAdmin
        .config(
                ['$stateProvider', '$urlRouterProvider', '$httpProvider',
                    function ($stateProvider, $urlRouterProvider, $httpProvider) {

                        $urlRouterProvider.otherwise('/accueil');
                        var access = routingConfig.accessLevels;
                        $stateProvider.
                                state('/', {url: "/accueil", templateUrl: gOptions.appname + 'views/accueil.php', data: {access: access.universel}}).
                                state('accueil', {url: "/accueil", templateUrl: gOptions.appname + 'views/accueil.php', data: {access: access.universel}}).
                                state('kurels', {url: "/kurels", templateUrl: gOptions.appname + 'views/kurels/kurels.php', data: {access: access.universel}}).
                                state('kurel', {url: "/kurel/:id", templateUrl: gOptions.appname + 'views/kurels/fiche-kurel.php', data: {access: access.universel}}).
                                state('ndigueuls', {url: "/ndigueuls", templateUrl: gOptions.appname + 'views/ndigueuls/ndigueuls.php', data: {access: access.top_dieuwrigne}}).
                                state('ndigueuls-archive', {url: "/ndigueuls-archive", templateUrl: gOptions.appname + 'views/ndigueuls/ndigueuls-archive.php', data: {access: access.top_dieuwrigne}}).
                                state('membres', {url: "/membres", templateUrl: gOptions.appname + 'views/membres/membres.php', data: {access: access.universel}}).
                                state('profil', {url: "/profil/:id", templateUrl: gOptions.appname + 'views/membres/profil.php', data: {access: access.thiantacone}}).
                                state('login', {url: "/login", templateUrl: gOptions.appname + 'views/login.php', data: {access: access.public}}).
                                state('motdepasse', {url: "/motdepasse/:id", templateUrl: gOptions.appname + 'views/motdepasse.php', data: {access: access.thiantacone}});


                    }]);

appAdmin.config(['growlProvider', function (growlProvider) {
        growlProvider.globalTimeToLive(5000);
    }]);


appAdmin.factory('getNdigueulsEnCours', function ($http) {
    return {
        getNdigueuls: function () {
            return $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getNdigueuls');
        },
        getPercents: function () {
            return $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getPercents');
        }
    }
});

appAdmin.factory('getUserInscritsKurel', function ($http) {
    return {
        getUserInscrits: function (idKurel) {
            return $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getUserInscritsKurel/' + idKurel);
        }
    }
});

appAdmin.controller('profilsDieuwrignesCtrl', [
    '$scope',
    '$http',
    function ($scope, $http)
    {
        $http.get(gOptions.serveur + '/rest/LoginManager.php/getProfilsDieuwrignes').success(
                function (data) {
                    $scope.profils = data.data;
                });
    }]);
appAdmin.controller('dieuwrignekurelCtrl', [
    '$scope',
    '$http',
    function ($scope, $http)
    {
        $http.get(gOptions.serveur + '/rest/LoginManager.php/getDieuwrignekurelsAdd').success(
                function (data) {
                    $scope.dieuwrignekurelsAdd = data.data;
                });
                
                 $http.get(gOptions.serveur + '/rest/LoginManager.php/getDieuwrignekurelsMod').success(
                function (data) {
                    $scope.dieuwrignekurelsMod = data.data;
                });
    }]);

appAdmin.controller('alluserCtrl', [
    '$scope',
    '$http',
    function ($scope, $http)
    {
        $http.get(gOptions.serveur + '/rest/LoginManager.php/getUsers').success(
                function (data) {
                    $scope.users = data.data;
                });
    }]);



appAdmin.controller('SassCtrl', SassCtrl, ['$scope', '$http']);
function SassCtrl($resource, $http, $scope, $location, getNdigueulsEnCours, $stateParams, Auth)
{
    $scope.user = Auth.user;
    $scope.ndigueulsEnCours = [];
    $scope.sasses = [];
    $scope.users = [];
    $scope.sass = {};
    $scope.ndigueulIdChosen = 0;
    var promise = getNdigueulsEnCours.getNdigueuls();
    promise.then(
            function (payload) {

                $scope.ndigueulsEnCours = payload.data.data;
                $scope.ndigueulIdChosen = $scope.ndigueulsEnCours[0].id;
                if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1 && $scope.ndigueulsEnCours.length != 0)
                {

                    $http.get(gOptions.serveur + '/rest/NdigueulManager.php/ListSass?kurel=' + $stateParams.id + '&ndigueul=' + $scope.ndigueulIdChosen).
                            success(
                                    function (data)
                                    {
                                        $scope.sasses = data.data;
                                        $scope.totalsass = 0;
                                        $scope.totalsolde = 0;
                                        for (var i = 0; i < data.data.length; i++)
                                        {
                                            $scope.totalsass = parseInt($scope.totalsass) + parseInt(data.data[i].montant);
                                            $scope.totalsolde = parseInt($scope.totalsolde) + parseInt(data.data[i].solde);
                                        }
                                    }
                            ).
                            error(function (result)
                            {
                            });

                    $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getUserInscritsKurel/' + $stateParams.id).
                            success(
                                    function (data)
                                    {

                                        $scope.users = data.data;

                                    }
                            ).
                            error(function (result)
                            {
                                console.log("error");
                            });

                }
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });

    $scope.showAjoutSass = false;

    $scope.popupAjoutSass = function () {
        $scope.showAjoutSass = !$scope.showAjoutSass;

    }
    $scope.showSituationPopupSass = false;
    $scope.openPopupPdf = function () {

        $scope.showSituationPopupSass = !$scope.showSituationPopupSass;
    }


    $scope.annulerSituationSass = function(){
         $scope.showSituationPopupSass = !$scope.showSituationPopupSass;
    }
    
    $scope.refreshSass = function () {
        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/ListSass?kurel=' + $stateParams.id + '&ndigueul=' + $scope.ndigueulIdChosen).
                success(
                        function (data)
                        {

                            $scope.sasses = data.data;
                            $scope.totalsass = 0;
                            $scope.totalsolde = 0;
                            for (var i = 0; i < data.data.length; i++)
                            {
                                $scope.totalsass = parseInt($scope.totalsass) + parseInt(data.data[i].montant);
                                $scope.totalsolde = parseInt($scope.totalsolde) + parseInt(data.data[i].solde);
                            }
                        }
                ).
                error(function (result)
                {
                });
    }


    $scope.ajoutModSass = function () {

        if ($scope.sass.id_sass == null && $stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1 && $scope.ndigueulsEnCours.length != 0)
        {
            $scope.sass.id_kurel = $stateParams.id;
            $scope.sass.id_ndigueul = $scope.ndigueulIdChosen;
            $http.post(gOptions.serveur + '/rest/NdigueulManager.php/AddSass', $scope.sass).
                    success(
                            function (data)
                            {
                                $scope.showAjoutSass = !$scope.showAjoutSass;
                                $http.get(gOptions.serveur + '/rest/NdigueulManager.php/ListSass?kurel=' + $stateParams.id + '&ndigueul=' + $scope.ndigueulIdChosen).
                                        success(
                                                function (data)
                                                {
                                                    $scope.sasses = data.data;
                                                    $scope.sass = {};
                                                    $scope.totalsass = 0;
                                                    $scope.totalsolde = 0;
                                                    for (var i = 0; i < data.data.length; i++)
                                                    {
                                                        $scope.totalsass = parseInt($scope.totalsass) + parseInt(data.data[i].montant);
                                                        $scope.totalsolde = parseInt($scope.totalsolde) + parseInt(data.data[i].solde);
                                                    }
                                                }
                                        ).
                                        error(function (result)
                                        {
                                        });

                            }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
        else if ($scope.sass.id_sass != null && $stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1 && $scope.ndigueulsEnCours.length != 0)
        {
            $http.post(gOptions.serveur + '/rest/NdigueulManager.php/UpdateSass/', $scope.sass).
                    success(
                            function (data)
                            {
                                $scope.showModSass = !$scope.showModSass;
                                $http.get(gOptions.serveur + '/rest/NdigueulManager.php/ListSass?kurel=' + $stateParams.id + '&ndigueul=' + $scope.ndigueulIdChosen).
                                        success(
                                                function (data)
                                                {
                                                    $scope.sass = {};
                                                    $scope.sasses = data.data;
                                                    $scope.totalsass = 0;
                                                    $scope.totalsolde = 0;
                                                    for (var i = 0; i < data.data.length; i++)
                                                    {
                                                        $scope.totalsass = parseInt($scope.totalsass) + parseInt(data.data[i].montant);
                                                        $scope.totalsolde = parseInt($scope.totalsolde) + parseInt(data.data[i].solde);
                                                    }
                                                }
                                        ).
                                        error(function (result)
                                        {
                                        });
                            }).
                    error(function (result)
                    {
                    });
        }
    }

    $scope.ouvrirTab = function (idNdigueul)
    {
        $scope.ndigueulIdChosen = idNdigueul;
        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/ListSass?kurel=' + $stateParams.id + '&ndigueul=' + $scope.ndigueulIdChosen).
                success(
                        function (data)
                        {

                            $scope.sasses = data.data;
                            $scope.totalsass = 0;
                            $scope.totalsolde = 0;
                            for (var i = 0; i < data.data.length; i++)
                            {
                                $scope.totalsass = parseInt($scope.totalsass) + parseInt(data.data[i].montant);
                                $scope.totalsolde = parseInt($scope.totalsolde) + parseInt(data.data[i].solde);
                            }
                        }
                ).
                error(function (result)
                {
                });
    }


    $scope.showModSass = false;
    $scope.popupModifierSass = function (sassId) {
        $scope.idSassAModifier = sassId;
        $scope.showModSass = !$scope.showModSass;
        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getSassById/' + sassId).
                success(
                        function (data)
                        {

                            $scope.sass = data.data[0];
                        }
                ).
                error(function (result)
                {
                });
    }


    $scope.annulerSass = function ()
    {
        if ($scope.sass.id_sass == null)
            $scope.showAjoutSass = !$scope.showAjoutSass;

        if ($scope.sass.id_sass != null)
            $scope.showModSass = !$scope.showModSass;

        $scope.sass = {};
    }

    $scope.dismiss = function () {
        $scope.sass = {};
    }
    
    $scope.editSass = function(){
          window.open(gOptions.serveur + '/pdf/sass.php?kurel=' + $stateParams.id+':'+ $scope.$parent.kurel.nom + '&ndigueul=' +  $scope.ndigueulIdChosen+':'+ $scope.sasses[0].nom_ndigueul , '_blank');

      
    }
}


appAdmin.controller('TabisCtrl', TabisCtrl, ['$scope', '$http']);
function TabisCtrl($resource, $http, $scope, $location, getNdigueulsEnCours, $stateParams, Auth)
{
    $scope.user = Auth.user;
    $scope.ndigueulsEnCours = [];
    $scope.tabis = [];
    $scope.users = [];
    $scope.tabi = {};
    $scope.ndigueulIdChosen = 0;
    var promise = getNdigueulsEnCours.getNdigueuls();
    promise.then(
            function (payload) {

                $scope.ndigueulsEnCours = payload.data.data;
                $scope.ndigueulIdChosen = $scope.ndigueulsEnCours[0].id;
                $http.get(gOptions.serveur + '/rest/NdigueulManager.php/ListTabis?kurel=' + $stateParams.id + '&ndigueul=' + $scope.ndigueulIdChosen).
                        success(
                                function (data)
                                {
                                    $scope.tabis = data.data;
                                    $scope.totaltabis = 0;
                                    for (var i = 0; i < data.data.length; i++)
                                    {
                                        $scope.totaltabis = parseInt($scope.totaltabis) + parseInt(data.data[i].tabi);
                                    }
                                }
                        ).
                        error(function (result)
                        {
                        });


                $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getUserInscritsKurel/' + $stateParams.id).
                        success(
                                function (data)
                                {

                                    $scope.users = data.data;
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });


    $scope.getSolde = function () {
        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/GetSoldeSass/' + $scope.tabi.id_sass).
                success(
                        function (data)
                        {

                            $scope.tabi.solde = parseInt(data.data[0].solde) * -1;
                        }
                ).
                error(function (result)
                {
                });
    }

    $scope.showAjoutTabi = false;
    $scope.popupAjoutTabi = function () {
        $scope.showAjoutTabi = !$scope.showAjoutTabi;
    }


    $scope.ajoutModTabi = function () {

        if ($scope.tabi.id_tabi == null && $stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1 && $scope.ndigueulsEnCours.length != 0)
        {
            $http.post(gOptions.serveur + '/rest/NdigueulManager.php/AddTabi', $scope.tabi).
                    success(
                            function (data)
                            {
                                $scope.showAjoutTabi = !$scope.showAjoutTabi;
                                $http.get(gOptions.serveur + '/rest/NdigueulManager.php/ListTabis?kurel=' + $stateParams.id + '&ndigueul=' + $scope.ndigueulIdChosen).
                                        success(
                                                function (data)
                                                {
                                                    $scope.tabi = {};
                                                    $scope.sassChosen = [];
                                                    $scope.tabis = data.data;
                                                    $scope.totaltabis = 0;
                                                    for (var i = 0; i < data.data.length; i++)
                                                    {
                                                        $scope.totaltabis = parseInt($scope.totaltabis) + parseInt(data.data[i].tabi);
                                                    }
                                                }
                                        ).
                                        error(function (result)
                                        {
                                        });
                            }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
        else if ($scope.tabi.id_tabi != null && $stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1 && $scope.ndigueulsEnCours.length != 0)
        {
            $http.post(gOptions.serveur + '/rest/NdigueulManager.php/UpdateTabi/', $scope.sass).
                    success(
                            function (data)
                            {
                                $scope.showModTabi = !$scope.showModTabi;
                                $http.get(gOptions.serveur + '/rest/NdigueulManager.php/ListTabis?kurel=' + $stateParams.id + '&ndigueul=' + $scope.ndigueulIdChosen).
                                        success(
                                                function (data)
                                                {
                                                    $scope.tabi = {};
                                                    $scope.sassChosen = [];
                                                    $scope.tabis = data.data;
                                                    $scope.totaltabis = 0;
                                                    for (var i = 0; i < data.data.length; i++)
                                                    {
                                                        $scope.totaltabis = parseInt($scope.totaltabis) + parseInt(data.data[i].tabi);
                                                    }
                                                }
                                        ).
                                        error(function (result)
                                        {
                                        });
                            }).
                    error(function (result)
                    {
                    });
        }
    }


    $scope.ouvrirTab = function (idNdigueul)
    {
        $scope.ndigueulIdChosen = idNdigueul;
        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/ListTabis?kurel=' + $stateParams.id + '&ndigueul=' + $scope.ndigueulIdChosen).
                success(
                        function (data)
                        {

                            $scope.tabis = data.data;
                            $scope.totaltabis = 0;
                            for (var i = 0; i < data.data.length; i++)
                            {
                                $scope.totaltabis = parseInt($scope.totaltabis) + parseInt(data.data[i].tabi);
                            }
                        }
                ).
                error(function (result)
                {
                });
    }

    $scope.chooseMembre = function ()
    {

        if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
        {
            $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getSassByMembre?membre=' + $scope.tabi.membre + '&kurel=' + $stateParams.id + '&ndigueul=' + $scope.ndigueulIdChosen).
                    success(
                            function (data)
                            {

                                $scope.sassChosen = data.data;
                            }
                    ).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
    }

    $scope.annulerTabi = function ()
    {
        if ($scope.tabi.id_tabi == null)
            $scope.showAjoutTabi = !$scope.showAjoutTabi;
        if ($scope.tabi.id_tabi != null)
            $scope.showModTabi = !$scope.showModTabi;
        $scope.tabi = {};
        $scope.sassChosen = [];
    }

    $scope.dismiss = function () {
        $scope.tabi = {};
        $scope.sassChosen = [];
    }
}



appAdmin.controller('StatCtrl', StatCtrl, ['$scope', 'growl']);
function StatCtrl($resource, $http, $scope, $location, growl, getNdigueulsEnCours)
{

    $scope.totalthiantacones = 0;
    $scope.nbrfemmes = 0;
    $scope.nbrhommes = 0;
    var promise = getNdigueulsEnCours.getPercents();
    promise.then(
        function (payload) {

            $scope.ndigueulsEnCours = payload.data.data;
            $http.get(gOptions.serveur + '/rest/LoginManager.php/getUsers').
            success(
                function (data)
                {

                    $scope.users = data.data;
                }
            ).
            error(function (result)
            {
                console.log("error");
            });
            $http.get(gOptions.serveur + '/rest/StatManager.php/StatAll').
            success(
                function (data)
                {

                    $scope.nbrhommes = data.data[0].nbrhommes;
                    $scope.nbrfemmes= data.data[0].nbrfemmes;
                    $scope.nbrEtudiants= data.data[0].nbrEtudiants;
                    $scope.totalthiantacones = data.data[0].totalthiantacones;
                }
            ).
            error(function (result)
            {
                console.log("error");
            });


            // retourne le nbre total de l'annee en cours par cycle
            $http.get(gOptions.serveur + '/rest/StatManager.php/GetPercentByCategorie/').
            success(
                function (data)
                {

                    $scope.cycles = data.data;
                    $.resize.throttleWindow = false;


                    var placeholder = $('#piechart-placeholder').css({'width': '90%', 'min-height': '150px'});


                    function drawPieChart(placeholder, data, position) {
                        $.plot(placeholder, data, {
                            series: {
                                pie: {
                                    show: true,
                                    tilt: 0.8,
                                    highlight: {
                                        opacity: 0.25
                                    },
                                    stroke: {
                                        color: '#fff',
                                        width: 2
                                    },
                                    startAngle: 2
                                }
                            },
                            legend: {
                                show: true,
                                position: position || "ne",
                                labelBoxBorderColor: null,
                                margin: [-30, 15]
                            }
                            ,
                            grid: {
                                hoverable: true,
                                clickable: true
                            }
                        })
                    }
                    drawPieChart(placeholder, $scope.cycles);

                    /**
                     we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
                     so that's not needed actually.
                     */
                    placeholder.data('chart', $scope.cycles);
                    placeholder.data('draw', drawPieChart);


                    //pie chart tooltip example
                    var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
                    var previousPoint = null;

                    placeholder.on('plothover', function (event, pos, item) {
                        if (item) {
                            if (previousPoint != item.seriesIndex) {
                                previousPoint = item.seriesIndex;
                                var tip = item.series['label'] + " : " + Math.round(item.series['percent']) + '%';
                                $tooltip.show().children(0).text(tip);
                            }
                            $tooltip.css({top: pos.pageY + 10, left: pos.pageX + 10});
                        } else {
                            $tooltip.hide();
                            previousPoint = null;
                        }
                    });


                }
            ).
            error(function (result)
            {
                console.log("error");
            });
        });






}

appAdmin.controller('viewKurelCtrl', viewKurelCtrl, ['$scope']);
function viewKurelCtrl($resource, $http, $scope, $location, $stateParams, Auth)
{
    $scope.user = Auth.user;
    $scope.kurel = {};
    $scope.tab = typeof $stateParams.active != 'undefined' ? $stateParams.active : 'membres';
    if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
    {
        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getKurelById/' + $stateParams.id).
                success(
                        function (data)
                        {

                            $scope.kurel = data.data[0];
                        }
                ).
                error(function (result)
                {
                });
    }
}


appAdmin.controller('MembresKurelCtrl', MembresKurelCtrl, ['$scope']);
function MembresKurelCtrl($resource, $http, $scope, $location, $stateParams, fileUpload, growl, getUserInscritsKurel, Auth)
{
    $scope.membreskurels = [];
    $scope.userConnect = Auth.user;
    if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
    {
        var promise = getUserInscritsKurel.getUserInscrits($stateParams.id);
        promise.then(
                function (payload) {

                    $scope.membreskurels = payload.data.data;
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }

    $scope.user = {};
    $scope.upload = {};
    $scope.upload.avatar = "";
    $scope.validateAvatar = false;
    $scope.launch = function () {
        $("#icone").trigger('click');
        $("#icone").change(function () {
            if ($scope.upload.avatar.size > 1500000)
            {
                $("#groupeAvatar").removeClass("has-success");
                $("#groupeAvatar").addClass("has-error");
                growl.error('La taille de la photo ne doit pas excéder 150Mo');
                $scope.validateAvatar = false;
            }
            else
            {
                if ($scope.upload.avatar.type != "image/jpeg" && $scope.upload.avatar.type != "image/jpg" && $scope.upload.avatar.type != "image/png")
                {
                    $("#groupeAvatar").removeClass("has-success");
                    $("#groupeAvatar").addClass("has-error");
                    growl.error('La photo doit être au format jpeg/jpg/png');
                    $scope.validateAvatar = false;
                }
                else {
                    $("#groupeAvatar").removeClass("has-error");
                    $("#groupeAvatar").addClass("has-success");
                    $scope.validateAvatar = true;
                }
            }
        });
    }



    $scope.ajoutModUser = function () {

        if ($scope.user.id == null)
        {
            if ($scope.validateAvatar == true)
            {

                $scope.nameTemp = $scope.user.telephone;
                $scope.formatAvatar = $scope.upload.avatar.type.split('/')[1];
                if ($scope.formatAvatar == "jpeg")
                    $scope.formatAvatar = "jpg";
                $scope.user.name = $scope.nameTemp + "." + $scope.formatAvatar;
                //Ajout Eleve
                var uploadUrl = gOptions.serveur + '/rest/InscriptionManager.php/stockAvatar';
                fileUpload.uploadFileToUrl($('#icone')[0].files[0], $scope.user.name, "avatarUsers", uploadUrl);
            }

            $scope.user.id_kurel = $stateParams.id;
            $http.post(gOptions.serveur + '/rest/LoginManager.php/addUserKurel', $scope.user).
                    success(function (data)
                    {
                        $scope.showAjoutUserKurel = !$scope.showAjoutUserKurel;
                        $scope.user = {};
                        $scope.upload = {};
                        $scope.upload.avatar = "";
                        $scope.validateAvatar = false;
                        $("#groupeAvatar").removeClass("has-success").removeClass("has-error");
                        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getUserInscritsKurel/' + $stateParams.id).
                                success(
                                        function (data)
                                        {
                                            growl.success("Utilisateur ajout&eacute; avec succ&egrave;s");
                                            $scope.membreskurels = data.data;
                                        }
                                ).
                                error(function (result)
                                {
                                });
                    }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
        else if ($scope.user.id != null) {
            //Modfier Utilisateur

            if ($scope.validateAvatar == true)
            {

                $scope.nameTemp = $scope.user.telephone;
                $scope.formatAvatar = $scope.upload.avatar.type.split('/')[1];
                if ($scope.formatAvatar == "jpeg")
                    $scope.formatAvatar = "jpg";
                $scope.user.name = $scope.nameTemp + "." + $scope.formatAvatar;
                //Ajout Eleve
                var uploadUrl = gOptions.serveur + '/rest/InscriptionManager.php/stockAvatar';
                fileUpload.uploadFileToUrl($('#icone')[0].files[0], $scope.user.name, "avatarUsers", uploadUrl);
            }
            else
                $scope.user.name = $scope.user.avatar;
            $scope.user.id_profil = 4;
            $http.post(gOptions.serveur + '/rest/LoginManager.php/modUser', $scope.user).
                    success(function (data)
                    {
                        $scope.showModUserKurel = !$scope.showModUserKurel;
                        $scope.user = {};
                        $scope.upload = {};
                        $scope.upload.avatar = "";
                        $scope.validateAvatar = false;
                        $("#groupeAvatar").removeClass("has-success").removeClass("has-error");
                        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getUserInscritsKurel/' + $stateParams.id).
                                success(
                                        function (data)
                                        {
                                            growl.success("Utilisateur modifi&eacute; avec succ&egrave;s");
                                            $scope.membreskurels = data.data;
                                        }
                                ).
                                error(function (result)
                                {
                                });
                    }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
    }


    $scope.showAjoutUserKurel = false;
    $scope.popupAjoutUserKurel = function () {
        $scope.user = {};
        $scope.showAjoutUserKurel = !$scope.showAjoutUserKurel;
    }

    $scope.showModUserKurel = false;
    $scope.popupModUserKurel = function (idUserKurel) {
        $scope.showModUserKurel = !$scope.showModUserKurel;
        $http.get(gOptions.serveur + '/rest/LoginManager.php/getUserById/' + idUserKurel).
                success(
                        function (data)
                        {

                            $scope.user = data.data[0];
                            $scope.upload = {};
                            $scope.upload.avatar = "";
                            $scope.validateAvatar = false;
                        }
                ).
                error(function (result)
                {
                });
    }


    $scope.annulerUser = function ()
    {
        if ($scope.user.id == null)
            $scope.showAjoutUserKurel = !$scope.showAjoutUserKurel;
        if ($scope.user.id != null)
            $scope.showModUserKurel = !$scope.showModUserKurel;
        $scope.user = {};
        $scope.upload = {};
        $scope.upload.avatar = "";
        $scope.validateAvatar = false;
        $("#groupeAvatar").removeClass("has-success").removeClass("has-error");
    }

}


appAdmin.controller('KurelCtrl', KurelCtrl, ['$scope', '$http']);
function KurelCtrl($resource, $http, $scope, $location, growl, $stateParams, $state)
{

    $scope.kurel = {};
    $scope.kurels = [];
    $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getKurels').success(
            function (data) {
                $scope.kurels = data.data;
            });
    $scope.showAjoutKurel = false;
    $scope.popupAjoutKurel = function () {
        $scope.kurel = {};
        $scope.showAjoutKurel = !$scope.showAjoutKurel;
    }

    $scope.showModKurel = false;
    $scope.popupModKurel = function (idKurel) {
        $scope.showModKurel = !$scope.showModKurel;
        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getKurelById/' + idKurel).
                success(
                        function (data)
                        {

                            $scope.kurel = data.data[0];
                        }
                ).
                error(function (result)
                {
                });
    }

    $scope.ajoutModKurel = function () {

        if ($scope.kurel.id == null)
        {
            $http.post(gOptions.serveur + '/rest/NdigueulManager.php/addKurel', $scope.kurel).
                    success(function (data)
                    {
                        $scope.showAjoutKurel = !$scope.showAjoutKurel;
                        $scope.kurel = {};
                        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getKurels').
                                success(
                                        function (data)
                                        {
                                            growl.success("Kurel ajout&eacute; avec succ&egrave;s");
                                            $scope.kurels = data.data;
                                        }
                                ).
                                error(function (result)
                                {
                                });
                    }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
        else if ($scope.kurel.id != null) {
            //Modfier Kurel


            $http.post(gOptions.serveur + '/rest/NdigueulManager.php/modKurel', $scope.kurel).
                    success(function (data)
                    {
                        $scope.showModKurel = !$scope.showModKurel;
                        $scope.kurel = {};
                        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getKurels').
                                success(
                                        function (data)
                                        {
                                            growl.success("Kurel modifi&eacute; avec succ&egrave;s");
                                            $scope.kurels = data.data;
                                        }
                                ).
                                error(function (result)
                                {
                                });
                    }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
    }

    $scope.annulerKurel = function ()
    {
        if ($scope.kurel.id == null)
            $scope.showAjoutKurel = !$scope.showAjoutKurel;
        if ($scope.kurel.id != null)
            $scope.showModKurel = !$scope.showModKurel;
        $scope.kurel = {};
    }

    $scope.dismiss = function () {
        $scope.kurel = {};
    }
}


appAdmin.controller('NdigueulArchCtrl', NdigueulArchCtrl, ['$scope', '$http']);
function NdigueulArchCtrl($resource, $http, $scope, $location, growl, $stateParams, $state,Auth)
{
    $scope.user = Auth.user;
    $scope.ndigueulsArchive = [];
    $scope.ndigueul = {};
    $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getNdigueulsArchive').success(
            function (data) {
                $scope.ndigueulsArchive = data.data;
            });
    $scope.showRestoreNdigueul = false;
    //Manipulation du popup
    $scope.popupRestoreNdigueul = function (objId)
    {
        idRestore = objId;
        //initialisation de l'restore
        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getNdigueulById/' + objId).
                success(function (data)
                {
                    $scope.ndigueul = data.data[0];
                }).
                error(function (result)
                {
                });
        $scope.showRestoreNdigueul = !$scope.showRestoreNdigueul;
    };
    $scope.confirmRestoreNdigueul = function ()
    {
        var motif = restoreNdigueulForm.motifRestore.value;
        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/restoreNdigueul?ndigueul=' + idRestore + "&motifRestoreNdigueul=" + motif).
                success(function (data)
                {
                    $scope.ndigueul = {};
                    $scope.showRestoreNdigueul = !$scope.showRestoreNdigueul;
                    restoreNdigueulForm.motifRestore.value = null;
                    //rechargement de la liste
                    $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getNdigueulsArchive').success(
                            function (data) {
                                $scope.ndigueulsArchive = data.data;
                            });
                    growl.info("Ndigueul restauré avec succès.");
                    return true;
                }).
                error(function (result)
                {
                    growl.error("Une erreur s'est produite lors de la restauration de ce ndigueul.");
                });
    };
    $scope.cancelRestore = function ()
    {
        $scope.ndigueul = {};
        $scope.showRestoreNdigueul = !$scope.showRestoreNdigueul;
        restoreNdigueulForm.motifRestore.value = null;
    };
    $scope.dismiss = function () {
        $scope.ndigueul = {};
        restoreNdigueulForm.motifRestore.value = null;
    }

}

appAdmin.controller('NdigueulCtrl', NdigueulCtrl, ['$scope', '$http']);
function NdigueulCtrl($resource, $http, $scope, $location, growl, $stateParams, $state,Auth)
{
    $scope.user = Auth.user;

    $scope.ndigueul = {};
    $scope.ndigueuls = [];
    $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getNdigueuls').success(
            function (data) {
                $scope.ndigueuls = data.data;
            });
    $scope.showAjoutNdigueul = false;
    $scope.popupAjoutNdigueul = function () {
        $scope.ndigueul = {};
        $scope.showAjoutNdigueul = !$scope.showAjoutNdigueul;
    }

    $scope.showModNdigueul = false;
    $scope.popupModNdigueul = function (idNdigueul) {
        $scope.showModNdigueul = !$scope.showModNdigueul;
        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getNdigueulById/' + idNdigueul).
                success(
                        function (data)
                        {

                            $scope.ndigueul = data.data[0];
                        }
                ).
                error(function (result)
                {
                });
    }


    $scope.showArchNdigueul = false;
    //Manipulation du popup
    $scope.popupArchNdigueul = function (objId)
    {
        idArchive = objId;
        //initialisation de l'archive
        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getNdigueulById/' + objId).
                success(function (data)
                {
                    $scope.ndigueul = data.data[0];
                }).
                error(function (result)
                {
                });
        $scope.showArchNdigueul = !$scope.showArchNdigueul;
    };
    $scope.confirmArchiveNdigueul = function ()
    {
        var motif = archiveNdigueulForm.motifArchive.value;
        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/archiveNdigueul?ndigueul=' + idArchive + "&motifArchNdigueul=" + motif).
                success(function (data)
                {
                    $scope.ndigueul = {};
                    $scope.showArchNdigueul = !$scope.showArchNdigueul;
                    archiveNdigueulForm.motifArchive.value = null;
                    //rechargement de la liste
                    $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getNdigueuls').success(
                            function (data) {
                                $scope.ndigueuls = data.data;
                            });
                    growl.info("Ndigueul archivé avec succès.");
                    return true;
                }).
                error(function (result)
                {
                    growl.error("Une erreur s'est produite lors de l'archivage de ce ndigueul.");
                });
    };
    $scope.cancelArchive = function ()
    {
        $scope.ndigueul = {};
        $scope.showArchNdigueul = !$scope.showArchNdigueul;
        archiveNdigueulForm.motifArchive.value = null;
    };
    $scope.ajoutModNdigueul = function () {

        if ($scope.ndigueul.id == null)
        {
            $http.post(gOptions.serveur + '/rest/NdigueulManager.php/addNdigueul', $scope.ndigueul).
                    success(function (data)
                    {
                        $scope.showAjoutNdigueul = !$scope.showAjoutNdigueul;
                        $scope.ndigueul = {};
                        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getNdigueuls').
                                success(
                                        function (data)
                                        {
                                            growl.success("Ndigueul ajout&eacute; avec succ&egrave;s");
                                            $scope.ndigueuls = data.data;
                                        }
                                ).
                                error(function (result)
                                {
                                });
                    }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
        else if ($scope.ndigueul.id != null) {
            //Modfier Ndigueul


            $http.post(gOptions.serveur + '/rest/NdigueulManager.php/modNdigueul', $scope.ndigueul).
                    success(function (data)
                    {
                        $scope.showModNdigueul = !$scope.showModNdigueul;
                        $scope.ndigueul = {};
                        $http.get(gOptions.serveur + '/rest/NdigueulManager.php/getNdigueuls').
                                success(
                                        function (data)
                                        {
                                            growl.success("Ndigueul modifi&eacute; avec succ&egrave;s");
                                            $scope.ndigueuls = data.data;
                                        }
                                ).
                                error(function (result)
                                {
                                });
                    }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
    }

    $scope.annulerNdigueul = function ()
    {
        if ($scope.ndigueul.id == null)
            $scope.showAjoutNdigueul = !$scope.showAjoutNdigueul;
        if ($scope.ndigueul.id != null)
            $scope.showModNdigueul = !$scope.showModNdigueul;
        $scope.ndigueul = {};
    }

    $scope.dismiss = function () {
        $scope.ndigueul = {};
        archiveNdigueulForm.motifArchive.value = null;
    }
}
//start MotdepasseCtrl

//start MotdepasseCtrl
appAdmin.controller('MotdepasseCtrl', MotdepasseCtrl, ['$scope', 'growl']);
function MotdepasseCtrl($resource, $http, $scope, $location, growl, $stateParams, $state)
{
    $scope.motdepasse = {};
    $scope.error = '';
    $scope.validerNewPassword = function ()
    {
        if ($scope.motdepasse.newPassword !== $scope.motdepasse.confirmPassword)
        {
            $scope.error = "Les deux mots de passe ne sont pas identiques";
        }
        else
        {
            $http.get(gOptions.serveur + '/rest/LoginManager.php/changePasswordUser?password=' + $scope.motdepasse.newPassword + '&id=' + $stateParams.id).
            success(
                function (data)
                {
                    growl.success("Votre mot de passe a &eacute;t&eacute; chang&eacute; avec succ&egrave;s", {ttl: 2000});
                    $state.go('profil', {id: $stateParams.id});
                }
            ).
            error(function (result)
            {
                console.log("error");
            });
        }
    }

    $scope.annulerNewPassword = function ()
    {
        $state.go('profil', {id: $stateParams.id});
    }
}

appAdmin.controller('ProfilCtrl', ProfilCtrl, ['$scope', 'growl']);
function ProfilCtrl($resource, $http, $scope, $location, growl, $stateParams)
{
    if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
    {
        $scope.user = {};
        $http.get(gOptions.serveur + '/rest/LoginManager.php/getUserById/' + $stateParams.id).
                success(
                        function (data)
                        {

                            $scope.user = data.data[0];
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }
}




appAdmin.controller('MainCtrl', MainCtrl, ['$scope', 'growl']);
function MainCtrl($resource, $http, $scope, $location, growl, $stateParams, Auth)
{
    $scope.user = Auth.user;
}



appAdmin.directive('bareNavigation', function () {
    return {
        restrict: 'E',
        templateUrl: 'header.php'
    };
});
appAdmin.directive('footer', function () {
    return {
        restrict: 'E',
        templateUrl: 'footer.php'
    };
});
appAdmin.directive('menu', function () {
    return {
        restrict: 'E',
        templateUrl: 'menu.php'
    };
});
appAdmin.directive('modal', function () {
    return {
        template: '<div class="modal fade" >' +
                '<div class="modal-dialog">' +
                '<div class="modal-content">' +
                '<div class="modal-header lighter block green">' +
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true" ng-click="dismiss()">&times;</button>' +
                '<h4 class="modal-title">{{ title }}</h4>' +
                '</div>' +
                '<div ng-transclude></div>' +
                '</div>' +
                '</div>' +
                '</div>',
        restrict: 'E',
        transclude: true,
        replace: true,
        scope: true,
        link: function postLink(scope, element, attrs) {
            scope.title = attrs.title;
            scope.$watch(attrs.visible, function (value) {
                if (value == true)
                    $(element).modal('show');
                else
                    $(element).modal('hide');
            });
            $(element).on('shown.bs.modal', function () {
                scope.$apply(function () {
                    scope.$parent[attrs.visible] = true;
                });
            });
            $(element).on('hidden.bs.modal', function () {
                scope.$apply(function () {
                    scope.$parent[attrs.visible] = false;
                });
            });
        }
    };
});
appAdmin.directive("fileavatar", [function () {
        return {
            scope: {
                fileavatar: "="
            },
            link: function (scope, element, attributes) {
                element.bind("change", function (changeEvent) {
                    scope.$apply(function () {
                        scope.fileavatar = changeEvent.target.files[0];
                        // or all selected files:
                        // scope.fileread = changeEvent.target.files;
                    });
                });
            }
        }
    }]);
appAdmin.service('fileUpload', ['$http', function ($http) {
        this.uploadFileToUrl = function (file, nom, dossier, uploadUrl) {
            var fd = new FormData();
            fd.append('icone', file);
            fd.append('nom', nom);
            fd.append('dossier', dossier);
            $http.post(uploadUrl, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined}
            })
                    .success(function (data) {
                        return data;
                    })
                    .error(function () {
                    });
        }
    }])
