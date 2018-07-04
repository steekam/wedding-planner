<?php
    session_start();


    /* Ensuring cookies and sessions are destroyed once user logs out */

    if (array_key_exists("logout",$_GET)) { 
        
         $helper = array_keys($_SESSION);
        foreach ($helper as $key){
            unset($_SESSION[$key]);
        }               
        setcookie("id","", time() - (86400 * 30), "/" );
        $_COOKIE["id"] = "";            
              
    }
    else if ( array_key_exists("id", $_SESSION) || (array_key_exists("id",$_COOKIE) AND $_COOKIE ) ) {
        header("Location: dashboard.php");
    }

?>

<?php include('header.php')?>

<body id="home-body">
    <div class="container-fluid" id="main-wrapper">
        <div id="cover"></div>
        <div class="top"><img id="up" src="assets/image/icons/up-arrow.png" alt="Top"></div>
        <nav class="navbar navbar-expand-xl sticky-top" id="main-nav">

            <div class="navbar-brand" id="title"><a href="index.php">WEDDING WIRE</a></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavBar">
                <div id="bars"><img src="assets/image/icons/menu.png" alt="Menu"></div>
            </button>

            <div class="collapse navbar-collapse" id="myNavBar">
                <!-- <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="cool-box">PLANNING TOOLS</div>
                    </li>
                    <li class="nav-item">
                        <div class="cool-box">REGISTRY</div>
                    </li>
                    <li class="nav-item">
                        <div class="cool-box">WEDDING WEBSITE</div>
                    </li>
                    <li class="nav-item">
                        <div class="cool-box">LOCAL VENDORS</div>
                    </li>
                    <li class="nav-item">
                        <div class="cool-box">GALLERY</div>
                    </li>                                  
                </ul> -->

                <div id="login-signup" >
                    <a href="signup.php"><button class="mybtn mybtn-outline-primary">SIGN UP</button></a>
                    <a href="login.php"><button class="mybtn mybtn-primary">LOGIN</button></a>
                </div>                
            </div>

        </nav>     
        
        <div id="cover-content">
            <div class="v-center">
                <h1>THE ONE STOP PLACE FOR ALL YOUR BIG DAY PLANS</h1>
                <hr class="divide">
                <p>Really excited, let me show you what we can do</p>
                <span>
                    <img class="animated infinite rubberBand center" id="down-arrow" src="assets/image/icons/thin-arrowheads-pointing-down.png" alt="Find out more">
                </span>
            </div>            
        </div>

    </div>

    <div id="main-content">
        <div class="services-wrapper">
           <h3 class="section-title">PLANNING TOOLS JUST FOR YOU</h3>
           <hr class="divide">

           <div class="row px-5" style="margin-top:100px;">
                <div class="mycard card col-md-4">
                    <center>
                        <div class="card-image"><img src="assets/image/icons/checklist.png" alt="checklist"></div>
                    </center>
                    <div class="card-body">
                        <div class="card-title" style="color:#997878">Checklist</div>
                        <p class="card-text">The ultimate way to make sure you do everything on time.Never forgeting anything</p>                        
                    </div>                    
                </div>  
                
                <div class="mycard card col-md-4">
                    <center>
                        <div class="card-image"><img src="assets/image/icons/money.png" alt="budgeter"></div>
                    </center>
                    <div class="card-body">
                        <div class="card-title" style="color: #94DCBC;">Budgeter</div>
                        <p class="card-text">Keep track of your spending, making sure you stay within your comfortable budget</p>
                    </div>                    
                </div>

                <div class="mycard card col-md-4">
                    <center>
                        <div class="card-image"><img src="assets/image/icons/wedding-rings.png" alt="wedding vision"></div>
                    </center>
                    <div class="card-body">
                        <div class="card-title" style="color: #F3CBBD;">Wedding Vision</div>
                        <p class="card-text">Define your wedding style and get matched with local vendors matching your needs</p>
                    </div>
                    
                </div>
            </div>

            <div class="row px-5">
                <div class="mycard card col-md-4">
                    <center>
                        <div class="card-image"><img src="assets/image/icons/gift.png" alt="Registry"></div>
                    </center>
                    <div class="card-body">
                        <div class="card-title" style="color: #C99381">Registry</div>
                        <p class="card-text">Your retails, cash, experience and charity registry all in one place. Guests can access them easily</p>
                    </div>                    
                </div>

                <div class="mycard card col-md-4">
                    <center>
                        <div class="card-image"><img src="assets/image/icons/message.png" alt="Guest list"></div>
                    </center>
                    <div class="card-body">
                        <div class="card-title" style="color: #6A301B">Guest List</div>
                        <p class="card-text">Gather addresses, keep track of RSVPs take care of thank you notes and more</p>
                    </div>                    
                </div>

                <div class="mycard card col-md-4">
                    <center>
                        <div class="card-image"><img src="assets/image/icons/clock.png" alt="timeline"></div>
                    </center>
                    <div class="card-body">
                        <div class="card-title" style="color: #B6A39D;">Wedding Day Timeline</div>
                        <p class="card-text">The who, what, where and when of your wedding day planned to the last second in one timeline</p>
                    </div>                    
                </div>
           </div>

           <hr class="divide mt-5" style="width: 95%;">

           <div id="theCloser" class="animated fadeInLeft">
                <div class="center">
                    <h3>Wedding Planning Has Never Been Easier</h3>
                    <div id="closerTagline" class="center">Sign up to Wedding Wire and get access to your one stop place wedding planner</div>
                    <a href="signup.php"><button class="mybtn mybtn-primary" style="width: 200px;">Sign Up Now For Free</button></a>
                </div>
           </div>
        </div>
        <hr class="divide" style="width: 90%;">
        
        <div class="slider-wrapper">
            <div>
                <h3 class="section-title">We Just Want You To Take It Easy</h3>
                <hr class="divide">

                <div id="slider">
                </div>
            </div>
        </div>
        
    </div> 

    <footer>
        <h3 class="section-title center">Connect With Us</h3>
        <hr class="divide">
        <div class="row center" id="social-icons">
            <div id="twitter-logo"><img src="assets/image/social/twitter-logo-button.png" alt="twitter"></div>
            <div id="facebook-logo"><img src="assets/image/social/facebook-logo-button.png" alt="facebook"></div>
            <div id="pinterest-logo"><img src="assets/image/social/pinterest.png" alt="pinterest"></div>
            <div id="instagram-logo"><img src="assets/image/social/instagram-logo.png" alt="instagram"></div>
        </div>
        <center id="copyright">&copy 2018</center>
    </footer>
    
    
</body>
</html>