<?php virtual('/p8/Connections/conexion_p8.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_consulta_usuarios = 10;
$pageNum_consulta_usuarios = 0;
if (isset($_GET['pageNum_consulta_usuarios'])) {
  $pageNum_consulta_usuarios = $_GET['pageNum_consulta_usuarios'];
}
$startRow_consulta_usuarios = $pageNum_consulta_usuarios * $maxRows_consulta_usuarios;

mysql_select_db($database_conexion_p8, $conexion_p8);
$query_consulta_usuarios = "SELECT * FROM usuarios";
$query_limit_consulta_usuarios = sprintf("%s LIMIT %d, %d", $query_consulta_usuarios, $startRow_consulta_usuarios, $maxRows_consulta_usuarios);
$consulta_usuarios = mysql_query($query_limit_consulta_usuarios, $conexion_p8) or die(mysql_error());
$row_consulta_usuarios = mysql_fetch_assoc($consulta_usuarios);

if (isset($_GET['totalRows_consulta_usuarios'])) {
  $totalRows_consulta_usuarios = $_GET['totalRows_consulta_usuarios'];
} else {
  $all_consulta_usuarios = mysql_query($query_consulta_usuarios);
  $totalRows_consulta_usuarios = mysql_num_rows($all_consulta_usuarios);
}
$totalPages_consulta_usuarios = ceil($totalRows_consulta_usuarios/$maxRows_consulta_usuarios)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="1">
  <tr>
    <td>id_usuario</td>
    <td>nombre_usuario</td>
    <td>apellido_usuario</td>
    <td>folio</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_consulta_usuarios['id_usuario']; ?></td>
      <td><?php echo $row_consulta_usuarios['nombre_usuario']; ?></td>
      <td><?php echo $row_consulta_usuarios['apellido_usuario']; ?></td>
      <td><?php echo $row_consulta_usuarios['folio']; ?></td>
    </tr>
    <?php } while ($row_consulta_usuarios = mysql_fetch_assoc($consulta_usuarios)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($consulta_usuarios);
?>
