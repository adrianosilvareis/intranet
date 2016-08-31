angular.module('naoConformidade')
        .config(function ($routeProvider) {

            var link = "/intranet/include/nao-conformidade/partials";

            /**
             * Acesso natural
             */

            //visão geral
            $routeProvider
                    .when("/painel", {
                        templateUrl: link + "/painel.html",
                        controller: 'registros',
                        resolve: {
                            controleAcesso: function (accessControlProvider, $location) {
                                if (!accessControlProvider.verificaAcesso("evento-indesejado")) {
                                    $location.path('/blocked');
                                }
                            }
                        }
                    });

            //visão seguimentada
            $routeProvider
                    .when("/painel/:local", {
                        templateUrl: link + "/painel_master.html",
                        controller: 'masterList',
                        resolve: {
                            controleAcesso: function (accessControlProvider, $location) {
                                if (!accessControlProvider.verificaAcesso("evento-indesejado")) {
                                    $location.path('/blocked');
                                }
                            }
                        }
                    });

            //Novo registro
            $routeProvider
                    .when("/registro", {
                        templateUrl: link + "/registro.html",
                        controller: 'registro',
                        resolve: {
                            controleAcesso: function (accessControlProvider, $location) {
                                if (!accessControlProvider.verificaAcesso("evento-cadastro")) {
                                    $location.path('/blocked');
                                }
                            }
                        }
                    });

            //consulta de registro
            $routeProvider
                    .when("/registro/:regId", {
                        templateUrl: link + "/registro.html",
                        controller: 'registro',
                        resolve: {
                            controleAcesso: function (accessControlProvider, $location) {
                                if (!accessControlProvider.verificaAcesso("evento-view")) {
                                    $location.path('/blocked');
                                }
                            }
                        }
                    });

            //avaliação resposta/consulta
            $routeProvider
                    .when("/avaliacao/:regId", {
                        templateUrl: link + "/avaliacao.html",
                        controller: 'registro',
                        resolve: {
                            controleAcesso: function (accessControlProvider, $location) {
                                if (!accessControlProvider.verificaAcesso("evento-avaliacao")) {
                                    $location.path('/blocked');
                                }
                            }
                        }
                    });

            /**
             * Acesso restrito, Admin
             */

            //Dashboard ADMIN
            $routeProvider
                    .when("/admin", {
                        templateUrl: link + '/admin/dashboard/geral.html',
                        controller: 'dashboard',
                        resolve: {
                            controleAcesso: function (accessControlProvider, $location) {
                                if (!accessControlProvider.verificaAcesso("evento-admin")) {
                                    $location.path('/blocked');
                                }
                            }
                        }
                    });
            //Dashboard ADMIN
            $routeProvider
                    .when("/admin/charts", {
                        templateUrl: link + '/admin/dashboard/charts.html',
                        controller: 'dashboard',
                        resolve: {
                            controleAcesso: function (accessControlProvider, $location) {
                                if (!accessControlProvider.verificaAcesso("evento-admin-grafico")) {
                                    $location.path('/blocked');
                                }
                            }
                        }
                    });
            //Dashboard ADMIN
            $routeProvider
                    .when("/admin/report", {
                        templateUrl: link + '/admin/dashboard/report.html',
                        controller: 'dashboard',
                        resolve: {
                            controleAcesso: function (accessControlProvider, $location) {
                                if (!accessControlProvider.verificaAcesso("evento-admin-relatorio")) {
                                    $location.path('/blocked');
                                }
                            }
                        }
                    });

            //Origens
            $routeProvider
                    .when("/admin/origens", {
                        templateUrl: link + '/admin/origens/listar.html',
                        controller: 'origens',
                        resolve: {
                            controleAcesso: function (accessControlProvider, $location) {
                                if (!accessControlProvider.verificaAcesso("evento-origem")) {
                                    $location.path('/blocked');
                                }
                            }
                        }
                    });

            //criação de origem
            $routeProvider
                    .when("/admin/origem", {
                        templateUrl: link + '/admin/origens/origem.html',
                        controller: 'origem',
                        resolve: {
                            controleAcesso: function (accessControlProvider, $location) {
                                if (!accessControlProvider.verificaAcesso("evento-origem-cadastro")) {
                                    $location.path('/blocked');
                                }
                            }
                        }
                    });

            //Edição de origem
            $routeProvider
                    .when("/admin/origem/:id", {
                        templateUrl: link + '/admin/origens/origem.html',
                        controller: 'origem',
                        resolve: {
                            controleAcesso: function (accessControlProvider, $location) {
                                if (!accessControlProvider.verificaAcesso("evento-origem-update")) {
                                    $location.path('/blocked');
                                }
                            }
                        }
                    });

            $routeProvider
                    .when("/admin/registro/:regId", {
                        templateUrl: link + '/admin/dashboard/registro.html',
                        controller: 'registro',
                        resolve: {
                            controleAcesso: function (accessControlProvider, $location) {
                                if (!accessControlProvider.verificaAcesso("evento-admin-registro")) {
                                    $location.path('/blocked');
                                }
                            }
                        }
                    });

            $routeProvider
                    .when("/admin/avaliacao/:regId", {
                        templateUrl: link + '/admin/dashboard/avaliacao.html',
                        controller: 'registro',
                        resolve: {
                            controleAcesso: function (accessControlProvider, $location) {
                                if (!accessControlProvider.verificaAcesso("evento-admin-avaliacao")) {
                                    $location.path('/blocked');
                                }
                            }
                        }
                    });

            $routeProvider
                    .when('/blocked', {
                        templateUrl: link + '/blocked.html'
                    });

            $routeProvider.otherwise({redirectTo: '/painel'});
        });
//        .run(function ($rootScope, $location, accessControlProvider) {
//            $rootScope.$on("$routeChangeStart", function (event, next, current) {
//
//            });
//        });
