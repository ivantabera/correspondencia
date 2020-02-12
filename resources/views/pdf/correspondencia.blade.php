<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
          <th colspan="4">
            <img src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/images/stc.png';?>"/>
          </th>
          <th colspan="4">Turno de Correspondencia</th>
          <th colspan="4">subdireccion general de mantenimiento</th>
        </tr>
        <tr>
          <td colspan="2">Para:</td>
          <td colspan="6">GIF</td>
          <td colspan="4">Recepcíon</td>
        </tr>
        <tr>
          <td colspan="2">De:</td>
          <td colspan="6">Ing. Jorge Juárez Balderas</td>
          <td colspan="4">
              Folio: acuse
              Fecha: acuse
              Hora: acuse
          </td>
        </tr>
        <tr>
          <td colspan="12">Procedencia</td>
        </tr>
        <tr>
          <td colspan="12">
              Número: referencia  {{ isset($correspondencia->referencia) ? $correspondencia->referencia : 'referencia nula' }} <br>
              Fecha del oficio: elaboracion  {{ isset($correspondencia->asunto) ? $correspondencia->asunto : 'asunto nulo' }} <br>
              Área: promotor  {{ isset($correspondencia->num_entrada) ? $correspondencia->num_entrada : 'num_entrada nulo' }}
          </td>
        </tr>
        <tr>
          <td colspan="12">Asunto</td>
        </tr>
        <tr>
          <td colspan="12">asunto</td>
        </tr>
        <tr>
          <td colspan="12">Instrucciones</td>
        </tr>
        <tr>
          <td colspan="12">
              Intstrucción: combo 
              Intrucciones adicionales: captura
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
          <td colspan="12">Fecha compromiso: dd/mm/yyyy .- 'requiere respuesta ordinaria' semaforo</td>
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

    {{-- <table>
        <thead>
            <tr>
                <th>Numero de entrada</th>
                <th>Asunto</th>
                <th>Referencia</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($correspondencia as $corres)
                <tr>
                    <td>{{ $corres->num_entrada }}</td>
                    <td>{{ $corres->asunto }}</td>
                    <td>{{ $corres->referencia }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
</body>
</html>