/**
 * 
 */
'use strict';

angular.module('Reportes.controllers', []).

controller('reportesController', function($scope, reportesService) {
	
	
	$scope.menuCarrusel();
	$('#fechaDesdeDp, #fechaDesde').datepicker({format: 'yyyy-mm-dd'});
	$('#fechaHastaDp, #fechaHasta').datepicker({format: 'yyyy-mm-dd'});
	
});