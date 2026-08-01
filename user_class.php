<?php
include('user_class_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="user_list.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheets">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" 
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 left pt-2"style="background-color:#e9eaee;">
                <?php
                    include('sidebar.php');
                ?>
            </div>
    
            <div class="col-md-10 "style="background-color:#f57847;">
                <?php
                    $data=all_details('users');
                ?>

                <div class="table-responsive  right pt-2 " >
         
                    <table class="table table-striped border-dark " >
                        <thead style="background-color:#f57847;">
                            <tr >
                                <th>SL No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <!-- <th>Qualification</th> -->
                                <th>ph_no</th>
                                <th>address</th>
                                <th>Image</th>
                                <th>Action</th>

                            </tr> 
                        </thead>
                        <tbody>
                            <?php
                                 if(!empty($data)){
                                    foreach($data as $key=>$row){
                            ?>
                            <tr>
                                <td><?php echo ($key+1);?></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['email'];?></td>
                                <td><?php echo $row['gender']??'NA';?></td>
                                <!-- <td><?php echo $row['qualification'];?></td> -->
                                <td><?php echo $row['ph_no'];?></td>
                                <td><?php echo $row['address'];?></td>
                                <td>
                                <img src="<?php echo !empty($row['image'])?'../image/'.$row['image']:'assets/image/istockphoto-1495088043-612x612.jpg'?>"
                                style="height: 80px;"/>
</td>
                                
                            </td>
                                <td>
                                    <div class="d-flex gap-2">
                                    <a href="edit.php?id=<?php echo $row['id']?>&edit_btn=user"
                                     class="btn btn-light btn-sm" onclick="return confirm('are you sure ..?');"><i class="fa fa-pen"></i>Edit</a>
                                    
                                    
                                     <a href="delete_action.php?id=<?php echo $row['id']?>&delete_btn=user" 
                                    class="btn btn-light " onclick="return confirm('are you sure?');"style="background-color:#f57847;">
                                    <i class="fa fa-trash"></i></a>
                                    </td>
                                </td>
                                
                            </tr>
                            <?php
                                    }
                                } else {
                            ?>
                            <tr>
                                <td colspan="4" class="text-danger text-center">No record Found.</td>
                            </tr>
                            <?php  } ?>

                        </tbody>
           
   
                    </table>
                </div>
            </div>
        </div>
    </div>
 <script src="../assets/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript">
    </script>
</body>
</html>