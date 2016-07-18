/**
 * Solicitud Aad controller
 */
'use strict';

angular.module('Poliza.controllers', []).
controller('polizaController', function($scope, polizaService) {


   polizaService.comboEmpresa().success(function(response) {

    $scope.empresas = response;

  });

  polizaService.comboIntermediario().success(function(response) {

    $scope.intermediarios = response;

  });

  polizaService.comboRamo().success(function(response) {

    $scope.ramos = response;

  });

  polizaService.comboFinanciamiento().success(function(response) {

    $scope.tipoFinanciamientos = response;

  });

  $("#montoPrima,#montoComision,#montoBono").keyup(function(event) {
    $scope.formatoPuntos(this, this.value.charAt(this.value.length - 1), 2);

  });

  $('#fechaInicioDP, #fechaInicio').datepicker({
    format: 'yyyy-mm-dd'
  }).on('changeDate', function(ev) {
    $scope.fechaInicio = $("#fechaInicio").val();
    $scope.vigencia();
    
  });


  $('#fechaCobroDP, #fechaCobro').datepicker({
    format: 'yyyy-mm-dd'
  }).on('changeDate', function(ev) {
    $scope.fechaCobro = $("#fechaCobro").val();
    $scope.vigencia();

  });

  $('#fechaIniFilDp,#fechaHasFilDp').datepicker({
    format: 'yyyy-mm-dd'
  }).on('changeDate', function(ev) {
    $scope.consultarPolizasFiltrosWhere();
  });


  //$('#datosPolizaForm').addClass('disabled');
  //$('#datosFinacierosPolForm').addClass('disabled');
  //$('#documentosPol').addClass('disabled');
  $scope.menuCarrusel();
  $scope.idPoliza = 0;
  $scope.idPol = 0;
  $scope.idDatosPol =0;
  $scope.idReciboPol =0;
  $scope.empresa = null;
  $scope.ramo = null;
  $scope.tipoFinanciamiento = 0;
  $scope.intermediario = null;
  $scope.numPol = "";
  $scope.polizas = [];
  $scope.comiReal = 0;
  $scope.bonoReal = 0;
  $scope.montoInter = 0;
  $scope.gastoAdmin = 0;
  $scope.montoIsrl = 0;
  $scope.negocioInter = 0;
  $scope.restaComision = 0;
  $scope.restaBono = 0;
  $scope.beneficiariosMostrar = true;
  $scope.renovacion=false;
  $scope.nuevoRecibo=false;
  $scope.anulacionReq=false;
  $scope.deshabilitarRenovacion=true;
  $scope.cancelarAccionPol=false;

  $(document).ready(function(){
  $("#tabConsutaContent").css({"margin-top":45-$('#menuPol').height()}); //+20
  $("#tabPolizaContent").css({"margin-top":35-$('#menuPol').height()}); //+20
  $("#tabpPolizaDocumentosContent").css({"margin-top":$('#menuPol').height()}); //+20
  });  

  $scope.resetFormPol = function() {
    
    $scope.formPoliza.$submitted=false;

  };

 



  $scope.consultarPolizasFiltrosWhere = function() {

  polizaService.consultarPolizasFiltrosWhere($("#numPolFil").val(),$("#numFinFil").val(),$("#numRecFil").val(),$("#fechaIniFil").val(),$("#fechaHasFil").val()).success(function(response) {

      $scope.polizas = response;

    });

  }

 /* $scope.consultarPolizasFiltrosWhere = function() {

    polizaService.consultarPolizasFiltrosWhere($("#numPolFil").val(),$("#numFinFil").val(),$("#numRecFil").val(),$("#fechaIniFil").val(),$("#fechaHasFil").val()).success(function(response) {

      $scope.polizas = response;

    });

  }  */

  $scope.consultaPolizaHistorico = function() {

    polizaService.consultaPolizaHistorico($scope.idPol).success(function(response) {

      $scope.polizaHistoricos = response;

    });

  }

  $scope.consultarPolizasFiltrosWhere();

  $("#fechaVencimiento").hide();
  $("#tabPolizaContent").hide();
  $("#tabpPolizaDocumentosContent").hide();
  $("#encabezado_tomador").hide();
  $("#recibosPoliza").hide();
  $("#clientesPoliza").hide();
  $('#fechaAnulacion,#fechaInicio,#fechaCobro,#fechaIniFil,#fechaIniFilDp,#fechaHasFil,#fechaHasFilDp').datepicker({
    format: 'yyyy-mm-dd'
  });

  $scope.mostrarFechaVencimiento = function() {

    if ($scope.Anulacion == true) {
      $("#fechaVencimiento").show();
      $scope.anulacionReq=true;
    } else {
      $("#fechaVencimiento").hide();
      $scope.anulacionReq=false;
    }

  }

  $scope.mostrarTab1 = function(id) {

    
    $("#tabPolizaContent").show();
    $("#tabConsutaContent").hide();
    $("#tabPolizaReciboContent").hide();
    $("#tabpPolizaDocumentosContent").hide();
    $scope.resetFormPol();
    $scope.renovacion=false;
    $scope.nuevoRecibo=false;
    $scope.cancelarAccionPol=false;



    if (id == 0) {

      $("#formPoliza")[0].reset();
      $scope.montoPrima = "";
      $scope.numPol="";
      $scope.empresa = null;
      $scope.ramo = null;
      $scope.fechaInicio = "";
      $scope.fechaVigencia = "";
      $scope.tipoFinanciamiento = 0;
      $scope.numFinanciamiento = "";
      $("#montoComision").val("");
      $scope.montoComision="";
      $scope.montoBono = "";
      $scope.Anulacion = false
      $scope.fechaAnulacion = "";
      $scope.mostrarFechaVencimiento();
      $scope.idPol = 0;
      $scope.intermediario = null;
      $scope.comisionReal();
      $scope.beneficiariosMostrar = true;
      $scope.fechaCobro="";
      $scope.numRecibo="";
    }

  }

  $scope.mostrarTab2 = function() {

    $scope.idPol = 0;
    $scope.numPol = "";
    $("#tabPolizaContent").hide();
    $("#tabConsutaContent").show();
    $("#tabPolizaReciboContent").hide();
    $("#tabpPolizaDocumentosContent").hide();
    $scope.consultarPolizasFiltrosWhere();
    $scope.setPage(0);
    $("#fechaIniFil").val("");
    $("#fechaHasFil").val("");

  }

  $scope.mostrarTab4 = function() {

    $("#tabPolizaContent").hide();
    $("#tabConsutaContent").hide();
    $("#tabPolizaReciboContent").hide();
    $("#tabpPolizaDocumentosContent").show();
  }

  //*******Para la paginacion de la tabla Proforma******* 
  $scope.itemsPerPage = 5;
  $scope.currentPage = 0;

  $scope.range = function() {

    if ($scope.pageCount() < 5) {
      var rangeSize = $scope.pageCount() + 1;
    } else {
      var rangeSize = 5;
    }

    var ret = [];
    var start;

    start = $scope.currentPage;
    if (start > $scope.pageCount() - rangeSize) {
      start = $scope.pageCount() - rangeSize + 1;
    }

    if (start < 0) {
      start = 0;
    }
    for (var i = start; i < start + rangeSize; i++) {
      ret.push(i);
    }

    return ret;
  };

  $scope.prevPage = function() {
    if ($scope.currentPage > 0) {
      $scope.currentPage--;
    }
  };

  $scope.prevPageDisabled = function() {
    return $scope.currentPage === 0 ? "disabled" : "";
  };

  $scope.pageCount = function() {
    return Math.ceil($scope.polizas.length / $scope.itemsPerPage) - 1;
  };

  $scope.nextPage = function() {
    if ($scope.currentPage < $scope.pageCount()) {
      $scope.currentPage++;
    }
  };

  $scope.nextPageDisabled = function() {
    return $scope.currentPage === $scope.pageCount() ? "disabled" : "";
  };

  $scope.setPage = function(n) {
    $scope.currentPage = n;
  };


  $scope.mostrarOcultarRecibos = function() {

    if ($('#recibosPoliza').is(':hidden')) {
      $("#recibosPoliza").show("slow");
    } else {
      $("#recibosPoliza").hide("slow");
    }

  }

  $scope.mostrarOcultarBeneficiarios = function() {

    $scope.consultarClientesTabla($scope.idPol);
  }


  $scope.modificarPolizas = function(poliza) {

    if (angular.isUndefined(poliza[0])) {

      $scope.montoPrima = "";
      $scope.empresa = "";
      $scope.ramo = "";
      $scope.fechaInicio = "";
      $scope.fechaVigencia = "";
      $scope.tipoFinanciamiento = 0;
      $scope.numFinanciamiento = "";
      $scope.montoComision = "";
      $scope.montoBono = "";
      $scope.Anulacion = false
      $scope.fechaAnulacion = "";
      $scope.mostrarFechaVencimiento();
      $scope.idPol = 0;
      $scope.idDatosPol =0;
      $scope.idReciboPol=0;
      $scope.intermediario = "";

    } else {

      $scope.numPol = poliza[0].numero_poliza;
      $scope.montoPrima = $scope.cambiarPuntosComas(poliza[0].monto_prima, true);
      $scope.empresa = poliza[0].id_empresa;
      $scope.ramo = poliza[0].id_ramo;
      $scope.fechaInicio = poliza[0].fecha_inicio;
      $scope.fechaVigencia = poliza[0].fecha_vigencia;
      $scope.tipoFinanciamiento = poliza[0].id_tipo_financiamiento;
      $scope.numFinanciamiento = poliza[0].numero_financiamiento;
      $("#montoComision").val($scope.cambiarPuntosComas(poliza[0].comision, true));
      $("#montoBono").val($scope.cambiarPuntosComas(poliza[0].bono, true));
      $scope.montoComision=$("#montoComision").val();
      $scope.montoBono=$("#montoBono").val();
      $scope.Anulacion = poliza[0].anulada;
      $scope.fechaAnulacion = poliza[0].fecha_anulacion;
      $scope.idPol = poliza[0].id_poliza;
      $scope.idDatosPol = poliza[0].id_datosPol;
      $scope.idReciboPol=poliza[0].id_reciboPol;
      $scope.numRecibo=poliza[0].numero_recibo;
      $scope.fechaCobro=poliza[0].fecha_cobro;
      $scope.mostrarFechaVencimiento();
      $scope.intermediario = poliza[0].id_intermediario;
      $scope.negocioInter = poliza[0].porcentaje_negocio;
      $scope.comisionReal();
      $scope.bonoRealPol();
      $scope.calculoIsrl();
      $scope.calculoNegocio();
      $scope.beneficiariosMostrar = false;
      $scope.compararFecha(poliza[0].fecha_vigencia);



    }


  }

  $scope.insertarModificarPoliza = function() {

    if ($scope.idPol != 0) {

      if($scope.nuevoRecibo==true){

        polizaService.agregaRecibo($scope.formatoNumBD($("#montoPrima").val()), $scope.formatoNumBD($("#montoBono").val()), $scope.formatoNumBD($("#montoComision").val()),
         $scope.idPol,$("#fechaCobro").val(),$scope.numRecibo,$scope.idDatosPol,$scope.idReciboPol).success(function(response) {

        alert(response);

      });

      }else{

      if($scope.renovacion==false){


      polizaService.modificarPoliza($scope.numPol, $scope.empresa, $scope.ramo,
        $("#fechaInicio").val(), $("#fechaVigencia").val(), $scope.intermediario, $scope.numFinanciamiento, $scope.tipoFinanciamiento,
        $scope.formatoNumBD($("#montoPrima").val()), $scope.formatoNumBD($("#montoBono").val()), $scope.formatoNumBD($("#montoComision").val()), $scope.Anulacion,
        $("#fechaAnulacion").val(), $scope.idPol,$("#fechaCobro").val(),$scope.numRecibo,$scope.idDatosPol,$scope.idReciboPol).success(function(response) {

        alert(response);

      });
      }else{
        polizaService.renovarPoliza($scope.numPol, $scope.empresa, $scope.ramo,
        $("#fechaInicio").val(), $("#fechaVigencia").val(), $scope.intermediario, $scope.numFinanciamiento, $scope.tipoFinanciamiento,
        $scope.formatoNumBD($("#montoPrima").val()), $scope.formatoNumBD($("#montoBono").val()), $scope.formatoNumBD($("#montoComision").val()), $scope.Anulacion,
        $("#fechaAnulacion").val(), $scope.idPol,$("#fechaCobro").val(),$scope.numRecibo,$scope.idDatosPol,$scope.idReciboPol).success(function(response) {

        alert(response);

      });
      }
    }

    } else {

      polizaService.insertarPoliza($scope.numPol, $scope.empresa, $scope.ramo,
        $("#fechaInicio").val(), $("#fechaVigencia").val(), $scope.intermediario, $scope.numFinanciamiento, $scope.tipoFinanciamiento,
        $scope.formatoNumBD($scope.montoPrima), $scope.formatoNumBD($("#montoBono").val()), $scope.formatoNumBD($("#montoComision").val()), $scope.Anulacion,
        $("#fechaAnulacion").val(), $scope.idPol,$("#fechaCobro").val(),$scope.numRecibo,$scope.idReciboPol).success(function(response) {

        if (response != 0) {
          $scope.idPol = response;
          $scope.beneficiariosMostrar = false;
          alert("Registro Exitoso");
        }

      });

    }
  }

  $scope.consultarExistenciaPol = function(idPol) {

    $scope.idPol = idPol;

    if (angular.isUndefined(idPol)) {
      idPol = 0;

    }


    polizaService.consultarPolizas($scope.numPol, idPol).success(function(response) {

      $scope.modificarPolizas(response);



    });


  }


  $scope.modificarPolizaTabla = function(idPol) {

    $scope.mostrarTab1(idPol);
    $scope.consultarExistenciaPol(idPol);
    $("#polizaForm").tab('show');

  }


  $scope.modificarClientePoliza = function(datos) {

    // $scope.resetFormClientes();
    $('#adultoForm').tab('show')
    $scope.formAdultoAct();
    $('#modalTablaUsuario').modal('toggle');
    $('.modal-backdrop').remove();
    $scope.ocultarPT = false;
    $scope.consultarClientePoliza(datos);

  }

  $scope.agregarModificarClientes = function() {
    
    $('#adultoForm').tab('show')
    $scope.formAdultoAct();
    $scope.resetFormClientes();
    $scope.ocultarPT = true;

  }

  $scope.comisionReal = function() {

    $scope.comisionPol = $scope.formatoNumBD($("#montoComision").val());
    $("#comiReal").val($scope.cambiarPuntosComas($scope.comisionPol - ($scope.comisionPol * 0.05), true));
    $scope.restaComision = $scope.comisionPol * 0.05;
    $scope.calculoIsrl();
    $scope.calculoNegocio();
  }

  $scope.bonoRealPol = function() {

    $scope.bonoPol = $scope.formatoNumBD($("#montoBono").val());
    $("#bonoReal").val($scope.cambiarPuntosComas($scope.bonoPol - ($scope.bonoPol * 0.05), true));
    $scope.restaBono = $scope.bonoPol * 0.05;

    $scope.calculoIsrl();
    $scope.calculoNegocio();

  }

  $scope.montoNegocioInter = function(id) {

    polizaService.montoNegocioIntermediario(id).success(function(response) {

      $scope.negocioInter = response[0].porcentaje_negocio;
      $scope.calculoNegocio();


    });

  }

  $scope.calculoIsrl = function() {

    $scope.montoIsrl = $scope.cambiarPuntosComas($scope.restaBono + $scope.restaComision, true);
  }

  $scope.calculoNegocio = function() {

    $scope.comisionRealPol = $scope.formatoNumBD($("#comiReal").val());
    $scope.montoInter = $scope.cambiarPuntosComas(($scope.comisionRealPol * $scope.negocioInter) / 100, true);
    $scope.gastoAdmin = $scope.cambiarPuntosComas($scope.formatoNumBD($("#comiReal").val()) - $scope.formatoNumBD($scope.montoInter), true);

  }

  $scope.vigencia = function() {
    polizaService.fechaVigencia($("#fechaInicio").val()).success(function(response) {
      $("#fechaVigencia").val(response);
      $scope.fechaVigencia=response;
      $scope.compararFecha(response);
      
    });
    
  }

  $scope.validarIdPol = function() {

    if ($scope.idPol != 0) {
      $scope.beneficiariosMostrar = false
    } else {
      $scope.beneficiariosMostrar = true;
    }
  }

  $scope.renovarPoliza=function(){

      $("#fechaInicio").val($scope.fechaVigencia);
      $scope.fechaInicio =$scope.fechaVigencia;
      $scope.vigencia();
      $scope.montoPrima = "";
      $scope.fechaVigencia = "";
      $scope.tipoFinanciamiento = 0;
      $scope.numFinanciamiento = "";
      $scope.montoComision ="";
      $scope.montoBono ="";
      $scope.Anulacion = false
      $scope.fechaAnulacion = "";
      $scope.mostrarFechaVencimiento();
      $scope.intermediario = "";
      $scope.comiReal="";
      $("#comiReal").val("");
      $scope.bonoReal="";
      $("#bonoReal").val("");
      $scope.montoInter="";
      $("#montoInter").val("");
      $scope.gastoAdmin="";
      $("#gastoAdmin").val("");
      $scope.montoIsrl="";
      $("#montoIsrl").val("");  
      $scope.fechaCobro="";
      $scope.renovacion=true;
      $scope.nuevoRecibo=false;
      $scope.numRecibo="";
      $scope.formPoliza.$submitted=true;
      $scope.cancelarAccionPol=true;

  }

  $scope.agregaRecibo=function(){

      $scope.montoPrima = "";
      $scope.montoComision ="";
      $scope.montoBono ="";
      $scope.comiReal="";
      $("#comiReal").val("");
      $scope.bonoReal="";
      $("#bonoReal").val("");
      $scope.montoInter="";
      $("#montoInter").val("");
      $scope.gastoAdmin="";
      $("#gastoAdmin").val("");
      $scope.montoIsrl="";
      $("#montoIsrl").val("");  
      $scope.fechaCobro="";
      $scope.nuevoRecibo=true;
      $scope.numRecibo="";
      $scope.formPoliza.$submitted=true;
      $scope.cancelarAccionPol=true;


  }

  $scope.compararFecha=function(fecha){
    polizaService.compararFecha($scope.fechaVigencia).success(function(response){

      if(response=='true'){
      $scope.deshabilitarRenovacion=false;
    }else{
      $scope.deshabilitarRenovacion=true;
    }
      
    });
  }

  $scope.insertarFinanciamiento=function(){
    polizaService.insertarFinanciamiento($scope.inicialFin,$scope.cuotasFin).success(function(response){
      alert(response);
      $('#modalFinanciamineto').modal('toggle');
    });
  }

  $scope.nuevoFinanciamiento=function () {

    $scope.inicialFin="";
    $scope.cuotasFin="";
    $scope.formFinanciamiento.$submitted=false;
  }

  $scope.consultaReciboHistorico=function(){
    polizaService.consultaReciboHistorico($scope.idDatosPol).success(function(response){
      $scope.polizaHistoricoRecs=response;
      alert(response)
    });
  }

  $scope.cancelarAccion=function(){
    
    $scope.numPol="";
    $scope.modificarPolizaTabla($scope.idPol);
    $scope.cancelarAccionPol=false;
  }

  $scope.GuardarArchivos=function(){
    var files = $scope.file_array;
  polizaService.GuardarArchivos(files).success(function(response){
    alert(response)

     });
//for (var i = 0; i < files.length; i++)
    //alert(files[i].name);
  }

})

.filter('offset', function() {
  return function(input, start) {
    start = parseInt(start, 10);
    return input.slice(start);
  };

});