<?php
    require('config.php');
    $t = $_GET['t'];
    exec($editorpath.' '.$t);
    echo "<script>window.close();</script>";
?>
