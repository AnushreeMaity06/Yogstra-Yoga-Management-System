 <?php
    global $conn;
    include('../db_connect.php');
    $blog_query = mysqli_query($conn, "SELECT * FROM `blogs` ORDER BY id desc LIMIT 4");
    ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>blogs</title>


     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
     <link rel="stylesheet"
         href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <!-- <style>
         body {
             background: #f5efeb;
             font-family: 'Poppins', sans-serif;
         }

         .main-card {
             background: #f4f4f4;
             border-radius: 35px;
             padding: 20px;
         }

         .page-title {
             font-size: 30px;
             font-weight: bold;
             color: #ba6a4a;
         }

         .add-btn {
             background: #ba6a4a;
             color: white;
             border: none;
             padding: 10px 18px;
             border-radius: 10px;
             transition: .3s;
             text-decoration: none;
             font-weight: 600;
         }

         .add-btn:hover {
             background: #aa623f;
             color: white;
         }

         .journal-title {
             font-size: 2rem;
             font-weight: 700;
             color: #2d2522;
         }

         .explore-link {
             color: #c27b5d;
             text-decoration: none;
             font-weight: 600;
         }

         .explore-link:hover {
             color: #a85f43;
         }

         .blog-card {
             background: white;
             padding: 15px;
             border-radius: 20px;
             transition: .3s;
             height: 100%;
         }

         .blog-card:hover {
             transform: translateY(-5px);
         }

         .card-img-container {
             overflow: hidden;
             border-radius: 18px;
         }

         .card-img-container img {
             width: 100%;
             height: 160px;
             object-fit: cover;
             transition: .5s;
         }

         .blog-card:hover img {
             transform: scale(1.05);
         }

         .category-tag {
             color: #c06d4d;
             font-size: 12px;
             font-weight: 700;
             letter-spacing: 1px;
             text-transform: uppercase;
         }

         .read-time {
             color: #777;
             font-size: 13px;
         }

         .card-title-custom {
             margin-top: 10px;
             color: #2d2522;
             font-size: 18px;
             line-height: 1.3;
             font-weight: 600;
         }

         .card-desc {
             color: #6f6f6f;
             font-size: 14px;
             line-height: 1.5;
             margin-top: 10px;
             margin-bottom: 10px;
         }

         .read-more-btn {
             text-decoration: none;
             color: #222;
             font-size: 14px;
             font-weight: 600;
             display: inline-block;
             margin-top: 8px;
             transition: .3s;
         }

         .read-more-btn:hover {
             color: #c06d4d;
         }

         @media(max-width:768px) {

             .journal-title {
                 font-size: 1.7rem;
             }

             .card-img-container img {
                 height: 180px;
             }

             .card-title-custom {
                 font-size: 16px;
             }

         }

         @media(max-width:576px) {

             .main-card {
                 padding: 15px;
             }

             .journal-title {
                 font-size: 1.5rem;
             }

             .card-img-container img {
                 height: 150px;
             }

             .card-title-custom {
                 font-size: 15px;
             }

             .card-desc {
                 font-size: 13px;
             }

         }
     </style> -->

     <style>
         body {
             background: #f5efeb;
             font-family: 'Poppins', sans-serif;
         }

         .main-card {
             background: #f4f4f4;
             border-radius: 35px;
             padding: 20px;
         }

         .page-title {
             font-size: 30px;
             font-weight: bold;
             color: #ba6a4a;
         }

         .add-btn {
             background: #ba6a4a;
             color: white;
             border: none;
             padding: 10px 18px;
             border-radius: 10px;
             transition: .3s;
             text-decoration: none;
             font-weight: 600;
         }

         .add-btn:hover {
             background: #aa623f;
             color: white;
         }

         .journal-title {
             font-size: 2rem;
             font-weight: 700;
             color: #2d2522;
         }

         .explore-link {
             color: #c27b5d;
             text-decoration: none;
             font-weight: 600;
         }

         .explore-link:hover {
             color: #a85f43;
         }

         .blog-card {
             background: white;
             padding: 15px;
             border-radius: 20px;
             display: flex;
             flex-direction: column;
             height: 500px;
             width: 100%;
             transition: .3s;
         }

         .blog-card:hover {
             transform: translateY(-5px);
         }

         .card-img-container {
             width: 100%;
             height: 220px;
             overflow: hidden;
             border-radius: 18px;
         }

         .card-img-container img {
             width: 100%;
             height: 180px;
             object-fit: cover;
             transition: .5s;
         }

         .blog-card:hover img {
             transform: scale(1.05);
         }



         .blog-content {
             display: flex;
             flex-direction: column;
             justify-content: space-between;
             flex-grow: 1;
         }

         .category-tag {
             color: #c06d4d;
             font-size: 12px;
             font-weight: 700;
             letter-spacing: 1px;
             text-transform: uppercase;
         }

         .read-time {
             color: #777;
             font-size: 13px;
         }

         .card-title-custom {
             margin-top: 10px;
             color: #2d2522;
             font-size: 18px;
             line-height: 1.4;
             font-weight: 600;
         }

         .card-desc {
             color: #6f6f6f;
             font-size: 14px;
             line-height: 1.6;
             margin-top: 10px;

             display: -webkit-box;

             -webkit-box-orient: vertical;
             overflow: hidden;
         }

         .read-more-btn {
             text-decoration: none;
             color: #222;
             font-size: 16px;
             font-weight: 600;
             margin-top: auto;
             transition: .3s;
         }

         .read-more-btn:hover {
             color: #c06d4d;
         }

         .edit-btn,
