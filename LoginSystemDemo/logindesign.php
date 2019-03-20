<?php require_once('header.php'); ?>
 
    
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card bg-dark mt-5">
                    <div class="card-title bg-primary text-white mt-5">
                        <h3 class="text-center py-2">Login Form</h3>
                    </div>
 
                    <?php
                    
                        if(isset($_GET['empty']))
                        {
                            $Message=$_GET['empty'];
                            $Message= " Please Fill in the Blanks";
                    ?>
                        <div class="alert alert-danger text-center"><?php echo $Message ?></div>                            
                    <?php                            
                        }
                    
                    ?>
 
 
                      <?php
                    
                        if(isset($_GET['U_Invalid']))
                        {
                            $Message=$_GET['U_Invalid'];
                            $Message= " Invalid User";
                    ?>
                        <div class="alert alert-danger text-center"><?php echo $Message ?></div>                            
                    <?php                            
                        }
                    
                    ?>
 
 
                        <?php
                    
                        if(isset($_GET['P_Invalid']))
                        {
                            $Message=$_GET['P_Invalid'];
                            $Message= " Invalid Password";
                    ?>
                        <div class="alert alert-danger text-center"><?php echo $Message ?></div>                            
                    <?php                            
                        }
                    
                    ?>
 
                    <div class="card-body">
 
                        <form action="includes/login.php" method="POST" >
                            <input type="text" name="UserName" placeholder="Enter User Name or Email" class="form-control my-2">
                            <input type="password" name="password" placeholder=" Enter Your Password" class="form-control mb-3">
                            <button class="btn btn-success" name="login" class="pt-3">Login</button>
                        </form>
 
                    </div>
                </div>
            </div>
        </div>
    </div>
 
<?php require_once('footer.php'); ?>
