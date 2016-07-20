angular.module('appAdmin')
.directive('accessLevelCheikh', ['Auth', function(Auth) {
    return {
        restrict: 'A',
        link: function($scope, element, attrs) {
            var prevDisp = element.css('display') , userRole  , accessLevelC,accessLevelU,accessLevelD ;

            $scope.user = Auth.user;
            $scope.$watch('user', function(user) {
                
                if(user.code_profil)
                    userRole = user.code_profil;
                updateCSS();
            }, true);
            
            accessLevelC = {bitMask: 2};
            accessLevelU = {bitMask: 4};

            function updateCSS() {

                if(userRole && accessLevelC ) {
                    if(!Auth.authorize(accessLevelC, userRole)){
                        element.css('display', 'none');
                    }
                    else{
                        element.css('display', prevDisp);
                        return;
                    }
                }


                if(userRole && accessLevelU ) {
                    if(!Auth.authorize(accessLevelU, userRole)){
                        element.css('display', 'none');
                    }
                    else{
                        element.css('display', prevDisp);
                        return;
                    }
                }

                if(userRole && accessLevelD ) {
                    if(!Auth.authorize(accessLevelD, userRole)){
                        element.css('display', 'none');
                    }
                    else{
                        element.css('display', prevDisp);
                    }
                }

            }
        }
    };
}]).directive('accessLevelDieuwrigneDaara', ['Auth', function(Auth) {
    return {
        restrict: 'A',
        link: function($scope, element, attrs) {
            var prevDisp = element.css('display') , userRole  , accessLevelDD, accessLevelTD;

            $scope.user = Auth.user;
            $scope.$watch('user', function(user) {
                
                if(user.code_profil)
                    userRole = user.code_profil;
                
                updateCSS();
            }, true);
            
            accessLevelDD = {bitMask: 8};
            accessLevelTD = {bitMask: 16};

            function updateCSS() {   
                if(userRole && accessLevelDD) {
                    if(!Auth.authorize(accessLevelDD, userRole)){
                        element.css('display', 'none');
                    }
                    else{
                        element.css('display', prevDisp);
                        return;
                    }
                }

                if(userRole && accessLevelTD) {
                    if(!Auth.authorize(accessLevelTD, userRole)){
                        element.css('display', 'none');
                    }
                    else{
                        element.css('display', prevDisp);
                    }
                }
            }
        }
    };
}]).directive('accessLevelThiantacone', ['Auth', function(Auth) {
    return {
        restrict: 'A',
        link: function($scope, element, attrs) {
            var prevDisp = element.css('display') , userRole  , accessLevel;

            $scope.user = Auth.user;
            $scope.$watch('user', function(user) {

                if(user.code_profil)
                    userRole = user.code_profil;

                updateCSS();
            }, true);

            accessLevel = {bitMask: 32};

            function updateCSS() {
                if(userRole && accessLevel) {
                    if(!Auth.authorize(accessLevel, userRole)){
                        element.css('display', 'none');
                    }
                    else{
                        element.css('display', prevDisp);
                    }
                }
            }
        }
    };
}]);