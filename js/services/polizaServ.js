/**
 * Poliza
 */
angular.module('Poliza.services', [])
  .factory('polizaService', function($http) {

    var angularAPI = {};

    angularAPI.consultarPolizasFiltros = function() {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/consultaPolizaFiltrosAll'
      });
    }

    angularAPI.consultarPolizasFiltrosWhere = function(queryNp,queryNf,queryNr,queryFechaIni,queryFechaIniHasta) {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/consultaPolizaFiltros',
        params: {
          queryNp: queryNp,
          queryNr: queryNr,
          queryNf:queryNf,
          queryFechaIni:queryFechaIni,
          queryFechaIniHasta:queryFechaIniHasta
        }
      });
    }    

    angularAPI.consultarPolizas = function(numPol, idPol) {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/consultaPoliza1',
        params: {
          idPol: idPol,
          numPol: numPol
        }
      });
    }

    angularAPI.consultaPolizaHistorico = function(idPol) {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/consultaPolizaHistorico',
        params: {
          idPol: idPol
        }
      });
    }

    angularAPI.comboEmpresa = function() {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/comboEmpresa'
      });
    }

    angularAPI.comboRamo = function() {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/comboRamo'
      });
    }

    angularAPI.comboFinanciamiento = function() {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/comboFinanciamiento'
      });
    }

    angularAPI.comboIntermediario = function() {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/comboIntermediario',
      });
    }

    angularAPI.fechaVigencia = function(fecha) {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/fechaVigencia',
        params: {
          fecha: fecha
        }
      });
    }

    angularAPI.montoNegocioIntermediario = function(idInter) {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/montoNegocioIntermediario',
        params: {
          idInter: idInter
        }
      });
    }    

    angularAPI.insertarPoliza = function(numPol, idEmpresa, idRamo, fechaIni, fechaVig, intermediario, numFin, idFin, prima, bono, comision, anul, fechaAnu, idPol,fecha_cobro,num_recibo) {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/insertarPoliza1',
        params: {
          numPol: numPol,
          idEmpresa: idEmpresa,
          idRamo: idRamo,
          anul: anul,
          fechaAnu: fechaAnu,
          fechaIni: fechaIni,
          fechaVig: fechaVig,
          intermediario: intermediario,
          numFin: numFin,
          idFin: idFin, //
          prima: prima,
          bono: bono,
          comision: comision,
          idPol: idPol,
          fecha_cobro:fecha_cobro,
          num_recibo:num_recibo,
        }
      });
    }

    angularAPI.modificarPoliza = function(numPol, idEmpresa, idRamo, fechaIni, fechaVig, intermediario, numFin, idFin, prima, bono, comision, anul, fechaAnu, idPol,fecha_cobro,num_recibo,idDatosPol,idReciboPol) {

      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/modificarPoliza1',
        params: {
          numPol: numPol,
          idEmpresa: idEmpresa,
          idRamo: idRamo,
          anul: anul,
          fechaAnu: fechaAnu,
          fechaIni: fechaIni,
          fechaVig: fechaVig,
          intermediario: intermediario,
          numFin: numFin,
          idFin: idFin, //
          prima: prima,
          bono: bono,
          comision: comision,
          idPol: idPol,
          fecha_cobro:fecha_cobro,
          num_recibo:num_recibo,
          idDatosPol:idDatosPol,
          idReciboPol:idReciboPol
        }
      });
    }

    angularAPI.renovarPoliza = function(numPol, idEmpresa, idRamo, fechaIni, fechaVig, intermediario, numFin, idFin, prima, bono, comision, anul, fechaAnu, idPol,fecha_cobro,num_recibo,idDatosPol,idReciboPol) {

      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/renovarPoliza',
        params: {
          numPol: numPol,
          idEmpresa: idEmpresa,
          idRamo: idRamo,
          anul: anul,
          fechaAnu: fechaAnu,
          fechaIni: fechaIni,
          fechaVig: fechaVig,
          intermediario: intermediario,
          numFin: numFin,
          idFin: idFin, //
          prima: prima,
          bono: bono,
          comision: comision,
          idPol: idPol,
          fecha_cobro:fecha_cobro,
          num_recibo:num_recibo,
          idDatosPol:idDatosPol,
          idReciboPol:idReciboPol
        }
      });
    }

    angularAPI.agregaRecibo = function(prima, bono, comision,idPol,fecha_cobro,num_recibo,idDatosPol,idReciboPol) {

      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/agregarRecibo',
        params: {
          prima: prima,
          bono: bono,
          comision: comision,
          idPol: idPol,
          fecha_cobro:fecha_cobro,
          num_recibo:num_recibo,
          idDatosPol:idDatosPol,
          idReciboPol:idReciboPol
        }
      });
    }

    angularAPI.compararFecha = function(fechaVig) {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/compararFecha',
        params: {
          fechaVig: fechaVig
        }
      });
    }

    angularAPI.insertarFinanciamiento = function(inicial,cuotas) {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/insertarFinanciamiento',
        params: {
          inicial: inicial,
          cuotas:cuotas
        }
      });
    }

    angularAPI.consultaReciboHistorico = function(idDatosPol) {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/consultaReciboHistorico',
        params: {
          idDatosPol:idDatosPol
        }
      });
    }  

    angularAPI.GuardarArchivos = function(files) {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/subirArchivos',
        params: {
          file_array:files
        }
      });
    }           




    return angularAPI;
  });