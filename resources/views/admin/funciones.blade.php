@php
  function traesuma($campos, $tabla, $criterio, $buscar){
    $sqltrol='SELECT '.$campos.' FROM '.$tabla.' WHERE '.$criterio.'='.$buscar;
    $restrol=mysqli_query(conn(),$sqltrol) or die('FALLO LA CONSULTA: '.mysqli_error(conn()));
    $datrol=mysqli_fetch_array($restrol);
    $descmat=$datrol[0];
    mysqli_free_result($restrol);
    return $descmat;
  }
@endphp