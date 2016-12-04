'use strict';

angular.module('itracker')
    .directive('officerExec', ['$routeParams', '$log', 'basecampService', 'dataService',
        function($routeParams, $log, basecampService, dataService){
            return {
                restrict: 'C',
                scope: {
                    'permissions': '=',
                    'department': '='
                },
                controller: ['$scope', ($scope) => {

                }],
                templateUrl: '/angular/dept.admin.officerExec'
            };
        }]);
