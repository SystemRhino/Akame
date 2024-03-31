<?php
include('./php/conecta.php');
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <link rel="stylesheet" href="./css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">


    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/navbar.css">


    <title>Akame</title>
   
     
   
</head>
<body>



<div id="enterPag">
  <div class="enter">
    <center>
<img src="./img/logo.png" alt="" class="imglogo"><br>
    <h1 id="clickEnter" style="cursor:pointer;">[ENTER]</h1>
    </center>
  </div>
</div>

<script>
  nextPag = document.querySelector("#clickEnter").addEventListener("click", bele);

  function bele(){

    document.querySelector("#clickEnter").style.opacity = "0";
    document.querySelector(".imglogo").style.opacity = "0";

    setTimeout(() => {
    window.location.href = "catalogo.php";
  },1000);
  }
  
</script>

</body>
</html>
