<!DOCTYPE html>
<html lang="en">
<head>
<title>Pink Floyd</title>
<meta charset="UTF-8">
<script type="text/javascript" src="http://code.jquery.com/jquery.js">    </script>
<script type="text/javascript">
    $(document).ready(function(){
    $("select.years").change(function(){
        $("#response option").remove();
        var selectedyear = $(".years option:selected").val();
        $.ajax({
            type: "POST",
            url: "selectyear.php",
            data: { years : selectedyear } 
        }).done(function(data){
            $("#response").html(data);
        });
    });
});
</script>
</head>

<body>
  <form method="post">
    <input type="submit" name="reloaddb" value="Обновить данные"/>
  </form>
  
<?php

include 'dropdown.php';

if(isset($_POST['reloaddb'])) {
  $start_time = microtime(true);
  include 'filldb.php';
  $end_time = microtime(true);
  $execution_time = ($end_time - $start_time);
  echo "Done! Execution time of script = ".$execution_time." sec";
}


?>
<div id="response"></div>
</body>
</html>
