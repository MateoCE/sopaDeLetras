<?php
    if(isset($_POST['nickName'])){
        $nickName= $_POST['nickName'];
    }else{
        $nickName = "Player";
    }
    echo $nickName;
?>