<?php
    include_once 'function.php';


    if($_SERVER['REQUEST_METHOD']==="GET" && isset($_GET['delete_btn']) && $_GET['delete_btn']=='class'){

            $id=$_GET['id'];
            $call=delete_data('classes',$id);

            if($call){
                echo "<script>
                alert('class deleted successfully.........');
                window.location.href='classes.php';
                </script>";
            }
            else{
                echo "<script>
                alert('Delete failed..');
                window.location.href='classes.php';
                </script>";
            }

    }
    else{
        header("Location:classes.php");
        exit();
    }


?>