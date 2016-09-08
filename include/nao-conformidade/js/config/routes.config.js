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
                            registros: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + '/registro');
                            },
                            session: function (config) {
                                return config.userLogin;
                            }
                        }
                    });
            //visão seguimentada
            $routeProvider
                    .when("/painel/:local", {
                        templateUrl: link + "/painel_master.html",
                        controller: 'masterList',
                        resolve: {
                            registros: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + '/registro');
                            },
                            usuarios: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + '/usuarios');
                            },
                            session: function (config) {
                                return config.userLogin;
                            }
                        }
                    });

            //Novo registro
            $routeProvider
                    .when("/registro", {
                        templateUrl: link + "/registro.html",
                        controller: 'registro',
                        resolve: {
                            usuarios: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + '/usuarios');
                            },
                            origens: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/origem");
                            },
                            areas: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/area");
                            },
                            registro: function () {
                                return null;
                            },
                            registroHasOrigem: function () {
                                return null;
                            },
                            registroHasFile: function () {
                                return null;
                            },
                            registroHasImage: function () {
                                return null;
                            }
                        }
                    });

            //consulta de registro
            $routeProvider
                    .when("/registro/:regId", {
                        templateUrl: link + "/registro.html",
                        controller: 'registro',
                        resolve: {
                            usuarios: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + '/usuarios');
                            },
                            origens: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/origem");
                            },
                            areas: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/area");
                            },
                            registro: function ($route, objetoAPI, config) {
                                var regId = $route.current.params.regId;
                                return objetoAPI.getObjeto(config.apiURL + '/registro/&id=' + regId);
                            },
                            registroHasOrigem: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/registroHasOrigem");
                            },
                            registroHasFile: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/registroHasFile");
                            },
                            registroHasImage: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/registroHasImage");
                            }
                        }
                    });

            //avaliação resposta/consulta
            $routeProvider
                    .when("/avaliacao/:regId", {
                        templateUrl: link + "/avaliacao.html",
                        controller: 'registro',
                        resolve: {
                            usuarios: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + '/usuarios');
                            },
                            origens: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/origem");
                            },
                            areas: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/area");
                            },
                            registro: function ($route, objetoAPI, config) {
                                var regId = $route.current.params.regId;
                                return objetoAPI.getObjeto(config.apiURL + '/registro/&id=' + regId);
                            },
                            registroHasOrigem: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/registroHasOrigem");
                            },
                            registroHasFile: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/registroHasFile");
                            },
                            registroHasImage: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/registroHasImage");
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
                            registros: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/registroDashboard");
                            }
                        }
                    });
            //Dashboard ADMIN
            $routeProvider
                    .when("/admin/charts", {
                        templateUrl: link + '/admin/dashboard/charts.html',
                        controller: 'dashboard',
                        resolve: {
                            registros: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/registroDashboard");
                            }
                        }
                    });
            //Dashboard ADMIN
            $routeProvider
                    .when("/admin/report", {
                        templateUrl: link + '/admin/dashboard/report.html',
                        controller: 'dashboard',
                        resolve: {
                            registros: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/registroDashboard");
                            }
                        }
                    });

            //Origens
            $routeProvider
                    .when("/admin/origens", {
                        templateUrl: link + '/admin/origens/listar.html',
                        controller: 'origens',
                        resolve: {
                            origens: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/origem");
                            }
                        }
                    });

            //criação de origem
            $routeProvider
                    .when("/admin/origem", {
                        templateUrl: link + '/admin/origens/origem.html',
                        controller: 'origem',
                        resolve: {
                            origem: function () {
                                return {data: null};
                            }
                        }
                    });

            //Edição de origem
            $routeProvider
                    .when("/admin/origem/:id", {
                        templateUrl: link + '/admin/origens/origem.html',
                        controller: 'origem',
                        resolve: {
                            origem: function (objetoAPI, config, $route) {
                                var origemID = $route.current.params.id;
                                return objetoAPI.getObjeto(config.apiURL + "/origem&id=" + origemID);
                            }
                        }
                    });

            $routeProvider
                    .when("/admin/registro/:regId", {
                        templateUrl: link + '/admin/dashboard/registro.html',
                        controller: 'registro',
                        resolve: {
                            usuarios: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + '/usuarios');
                            },
                            origens: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/origem");
                            },
                            areas: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/area");
                            },
                            registro: function ($route, objetoAPI, config) {
                                var regId = $route.current.params.regId;
                                return objetoAPI.getObjeto(config.apiURL + '/registro/&id=' + regId);
                            },
                            registroHasOrigem: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/registroHasOrigem");
                            },
                            registroHasFile: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/registroHasFile");
                            },
                            registroHasImage: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/registroHasImage");
                            }
                        }
                    });

            $routeProvider
                    .when("/admin/avaliacao/:regId", {
                        templateUrl: link + '/admin/dashboard/avaliacao.html',
                        controller: 'registro',
                        resolve: {
                            usuarios: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + '/usuarios');
                            },
                            origens: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/origem");
                            },
                            areas: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/area");
                            },
                            registro: function ($route, objetoAPI, config) {
                                var regId = $route.current.params.regId;
                                return objetoAPI.getObjeto(config.apiURL + '/registro/&id=' + regId);
                            },
                            registroHasOrigem: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/registroHasOrigem");
                            },
                            registroHasFile: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/registroHasFile");
                            },
                            registroHasImage: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.apiURL + "/registroHasImage");
                            }
                        }
                    });

            $routeProvider
                    .when('/blocked', {
                        templateUrl: link + '/blocked.html'
                    });

            $routeProvider.otherwise({redirectTo: '/painel'});
        });
