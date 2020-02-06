<!DOCTYPE html>
<?php
    session_start();
    include("includes/connection.php");   
    include("functions/function.php");
?>
<?php
if(!isset($_SESSION['user_email'])){
    header("location: index.php");
}
else{?>
<html>
    <head>
        <title>Welcome</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel ="stylesheet" type="text/css" href = "styles/home_style.css">
    </head>
    <body>

        <div class = "container">
            <div id= "head_wrap">
                <div id= "header">
                    <ul  id = "menu">
                    <nav>
            <a href="home.php">
            <i class="fas fa-home"></i>
            </a>

            <a href="#">
            <i class="far fa-envelope"></i>
            </a>

            <a href="#">
            <i class="fas fa-bell"></i>
            </a>
            <a href="#">
            <i class="fas fa-users"></i>
            </a>
                    </ul>
                    <form id = "search_bar" method="post" action="results.php">
                        <input type= "text" name = "search_item" placeholder ="search">
                        <input type= "submit" name = "search" value= "search">

                    </form>
                </div>
            </div>
            <div class= "body_content">
                <div id= "user_timeline">
                    <div id = "user_detail">
                    <?php
                           $user = $_SESSION['user_email']; 
                            $get_user = "SELECT * FROM profile WHERE user_email = '$user'";
                            $run_user = mysqli_query($con,$get_user);
                            $row = mysqli_fetch_array($run_user);
                            $user_id= $row['user_id'];
                            $user_name= $row['user_fname'];
                            $user_password = $row['user_password'];
                            $user_email = $row['user_email'];
                            $user_street = $row['user_street'];
                            $user_city = $row['user_city'];
                            $user_state = $row['user_state'];
                            $user_country = $row['user_country'];
                            $user_dob = $row['user_dob'];
                            $user_dbpost = $row['user_posts'];
                            $user_status = $row['user_status'];
                            $user_phone = $row['user_phone'];
                            $user_zip = $row['user_zip'];
                            $user_lname= $row['user_lname'];
                            $user_regDate = $row['registration_date'];
                            $user_image = $row['profile_picture'];
                            $user_gender = $row['user_gender'];
                            $user_pic = $row['profile_picture'];

                             $page = $_GET['p_id']; 
                            $get_page= "SELECT * FROM page WHERE page_id = '$page'";
                            $run_page= mysqli_query($con,$get_page);
                            $row_page = mysqli_fetch_array($run_page);
                            $page_id= $row_page['page_id'];
                            $page_name= $row_page['page_name'];
                            $page_dis= $row_page['page_description'];
                            $page_cat= $row_page['page_category'];
                            $page_admin= $row_page['page_admin'];
                            $page_crt= $row_page['profile_date'];
                            $page_image= $row_page['page_pic'];
                            echo "
                            <centre>
                                <img src ='users/$page_image' width='200'/>
                                </centre>
                                <div id='page_mention'>
                                <p><centre><h2>$page_name</h2></centre>                                
                                <p>Administrator: $page_admin</a></p>
                                <p>Description: $page_dis</a></p>
                                <p>Category: $page_cat</a></p>
                                <p>Created on: $page_crt</a></p>
                                <p><a href= 'edit_page.php?page_id=$page_id'>Edit my Page</a></p>

                               </div>


                            ";
                        ?>

                    </div>
                </div>                 
                <div id = "content_timeline">
                    <form method= 'post' id='edit' class='editedit' enctype = "multipart/form-data"> 
                    <table>
                        <tr align= "center">
                            <td colspan= "6">
                                <h2>Edit your Profie</h2>
                            </td>                        
                        </tr>
                        <tr>
                            <td align="right">Page Name: </td>
                            <td>
                                <input type="text" name = "p_name" required ="required" value= "<?php echo $page_name ; ?>" />
                            </td> 
                        </tr>

                        <tr>
                            <td align="right">Page Description: </td>
                            <td>
                                <input type="text" name = "p_dis" required ="required" value= "<?php echo $page_dis ; ?>" />
                            </td> 
                        </tr>

                        <tr>
                            <td align="right">Page Category: </td>
                            <td>
                                <input type="text" name = "p_cat" required ="required" value= "<?php echo $page_cat ; ?>" />
                            </td> 
                        </tr>


                        <tr align="center">
                            <td colspan="6">
                                <input style="width:100px;" type ="submit" name = "update" value="Update">
                            </td>
                            

                        
                    </table>                    
                    </form>
                    <?php
                        if(isset($_POST['update']))
                        {
                            $new_name = $_POST['p_name'];
                            $new_dis = $_POST['p_dis'];
                            $new_cat = $_POST['p_cat']; 
                            
                            
                            $update_query = "update page set page_name= '$new_name',
                                                                page_description = '$new_dis',
                                                                page_category ='$new_cat'
                                                                where page_id = '$page_id'
                                                                ";
                            $query = mysqli_query($con, $update_query);
                            if($query)
                            {
                                echo "<script>alert('Information updated successfully.'); </script>";
                                //$pageId=$_SESSION('$page_id');
                                echo "<script>window.open('view_page.php','_self'); </script>";

                            }
                            else{
                                echo "<script>alert('Error occured!!! Please try again !!!'); </script>";

                            }

                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </body>
</html>
<?php } ?>