<?php
global $conn;
include 'db_connect.php';

if(!isset($_GET['id'])){
    die("Class ID not found");
}

$id = $_GET['id'];

$query = "SELECT * FROM classes WHERE id='$id'";

$result = mysqli_query($conn,$query);

if(!$result){
    die("Database Error : ".mysqli_error($conn));
}
 
$row = mysqli_fetch_assoc($result);

if(!$row){
    die("Class not found");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Class Details</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<style>

body{
    background:#ba6a4a;
}


/* BACK BUTTON */

.back-btn{

display:inline-flex;
align-items:center;
gap:10px;

background:rgba(255,255,255,.15);

color:white;

text-decoration:none;

padding:14px 24px;

border-radius:50px;

font-weight:600;

backdrop-filter:blur(12px);

transition:.4s;

}


.back-btn:hover{

background:white;

color:#ba6a4a;

transform:translateX(-5px);

}



/* CARD */


.details-card{

background:white;

border-radius:35px;

overflow:hidden;

box-shadow:0 25px 60px rgba(0,0,0,.18);

}



/* HEADER */


.header-section{

background:linear-gradient(135deg,#f8eee7,#f3dfd2);

color:#8f5037;

padding:35px;

text-align:center;

}



.header-icon{

width:70px;

height:70px;

margin:auto;

border-radius:50%;

background:white;

display:flex;

align-items:center;

justify-content:center;

font-size:35px;

color:#ba6a4a;

}



.class-name{

font-size:32px;

font-weight:700;

margin-top:20px;

}



/* LEFT */


.left-panel{

background:#fff9f6;

padding:35px;

height:100%;

}


.info-item{

background:white;

border-radius:20px;

padding:20px;

margin-bottom:18px;

box-shadow:0 5px 20px rgba(0,0,0,.06);

}


.info-title{

color:#ba6a4a;

font-size:13px;

font-weight:600;

text-transform:uppercase;

}


.info-value{

font-size:22px;

font-weight:700;

}


/* RIGHT */


.right-panel{

padding:35px;

}


.section-title{

color:#ba6a4a;

font-weight:700;

margin-bottom:20px;

}


.benefit-box{

background:#faf7f4;

border-left:5px solid #ba6a4a;

padding:15px 20px;

border-radius:18px;

margin-bottom:15px;

}



</style>


</head>
<body>
<?php include('navbar.php'); ?>

<div class="container mt-5 mb-5">


    <div class="mb-4">

        <a href="user_classes.php" class="back-btn">

            <i class="fa-solid fa-arrow-left"></i>

            Back to Classes

        </a>

    </div>



    <div class="details-card">



        <!-- HEADER -->

        <div class="header-section">


            <div class="header-icon">

                <i class="fa-solid fa-spa"></i>

            </div>



            <h1 class="class-name">

                <?php echo $row['name'] ?? 'Yoga Class'; ?>

            </h1>



            <p>

                Balance • Strength • Inner Peace

            </p>


        </div>





        <div class="row g-0">



            <!-- LEFT PANEL -->


            <div class="col-md-4">


                <div class="left-panel">



                    <div class="info-item">

                        <div class="info-title">
                            Instructor
                        </div>


                        <div class="info-value">

                            <?php echo $row['instructor'] ?? 'Not Available'; ?>

                        </div>


                    </div>





                    <div class="info-item">


                        <div class="info-title">

                            Level

                        </div>



                        <div class="info-value">


                            <?php echo $row['level'] ?? 'Beginner'; ?>


                        </div>


                    </div>





                    <div class="info-item">


                        <div class="info-title">

                            Duration

                        </div>



                        <div class="info-value">


                            <?php echo $row['duration'] ?? '0'; ?> min


                        </div>


                    </div>





                    <div class="info-item">


                        <div class="info-title">

                            Date

                        </div>



                        <div class="info-value">


                            <?php echo $row['schedule_date'] ?? 'Not Available'; ?>


                        </div>


                    </div>





                    <div class="info-item">


                        <div class="info-title">

                            Price

                        </div>



                        <div class="info-value">


                            ₹ <?php echo $row['price'] ?? '0'; ?>


                        </div>


                    </div>



                </div>


            </div>







            <!-- RIGHT PANEL -->


            <div class="col-md-8">


                <div class="right-panel">





                    <h3 class="section-title">

                        Description

                    </h3>



                    <p>

                        <?php 

                        echo $row['description'] ?? 'No description available';

                        ?>


                    </p>







                    <h3 class="section-title mt-5">

                        Benefits

                    </h3>






                    <?php


                    if(!empty($row['benefits'])){


                        $benefits = explode(',', $row['benefits']);



                        foreach($benefits as $benefit){



                    ?>



                    <div class="benefit-box">


                        <i class="fa-regular fa-circle-check"
                        style="color:#ba6a4a;">
                        </i>



                        <?php echo trim($benefit); ?>


                    </div>



                    <?php


                        }



                    }else{


                    ?>



                    <div class="benefit-box">

                        No benefits available


                    </div>



                    <?php } ?>





                </div>


            </div>





        </div>




    </div>



</div>





</body>

</html>