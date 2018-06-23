<?php
    session_start();      
    
    if (array_key_exists("id", $_COOKIE) OR array_key_exists("id",$_SESSION)) {
        // $_SESSION["id"] = $_COOKIE["id"];

        if(!array_key_exists('valid',$_SESSION)){
            header("Location: dashboard.php");
        }
    } else {
        header ("Location: index.php");
    }
    
    $valid = $_SESSION['valid'];
    if ($valid == "1") {
        
        include("connect.php");

        $error = "";
        $alert="";

        $user_id=$_SESSION['id'];
        $first_name="";
        $last_name="";
        $user_role="";
        $partner_firstname="";
        $partner_lastname="";
        $partner_role="";
        $proposal_date="";
        $wedding_date="";
        $budget_range="";
        $guest_range="";

        if (array_key_exists("submit",$_POST) && isset($_POST["submit"])) {
            //first field set
            $first_name = mysqli_real_escape_string($link, $_POST["first_name"]);
            $last_name = mysqli_real_escape_string($link, $_POST["last_name"]);
            $user_role = mysqli_real_escape_string($link, $_POST["user_role"]);
            $partner_firstname = mysqli_real_escape_string($link, $_POST["partner_firstname"]);
            $partner_lastname = mysqli_real_escape_string($link, $_POST["partner_lastname"]);
            $partner_role = mysqli_real_escape_string($link, $_POST["partner_role"]);
            

            //Second fieldset
            $propasal_date = mysqli_real_escape_string($link, $_POST["engagement_date"]);
            
            //Third fieldset
            $wedding_date = mysqli_real_escape_string($link, $_POST["wedding_date"]);

            //Fourth fieldset
            $budget_range = mysqli_real_escape_string($link, $_POST["budget"]);
            $guest_range = mysqli_real_escape_string($link, $_POST["party_size"]);

            $check_query = "SELECT * FROM `account_details` WHERE user_id = '$user_id';";
            $result = mysqli_query($link, $check_query);

                if (mysqli_num_rows($result) == 0) {

                    $query = "INSERT INTO `account_details` VALUES ('$user_id','$first_name','$last_name','$user_role','$partner_firstname',
                            '$partner_lastname','$partner_role','$propasal_date','$wedding_date','$budget_range','$guest_range');";
                    
                    if(mysqli_query($link, $query)){
                        $query = "UPDATE `users` SET account_setup = 1 WHERE id='$user_id';";
                        
                        if (mysqli_query($link, $query)) {                    
                            $alert = "<p>Success</p>";
                            unset($_SESSION['valid']);
                            header("Location: dashboard.php");
                        }
                        else{
                            $error += "<p>There was an issue with the connection</p>";
                        }
                }

            }else{
                $error += "<p>There was an issue with the connection</p>";
            }
        }
    }
   
    
    
?>

<?php include('header.php') ?>
<body id="accbody">
    
    <div class="container-fluid mt-4">
        <h1 id= "header">WEDDING WIRE</h1>
    </div>

    <div class="container-fluid">
        <!-- MultiStep Form -->
        <div class="row">
            <div class="col-md-12 col-md-offset-3">
                <form method="post" id="msform">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active">Introduction</li>
                        <li>Engagement</li>
                        <li>Save the date</li>
                        <li>Time to party</li>
                    </ul>
                    <!-- fieldsets -->
                    <fieldset>
                        <h2 class="fs-title">Let's Introduce Ourselves!</h2>
                        <h3 class="fs-subtitle">Tell us something more about you</h3>
                        <div class="descriptive-text">Congratulations to</div> 
                        <input type="text" name="first_name" placeholder="First Name" required>
                        <input type="text" name="last_name" placeholder="Last Name" required>
                        <select name="user_role" id="user_role">
                            <option value="bride">Bride</option>
                            <option value="groom">Groom</option>                            
                        </select> 

                        <div class="descriptive-text">and</div> 

                        <input type="text" name="partner_firstname" placeholder="Finacè's first Name" required>
                        <input type="text" name="partner_lastname" placeholder="Finacè's last Name" required>
                        <select name="partner_role" id="partner_role">
                            <option value="groom">Groom</option>
                            <option value="bride">Bride</option>                            
                        </select> <br>

                        <div class="descriptive-text my-3">Eager to start planning with you</div>

                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">The Beginning</h2>
                        <h3 class="fs-subtitle">Start of the journey</h3>
                        
                        <div class="descriptive-text">When did you (or your partner) propose?</div>
                        <input type="date" name="engagement_date" id="engagement-date" required><br>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">The big day</h2>
                        <h3 class="fs-subtitle">Mark your calendars</h3>
                        
                        <div class="descriptive-text">When do you plan to have your wedding?</div>
                        <input type="date" name="wedding_date" id="wedding-date" required><br>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>                   
                    <fieldset>
                        <h2 class="fs-title">The big day</h2>
                        <h3 class="fs-subtitle">Call them all</h3>
                        <div class="descriptive-text">You are planning to spend</div>
                        <select name="budget" id="budget">
                            <option value="">Select</option>
                            <option value="below 500K">below 500K</option>
                            <option value="500K-800K">500K-800K</option>
                            <option value="800K-1M">800K-1M</option>
                            <option value="above 1M">above 1M</option>
                        </select>                        
                        <div class="descriptive-text">to celebrate your love with</div>
                       <select name="party_size" id="party_size">
                            <option value="">Select</option>
                            <option value="below 200">below 200</option>
                            <option value="200-300">200-300</option>
                            <option value="400-500">400-500</option>
                            <option value="above 500">above 500</option>
                        </select>                             
                        <div class="descriptive-text">of your family and friends.</div>
                        <br>                        
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="submit" name="submit" class="submit action-button" value="Submit"/>
                    </fieldset>
                </form>
                
            </div>
        </div>
    </div>
    
</body>
</html>