.delete-btn{
    padding: 4px 8px;
    font-size: 12px;
    border-radius: 5px;
    text-decoration: none;
}

         .edit-btn {
             background: #ffffff;
             color: #ba6a4a;
             border: 2px solid #ba6a4a;
             border-radius: 8px;
             
             text-decoration: none;
             transition: 0.3s;
             font-weight: 600;
             margin-right: 5px;
             display: inline-block;
         }

         .edit-btn:hover {
             background: #ba6a4a;
             color: white;
             transform: translateY(-2px);
         }

         .delete-btn {
             background: #ba6a4a;
             color: white;
             border-radius: 8px;
    
             text-decoration: none;
             transition: 0.3s;
             font-weight: 600;
             border: none;
             display: inline-block;
         }

         .delete-btn:hover {
             background: #dc3545;
             color: white;
             transform: translateY(-2px);
         }


         @media(max-width:768px) {

             .journal-title {
                 font-size: 1.7rem;
             }

             .card-img-container img {
                 height: 160px;
             }

             .card-title-custom {
                 font-size: 16px;
             }
         }

         @media(max-width:576px) {

             .main-card {
                 padding: 15px;
             }

             .journal-title {
                 font-size: 1.5rem;
             }

             .card-img-container img {
                 height: 150px;
             }

             .card-title-custom {
                 font-size: 15px;
             }

             .card-desc {
                 font-size: 13px;
             }
         }

         .blog-scroll {
             display: flex;
             gap: 20px;
             overflow-x: auto;
             scrollbar-width: none;
             scroll-behavior: smooth;
         }

         .blog-scroll::-webkit-scrollbar {
             display: none;
         }

         .blog-item {
             width: 320px;
             flex-shrink: 0;
         }
     </style>
 </head>

 <body style="background-color: #ba6a4a;">
     <div class="container-fluid">
         <div class="row">
             <!-- Sidebar -->
             <div class="col-md-2 ">
                 <?php include('sidebar.php'); ?>
             </div>





             <div class="col-md-10 py-2 px-2">

                 <div class="main-card">

                     <div class="d-flex justify-content-between align-items-center flex-wrap mb-5">

                         <h1 class="page-title">
                             <i class="bi bi-journal-richtext"></i>
                             All Blogs
                         </h1>

                         <a href="add_blogs.php" class="add-btn">
                             <i class="fa fa-plus"></i>
                             Add Blog
                         </a>

                     </div>
                     <header class="d-flex justify-content-between align-items-center mb-5">
                         <h1 class="journal-title h2 m-0">The Wellness Journal</h1>

                         <a href="#" class="explore-link">Explore All Insights</a>
                     </header>

                     <main class="blog-scroll">

                         <?php

                            while ($row = mysqli_fetch_assoc($blog_query)) {

                            ?>
                             <div class="blog-item">
                                 <article class="blog-card">
                                     <div class="card-img-container mb-3">
                                         <img src="../uploads/blog_image/<?php echo $row['image'] ?>" alt="<?php echo $row['title'] ?>">
                                     </div>

                                     <div class="blog-content">

                                         <div>
                                             <span class="category-tag">
                                                 <?php echo $row['category'] ?>
                                             </span>

                                             <span class="read-time">
                                                 &nbsp;&bull;&nbsp;
                                                 <?php echo $row['read_time'] ?>
                                             </span>

                                             <h2 class="card-title-custom">
                                                 <?php echo substr($row['title'], 0, 25) . '....' ?>
                                             </h2>

                                             <p class="card-desc">
                                                 <?php echo substr($row['description'], 0, 50) . '....'; ?>
                                             </p>
                                         </div>

                                         <!-- <a href="blog_details.php?id=<?php echo $row['id']; ?>" class="read-more-btn">
                                             Read More
                                             <i class="bi bi-box-arrow-up-right"></i>
                                         </a> -->

                                         <div class="mt-3 d-flex align-items-center">

                                             <a href="blog_details.php?id=<?php echo $row['id']; ?>" class="read-more-btn">
                                                 Read More
                                                 <i class="bi bi-box-arrow-up-right"></i>
                                             </a>

                                             <div class="ms-auto d-flex gap-2">
                                                 <a href="edit_blog.php?id=<?php echo $row['id']; ?>" class="edit-btn">
                                                     <i class="fa fa-pen"></i> Edit
                                                 </a>

                                                 <a href="blogdelete_action.php?id=<?php echo $row['id']; ?>"
                                                     onclick="return confirm('Are you sure to delete this class?');"
                                                     class="delete-btn">
                                                     <i class="fa fa-trash"></i>
                                                 </a>
                                             </div>

                                         </div>

                                     </div>
                                 </article>
                             </div>

                         <?php } ?>
                     </main>
                 </div>
             </div>
         </div>

 </body>

 </html>