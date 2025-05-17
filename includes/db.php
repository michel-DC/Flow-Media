<?php 
function linkyDB () {
    $link = mysqli_connect("localhost", "micheldjoumessi_flow-media", "michouflow", "micheldjoumessi_flow-media");
    if (!$link) {
        die("La connexion a échoué: " . mysqli_connect_error());
    }
    return $link;
}
?>