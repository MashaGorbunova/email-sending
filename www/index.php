<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT']."/letter-generator/www/connectionDB.php";
require_once $_SERVER['DOCUMENT_ROOT']."/letter-generator/www/generatorLetter.php";

$c = new ConnectionWithDB ();
$g = new GeneratorLetter ();

$arr = $c->nameWithMail();
?>

<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>letter generator</title>
<link href="css/styles.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
	
<body>
<div class="container border-container">
<div class="row">
<h1 class="text-center text-info">Mail sending</h1>
</div>
<div class="row">
<div class="col-lg-6">
<form role="form" method="post" action="<?=$_SERVER ['PHP-SELF']?>">

<table class="table table-bordered">
<p class="text-info">Choose mail for sending:</p>
<tr><th  class="text-center">№</th><th  class="text-center">name</th><th  class="text-center">mail</th><th  class="text-center">choose</th></tr>
<tr><td colspan="3" class="text-center text-muted"><strong>Choose all</strong></td><td  class="text-center"><label class="checkbox-inline">
        <input type="checkbox" id="main" name="main"></label></td></tr>


<script>
    $(document).ready( function() {
       $("#main").click( function() {
            if($('#main').prop('checked')){
                $('.mc').prop('checked', true);
            } else {
                $('.mc').prop('checked', false);
            }
       });
    });
</script>		
		
<?php 

$i=1; //counter
foreach($arr as $base_key => $base_value) {
	echo '<tr>';
	
	echo '<td class="text-center text-muted">', $i++, '</td>';
	echo '<td class="text-muted">', $base_value['name'], '</td>';
	echo '<td class="text-muted">', $base_value['mail'], '</td>';
    print <<< BOX
        <td class="text-center"> <label class="checkbox-inline">
        <input type="checkbox" class="mc" name="flag[]" value="$i"> </label></td>
BOX;
   
    echo '</tr>';
}
?>
</table>
<button type="submit" class="btn btn-default"><strong>Send</strong></button>
</form>
</div>

<?php

if (isset($_POST['flag']) && !empty($_POST['flag'])) {
	print <<< TABLE
	<div class="col-lg-6">
<table class="table table-bordered">
<p class="text-info">Letter is sending:</p>
<tr><th  class="text-center">№</th><th  class="text-center">name</th><th  class="text-center">mail</th><th  class="text-center">send</th></tr>
<tr><td colspan="4" class="text-center text-muted"> *** </td></tr>
TABLE;
$i=1; //counter
foreach($arr as $base_key => $base_value) {
	echo '<tr>';
	
	echo '<td class="text-center text-muted">', $i++, '</td>';
	echo '<td class="text-muted">', $base_value['name'], '</td>';
	echo '<td class="text-muted">', $base_value['mail'], '</td>';
	echo '<td class="text-center text-muted">';
	for ($k=0; $k<count($_POST['flag']); $k++) { 
	if ( $i == $_POST['flag'][$k]) {
		$g->letterGenerator($arr[$i-2]['name'], $arr[$i-2]['mail']);
	}

    }
	echo '</td>';
    echo '</tr>';
}
echo '</table>';
echo '</div>';

}
session_destroy();

?>

</div>
</div>
</body>
</html>
