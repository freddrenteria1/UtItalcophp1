<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();



//consulta valvulas os02
$totalvalec = 5;
$totalvalut = 5;
$totalvalec1 = 5;
$totalvalut1 = 5;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os02";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantvalvulas = $cant;

$totalvalec = $totalvalec * $cant;
$totalvalut = $totalvalut * $cant;

$cons3 = "SELECT * FROM os02";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

$html = "<table>" .
"<thead>" .
"<th>TAG</th>" .
"<th>CUSTODIA UT</th>" .
"<th>CUSTODIA ECP</th>" .
"<th>ENTRGA  A TALLER UT</th>" .
" <th>ENTRGA  A TALLER ECP</th>" .
"<th>RETIRO DE TALLER UT</th>" .
"<th>RETIRO DE TALLER ECP</th>" .
"<th>TERMINACIÓN MECÁNICA UT</th>" .
"<th>TERMINACIÓN MECÁNICA ECP</th>" .
"<th>ENTREGA OPERACIONES UT</th>" .
"<th>ENTREGA OPERACIONES ECP</th>" .
"</thead>" .
"<tbody>";

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os02 WHERE tag = '$tag'";
    $ejec = mysqli_query($conexion, $cons);

    while($obj = mysqli_fetch_object($ejec)){

        if($obj->permiso != ""){
            $permiso =  json_decode($obj->permiso);
            if($permiso[0]->nombreut != ""){
                $sumfirmaut++;
                $fechapermut = $permiso[0]->fechaut;
            }
            if($permiso[0]->nombreec != ""){
                $sumfirmaec++;
                $fechapermec = $permiso[0]->fechaec;
            }
        }
    
        if($obj->mantenimiento != ""){
            $mantenimiento =  json_decode($obj->mantenimiento);
            if($mantenimiento[0]->nombreut != ""){
                $sumfirmaut++;
                $fechamantut = $mantenimiento[0]->fechaut;
            }
            if($mantenimiento[0]->nombreec != ""){
                $sumfirmaec++;
                $fechamantec = $mantenimiento[0]->fechaec;
            }
        }
    
        if($obj->retiro != ""){
            $retiro =  json_decode($obj->retiro);
            if($retiro[0]->nombreut != ""){
                $sumfirmaut++;
                $fecharetut = $retiro[0]->fechaut;
            }
            if($retiro[0]->nombreec != ""){
                $sumfirmaec++;
                $fecharetec = $retiro[0]->fechaec;
            }
        }
        
       
    
        if($obj->terminacion != ""){
            $terminacion =  json_decode($obj->terminacion);
            if($terminacion[0]->nombreut != ""){
                $sumfirmaut++;
                $fechatermut = $terminacion[0]->fechaut;
            }
            if($terminacion[0]->nombreec != ""){
                $sumfirmaec++;
                $fechartermec = $terminacion[0]->fechaec;
            }
        }
    
         if($obj->entrega != ""){
            $entrega =  json_decode($obj->entrega);
            if($entrega[0]->nombreut != ""){
                $sumfirmaut++;
                $fechaentut = $entrega[0]->fechaut;
            }
            if($entrega[0]->nombreec != ""){
                $sumfirmaec++;
                $fechaentec = $entrega[0]->fechaec;
            }
        }

        $html .= "<tr>";
        $html .= "<td>"  . $tag  . "</td>";
        $html .= "<td>"  . $fechapermut  . "</td>";
        $html .= "<td>"  . $fechapermec  . "</td>";
        $html .= "<td>"  . $fechamantut  . "</td>";
        $html .= "<td>"  . $fechamantec  . "</td>";
        $html .= "<td>"  . $fecharetut  . "</td>";
        $html .= "<td>"  . $fecharetec  . "</td>";
        $html .= "<td>"  . $fechatermut  . "</td>";
        $html .= "<td>"  . $fechartermec  . "</td>";
        $html .= "<td>"  . $fechaentut  . "</td>";
        $html .= "<td>"  . $fechaentec  . "</td>";
        $html .= "</tr>";
      

    
    }


  

}

$html .= "</tbody>";
$html .= "</table>";

echo $html;

