<!-- logi form -->

<h1 style="text-align: center;">Login</h1> 
<form  method="post" action="login.php" id="login">

                 <div>
                   <label for="name">Name</label><br>
                   <input type="text" name="username"  placeholder="name" required="required" >
                 </div>
                 <div>
                   <label for="password">password</label><br>
                   <input type="password" name="password"  placeholder="password" required="required" >
                 </div>
                   <div> 
                   <input type="submit" name="submit"  value="login"  id="button">
                 </div>
                <p>No account?
                <a href="registration.php"style="color: #731d3d;">&nbsp;register</a></p>
                <p>
                  forgotten your <a href="recover.php?mode=username" style="color: #731d3d;">username</a> or <a href="recover.php?mode=password"style="color: #731d3d;"> password</a>
                </p>
</form>