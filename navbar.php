<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<style>

/* =========================
   GLOBAL
========================= */

*{
    box-sizing:border-box;
}

html,body{
    width:100%;
    overflow-x:hidden;
}


/* =========================
   NAVBAR
========================= */

.navbar{

    background:white;
    padding:6px 12px;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
    width:100%;

}


.container-fluid{

    width:100%;
    padding-left:12px;
    padding-right:12px;

}



/* =========================
   LOGO
========================= */

.navbar-brand img{

    width:110px;
    max-width:100%;
    height:auto;
    object-fit:contain;

}




/* =========================
   MENU
========================= */


.nav-link{

    font-size:18px;
    font-weight:600;
    color:#333;
    margin:0 5px;

}


.nav-link:hover{

    color:#ba6a4a;

}



.navbar-nav{

    flex-wrap:wrap;

}




/* =========================
   BUTTON
========================= */
.auth-btn{

    background:#ba6a4a;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
    font-weight:600;
    display:inline-block;
    white-space:nowrap;

}

/* .auth-btn{

    background:#ba6a4a;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
    font-weight:600;
    display:inline-block;

} */


.auth-btn:hover{

    background:#9d5438;
    color:white;

}




/* =========================
   PROFILE
========================= */


.profile-img{

    width:45px;
    height:45px;
    border-radius:50%;
    object-fit:cover;

}





/* =========================
   MOBILE / TABLET
========================= */


@media(max-width:991px){


    .navbar-collapse{

        width:100%;

    }



    .navbar-nav{

        width:100%;
        /* text-align:center; */
        margin-top:15px;

    }



    .nav-item{

        width:100%;

    }



    .nav-link{

        font-size:16px;
        padding:10px;

    }
 .auth-area{

        width:100%;
        margin-top:15px;
        /* justify-content:center; */
        align-items:center;
        flex-direction:row !important;
        gap:10px !important;

    }


    .auth-btn{

        width:auto;
        padding:8px 16px;

    }


  


    .navbar-brand img{

        width:90px;

    }



}





/* =========================
   SMALL MOBILE
========================= */


@media(max-width:576px){


    .navbar{

        padding:5px 8px;

    }



    .container-fluid{

        padding-left:5px;
        padding-right:5px;

    }



    .navbar-brand img{

        width:85px;

    }



    .navbar-toggler{

        padding:5px 8px;

    }


}



</style>





<nav class="navbar navbar-expand-lg sticky-top">


<div class="container-fluid">



<!-- LOGO -->

<a class="navbar-brand" href="index.php">

<img src="assets/image/f4faab5c-a29f-4582-8c93-6be2c62fee75-removebg-preview.png">

</a>





<!-- MOBILE BUTTON -->


<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navbarMenu">


<span class="navbar-toggler-icon"></span>


</button>






<div class="collapse navbar-collapse" id="navbarMenu">





<!-- LEFT MENU -->


<ul class="navbar-nav me-auto mb-2 mb-lg-0">



<li class="nav-item">

<a class="nav-link active" href="index.php">

Home

</a>

</li>




<li class="nav-item">

<a class="nav-link" href="#aboutus">

About

</a>

</li>






<?php

if(isset($_SESSION['user_id']) 
&& isset($_SESSION['role']) 
&& $_SESSION['role']=='student')

{

?>

<li class="nav-item">

<a class="nav-link" href="user_classes.php">

Classes

</a>

</li>


<?php

}

?>






<li class="nav-item">

<a class="nav-link" href="#pricing">

Pricing

</a>

</li>






<li class="nav-item">

<a class="nav-link" href="#review">

Review

</a>

</li>






<li class="nav-item">

<a class="nav-link" href="#team">

Team

</a>

</li>




</ul>








<!-- RIGHT SIDE -->


<div class="auth-area d-flex flex-column flex-lg-row align-items-lg-center gap-2">





<?php


if(isset($_SESSION['user_id'])){


$image = !empty($_SESSION['user_image']) 
? $_SESSION['user_image'] 
: 'default.png';



$role=$_SESSION['role'] ?? '';

?>





<!-- PROFILE DROPDOWN -->


<div class="dropdown">


<a class="d-flex align-items-center text-decoration-none dropdown-toggle"
href="#"
data-bs-toggle="dropdown">


<!-- <img src="../images/<?php echo $row['image'] ?? 'default.png'; ?>"
     class="profile-img"> -->
     <img src="images/<?php echo htmlspecialchars($image); ?>"
             class="profile-img"
             alt="Profile">


</a>






<ul class="dropdown-menu dropdown-menu-end">



<?php if($role=='teacher'){ ?>


<li>

<a class="dropdown-item"
href="teacher_panel/overview.php">

Dashboard

</a>

</li>




<li>

<a class="dropdown-item"
href="teacher_panel/teacher_profile.php">

My Profile

</a>

</li>



<?php }else{ ?>



<li>

<a class="dropdown-item"
href="user_panel/overview.php">

Dashboard

</a>

</li>




<li>

<a class="dropdown-item"
href="miniprofile.php">

My Profile

</a>

</li>



<?php } ?>





<li>

<hr class="dropdown-divider">

</li>






<li>

<a class="dropdown-item text-danger"
href="logout.php">

Logout

</a>

</li>



</ul>



</div>






<?php


}

else{


?>



<a href="signup.php"
class="auth-btn">

Signup

</a>






<a href="login.php"
class="auth-btn">

Signin

</a>




<?php

}

?>





</div>





</div>


</div>


</nav>