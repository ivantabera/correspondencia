<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
      .logoMetro{
        width: 30%;
      }
    </style>
</head>
<body>
    <table>
        <tr>
          <th colspan="4">
            <img class="logoMetro" src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/images/stc.png';?>"/>
          </th>
          <th colspan="4">Turno de Correspondencia</th>
          <th colspan="4">Subdirección General de Mantenimiento</th>
        </tr>
        <tr>
          <td colspan="2">Para:</td>
          <td colspan="6">{{ isset($para->area) ? $para->area : 'Sin area' }}</td>
          <td colspan="4">Recepcíon</td>
        </tr>
        <tr>
          <td colspan="2">De:</td>
          <td colspan="6">{{ isset($de->nombre) ? $de->nombre : 'Sin nombre' }}</td>
          <td colspan="4">
              Folio: {{ isset($turno->oficio) ? $turno->oficio : 'Sin oficio' }} <br>
              Fecha: {{ isset($correspondencia->date_acuse) ? $correspondencia->date_acuse : 'Sin fecha' }} <br>
              Hora: {{ isset($correspondencia->hora_acuse) ? $correspondencia->hora_acuse : 'Sin hora' }}
          </td>
        </tr>
        <tr>
          <td colspan="12">Procedencia</td>
        </tr>
        <tr>
          <td colspan="12">
              Número de referencia:  {{ isset($correspondencia->referencia) ? $correspondencia->referencia : 'referencia nula' }} <br>
              Oficio: {{ isset($turno->oficio) ? $turno->oficio : 'S/N' }} <br>
              Fecha del oficio: {{ isset($turno->fecha_turno) ? $turno->fecha_turno : 'S/F' }}  <br>
              Área: promotor  {{ isset($correspondencia->num_entrada) ? $correspondencia->num_entrada : 'num_entrada nulo' }}
          </td>
        </tr>
        <tr>
          <td colspan="12">Asunto</td>
        </tr>
        <tr>
          <td colspan="12">{{ isset($correspondencia->asunto) ? $correspondencia->asunto : 'asunto nulo' }}</td>
        </tr>
        <tr>
          <td colspan="12">Instrucciones</td>
        </tr>
        <tr>
          <td colspan="12">
              Instrucción:  <br>
              Intrucciones adicionales: {{ isset($turno->instruccion_adicional) ? $turno->instruccion_adicional : 'Instruccion nula' }} 
          </td>
        </tr>
        <tr>
          <td colspan="3">Preparar Respuesta</td>
          <td colspan="2">Para su Análisis</td>
          <td colspan="2">Para su Conocimiento</td>
          <td colspan="2">Comentarios</td>
          <td colspan="3">Atención Procedente</td>
        </tr>
        <tr>
            <td colspan="3">pr</td>
            <td colspan="2">pa</td>
            <td colspan="2">pc</td>
            <td colspan="2">c</td>
            <td colspan="3">ap</td>
          </tr>
        <tr>
          <td colspan="12">Fecha compromiso: {{ isset($turno->compromiso_date) ? $turno->compromiso_date : 'Sin compromiso' }}
            <br>Compromiso: {{ isset($turno->respuesta_auto) ? $turno->respuesta_auto : 'Instruccion nula' }}</td>
        </tr>
        <tr>
          <td colspan="12">
              Atentamente
              _______________________________
          </td>
        </tr>
        <tr>
          <td colspan="12">Conclusión</td>
        </tr>
        <tr>
          <td colspan="12">conclusion</td>
        </tr>
        <tr>
          <td colspan="12">Regresar este formato con su conclusión y firma en el tiempo señalado</td>
        </tr>
        <tr>
          <td colspan="12">Cccep:</td>
        </tr>
      </table>
</body>
</html>