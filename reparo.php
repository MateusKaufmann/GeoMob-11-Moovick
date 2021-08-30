<?php 

require_once 'reparo.php'; 

mysqli_query($connect, "SET @count = 0;");
mysqli_query($connect, " UPDATE turmas SET turmas.id = @count:= @count + 1;");
mysqli_query($connect, "SET @count = 0;");
mysqli_query($connect, " UPDATE conteudos SET conteudos.id = @count:= @count + 1;");
?>