angular.module('appAdmin')
        .factory('Auth', function ($http, $cookieStore) {
            var accessLevels = routingConfig.accessLevels
                    , userRoles = routingConfig.userRoles
                    , currentUser = $cookieStore.get('user') || {id: 0, nom: '', prenom: '', login: '', adresse: '', telephone: '', code_profil: userRoles.public};

            //$cookieStore.remove('user');
            var bitMask = 0;
            function changeUser(user) {
                angular.extend(currentUser, user);
            }

            return {
                authorize: function (accessLevel, role) {
                    if (role === undefined) {
                        role = currentUser.code_profil;
                    }

                    if (role == "thiantacone")
                    {
                        bitMask = userRoles['thiantacone'].bitMask;
                    }

                    if (role == "dieuwrigne_daara")
                        bitMask = userRoles['dieuwrigne_daara'].bitMask;

                    if (role == "top_dieuwrigne")
                        bitMask =  userRoles['top_dieuwrigne'].bitMask;
                    
                    if (role == "dieuwrigne")
                        bitMask = userRoles['dieuwrigne'].bitMask;
                    
                    if (role == "universel")
                        bitMask = userRoles['universel'].bitMask;

                    if (role == "cheikh")
                        bitMask = userRoles['cheikh'].bitMask;

                    if (role == "public")
                        bitMask = userRoles['public'].bitMask;

                    console.log(bitMask);
                    
                    return accessLevel.bitMask & bitMask;
                },
                isLoggedIn: function (user) {
                    if (user === undefined) {
                        user = currentUser;
                    }
                    return user.code_profil === userRoles.cheikh.title || user.code_profil === userRoles.universel.title
                            || user.code_profil === userRoles.dieuwrigne.title || user.code_profil === userRoles.dieuwrigne_daara.title
                        || user.code_profil === userRoles.top_dieuwrigne.title || user.code_profil === userRoles.thiantacone.title;
                    
                },
                login: function (user, success, error) {
                    $http({
                        url: gOptions.serveur + '/rest/LoginManager.php/login',
                        method: 'GET',
                        params: {
                            login: user.login,
                            password: user.password
                        }
                    }).success(function (user) {
                        if(user.data[0] !=null && user.data[0] !=undefined)
                        {    
                         $http.get(gOptions.serveur + '/rest/LoginManager.php/updateUser/' + user.data[0].id).
                                success(
                                        function (data)
                                        {
                                        }
                                ).
                                error(function (result)
                                {
                                });
                        }
                        changeUser(user.data[0]);
                        $cookieStore.put('user', user.data[0]);
                        success(user);
                    }).error(error);

                },
                logout: function (user,success, error) {
                     if(user !=null && user !=undefined)
                        {    
                         $http.get(gOptions.serveur + '/rest/LoginManager.php/updateUserDeconnect/' + user.id).
                                success(
                                        function (data)
                                        {
                                        }
                                ).
                                error(function (result)
                                {
                                });
                        }
                        
                    currentUser = {
                        id: 0,
                        nom: '',
                        prenom: '',
                        email: '',
                        adresse: '',
                        telephone: '',
                        code_profil: userRoles.public
                    };
                    $cookieStore.remove('user');
                    bitMask = 0;
                    success();
                },
                accessLevels: accessLevels,
                userRoles: userRoles,
                user: currentUser,
            };
        });