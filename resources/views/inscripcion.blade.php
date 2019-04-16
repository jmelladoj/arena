<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscripción</title>
</head>
<body>
    <h2><b>Ya falta poco para completar tu registro en TORNEO ARENA 2019</b></h2>

    <p style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
        Para finalizar debes pagar tu inscripción en la categoría <b> {{ $atleta->categoria->nombre_categoria . ' ' . $atleta->categoria->nombre }} </b> por cualquiera de los dos medios que se indican a continuación:
    </p>

    <p style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
        Mercado Pago (<b>Recuerda que el pago debe ser ingresado con el nombre y correo del atleta o el representante en caso de duplas y tríos para poder identificar el pago</b>)<br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;Link: <a href="{{ $atleta->categoria->link_pago }}" target="__blank">{{ $atleta->categoria->link_pago }}</a>
    </p>

    <p style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
        Transferencia bancaria (<b>recuerda que en esta opción debes enviar el comprobante de transferencia a pagos@torneoarena.cl indicando correctamente en el asunto tu nombre (la de la dupla o trio) y categoría</b>). <br><br>
        <b>Los valores a transferir son: INDIVIDUAL $35.000.- DUPLAS $70.000.- Y TRIOS $105.000.-</b><br><br>
        Datos:<br>
        &nbsp;&nbsp;&nbsp;&nbsp;VIVALLOS Y ARIAS LIMITADA<br>
        &nbsp;&nbsp;&nbsp;&nbsp;CUENTA CORRIENTE BANCO BCI<br>
        &nbsp;&nbsp;&nbsp;&nbsp;Nº 61991431<br>
        &nbsp;&nbsp;&nbsp;&nbsp;R.U.T. 76.691.998-7<br>
        &nbsp;&nbsp;&nbsp;&nbsp;pagos@torneoarena.cl
    </p>

    <p style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px"> 
        - Una vez realizado el pago y dentro de las próximas horas te enviaremos un correo de confirmación validando que ya estas inscrito correctamente.<br>
        - El solo hecho de de haber  completado el formulario de registro no es valido como inscripción ni como reserva de cupos.
    </p>

    <p style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
        <b>DE PARTE DEL COMITE ORGANIZADOR, GRACIAS POR QUERER FORMAR PARTE DE TORNEO ARENA 2019</b><br><br>
        <img src="{{ asset('home/images/img.jpeg') }}" alt="" height="500px" width="auto">
    </p>
</body>
</html>