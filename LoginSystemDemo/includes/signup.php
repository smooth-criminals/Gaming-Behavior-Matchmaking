<?php 
 
    require_once('connection.php');
 
    if(isset($_POST['signup']))
    {
 
        if(empty($_POST['FName']) || empty($_POST['LName']) || empty($_POST['Email']) || empty($_POST['UserName']) || empty($_POST['password']))
        {
            header("location: ../signupdesign.php?empty");
        }
        else
        {
            $FName=mysqli_real_escape_string($con,$_POST['FName']);
            $LName=mysqli_real_escape_string($con,$_POST['LName']);
            $Email=mysqli_real_escape_string($con,$_POST['Email']);
            $UserName=mysqli_real_escape_string($con,$_POST['UserName']);
            $Password=mysqli_real_escape_string($con,$_POST['password']);
 
            if(!preg_match("/^[a-zA-Z]*$/",$FName) || !preg_match("/^[a-zA-Z]*$/",$LName))
            {
                header("location: ../signupdesign.php?Invalid");
                exit();
            }
            else
            {
                if(!filter_var($Email,FILTER_VALIDATE_EMAIL))
                {
                    header("location: ../signupdesign.php?VEmail");
                    exit();
                }
                else
                {
                    $query = " select * from userlogin where UserName='".$UserName."'";
                    $result = mysqli_query($con,$query);
 
                    if(mysqli_fetch_assoc($result))
                    {
                        header("location: ../signupdesign.php?User");
                        exit();
                    }
                    else
                    {
                        $query = " select * from userlogin where Email='".$Email."'";
                        $result = mysqli_query($con,$query);
 
                        if(mysqli_fetch_assoc($result))
                        {
                            header("location: ../signupdesign.php?Email");
                            exit();
                        }
                        else
                        {
                            $Hash = password_hash($Password, PASSWORD_DEFAULT);
                            $query = " insert into userlogin (FName,LName,Email,UserName,Password) values ('$FName', '$LName', '$Email', '$UserName','$Hash')";
                            $result = mysqli_query($con,$query);
                            header("location: ../signupdesign.php?success");
                            exit();                                
                            
                        }
                    }
                }
            }
        }
 
    }
    else
    {
        header("location: ../index.php");
        exit();
    }
 
?>