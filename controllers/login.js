
angular.module('appAdmin').controller('NavCtrl', ['$rootScope','$timeout', '$scope', '$location', 'Auth', function ($rootScope, $timeout,$scope, $location, Auth) {
        $scope.user = Auth.user;
        $scope.userRoles = Auth.userRoles;
        $scope.accessLevels = Auth.accessLevels;

        $scope.logout = function () {
            Auth.logout(Auth.user,function () {
                if (gOptions.auth_check != undefined && !gOptions.auth_check) {
                }
                else {
                    $location.path('/login');
                    $timeout(function () {
                        location.reload();
                    },200)
                }

            }, function () {
                $rootScope.error = "Failed to logout";
            });
        };
    }]);


angular.module('appAdmin').controller('LoginCtrl',
        ['$rootScope', '$scope', '$location', '$state', '$window','Auth', 'growl', function ($rootScope, $scope, $location, $state, $window, Auth, growl) {
                $rootScope.error = "";
                $scope.login = function (user) {
                    user.code_profil = '';
                    Auth.login(user,
                            function (data) {
                                $scope.user = data.data[0];
                                if ($scope.user == null || $scope.user == '') {
//						growl.warning("This adds a warn message");
//						growl.info("This adds a info message");
//						growl.success("This adds a success message");
//						growl.error("This adds a error message");
                                    $rootScope.error = "Email ou mot de passe incorrect";
                                }
                                else {
                                    $rootScope.error = "";
                                    $scope.user.password = "";
                                    role = data.data[0].code_profil;
                                    if (role == 'cheikh' || role == 'universel') {
                                        $state.go('accueil');
                                    }

                                    if (role == 'dieuwrigne_daara') {
                                        $state.go('kurel', {id: data.data[0].id_kurel});
                                    }

                                    if (role == 'thiantacone' || role == 'top_dieuwrigne') {
                                           $state.go('kurel', {id: data.data[0].id_kurel_member});
                                    }

                                }
								
                            },
                            function (err) {
                                $rootScope.error = "Une erreur est survenue lors du traitement de l'op\351ration.";
                            });
                };

            }]);