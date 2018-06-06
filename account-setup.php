<?php include('header.php') ?>
<body id="accbody">
    <div class="container-fluid mt-4">
        <h1 id= "header">WEDDING WIRE</h1>
    </div>

    <div class="container-fluid">
        <!-- MultiStep Form -->
        <div class="row">
            <div class="col-md-12 col-md-offset-3">
                <form id="msform">
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
                        <select name="role1" id="first_role">
                            <option value="bride">Bride</option>
                            <option value="groom">Groom</option>                            
                        </select> 

                        <div class="descriptive-text">and</div> 

                        <input type="text" name="other_first_name" placeholder="Finacè's first Name" required>
                        <input type="text" name="other_last_name" placeholder="Finacè's last Name" required>
                        <select name="role2" id="second_role">
                            <option value="bride">Groom</option>
                            <option value="groom">Bride</option>                            
                        </select> <br>

                        <div class="descriptive-text my-3">Eager to start planning with you</div>

                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">The Beginning</h2>
                        <h3 class="fs-subtitle">Start of the journey</h3>
                        
                        <div class="descriptive-text">When did you (or your partner) propose?</div>
                        <input type="date" name="engagement-date" id="engagement-date" required><br>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">The big day</h2>
                        <h3 class="fs-subtitle">Mark your calendars</h3>
                        
                        <div class="descriptive-text">When do you plan to have your wedding?</div>
                        <input type="date" name="wedding-date" id="wedding-date" required><br>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>                   
                    <fieldset>
                        <h2 class="fs-title">The big day</h2>
                        <h3 class="fs-subtitle">Call them all</h3>
                        <div class="descriptive-text">You are planning to spend</div>
                        <select name="budget" id="budget">
                            <option value="">Select</option>
                            <option value="">below 500K</option>
                            <option value="">500K-800K</option>
                            <option value="">800K-1M</option>
                            <option value="">above 1M</option>
                        </select>                        
                        <div class="descriptive-text">to celebrate your love with</div>
                       <select name="party-size" id="party-size">
                            <option value="">Select</option>
                            <option value="">below 200</option>
                            <option value="">200-300</option>
                            <option value="">400-500</option>
                            <option value="">above 500</option>
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