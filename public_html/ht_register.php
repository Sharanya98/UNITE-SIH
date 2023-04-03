<!doctype html>
<?php session_start()?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>UNITE</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script src="https://www.gstatic.com/firebasejs/5.8.4/firebase.js"></script>
  <script>
    // Initialize Firebase
    var config = {
      apiKey: "AIzaSyB7eMSgIpE1odDzDaoWtpkLig7G1iEHvMk",
      authDomain: "unites-d8943.firebaseapp.com",
      databaseURL: "https://unites-d8943.firebaseio.com",
      projectId: "unites-d8943",
      storageBucket: "unites-d8943.appspot.com",
      messagingSenderId: "360054808163"
    };
    firebase.initializeApp(config);
  </script>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/nivo-slider/css/nivo-slider.css" rel="stylesheet">
  <link href="lib/owlcarousel/owl.carousel.css" rel="stylesheet">
  <link href="lib/owlcarousel/owl.transitions.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/venobox/venobox.css" rel="stylesheet">

  <!-- Nivo Slider Theme -->
  <link href="css/nivo-slider-theme.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
<!-- ICONS -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <!-- Responsive Stylesheet File -->
  <link href="css/responsive.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/creg.css">



  
 
</head>
<style>
img {
  border-radius: 50%;
}
</style>

<body data-spy="scroll" data-target="#navbar-example">

  <div id="preloader"></div>

 



  <script>
    $(document).ready(function() { 
      console.log("hiii");
        firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
                var get_me = $.post("apis/isThere.php", {uid:user.uid});
                get_me.done(function(me_data){
                    
                        var me_dataJson = JSON.parse(me_data);
                      //  console.log(me_dataJson[0]);
                        if(me_dataJson.length > 0){
                            var startSessionReq = $.post("apis/startSession.php",{uid:user.uid,org_name:me_dataJson[0].org_name, email_id:me_dataJson[0].email_id, type:me_dataJson[0].type});
                        startSessionReq.done(function(session_res){
                             console.log(session_res);
                             
                           if(session_res == "200"){
                               if(me_dataJson[0].type==1){
                                  window.location = "startup_home.php";
                               }
                               else{
                                   window.location = "coprate_home.php";
                               }
                           }
                           else{
                               alert("An error occured.. :(");
                           }
                        });
                        }
                    else{
                        document.getElementById("main_div").style.display = "block";
                        console.log(user);
                        if(user.photoURL != null){
                            document.getElementById("me_img").src = user.photoURL;
                        }
                        else{
                            document.getElementById("me_img").src = "img/profile.png";
                        }
                         document.getElementById("rep_name").value = user.displayName;
                         document.getElementById("rep_eid").value = user.email;
                         document.getElementById("rep_mobno").value = user.phoneNumber;
                    }
                    
                });
            }

               
         });
    });

     function NewUser(){
        $("#contact").submit(function(event) {         
              /* stop form from submitting normally */
        event.preventDefault();   
        firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
                var rep_name = document.getElementById("rep_name").value;
                var rep_eid = document.getElementById("rep_eid").value;
                var rep_mobno = document.getElementById("rep_mobno").value;
                var org_name = document.getElementById("org_name").value;
                var org_employee_count = document.getElementById("org_employee_count").value;
                var org_tech_domain = document.getElementById("org_tech_domain").value;
                var org_revenue = document.getElementById("org_revenue").value;
                var org_address = document.getElementById("org_address").value;
                var org_type = document.getElementById("org_type").value;
                var org_status = document.getElementById("org_status").value;
                var newUserReq = $.post("apis/newUser.php",{uid: user.uid, rep_name:rep_name, rep_eid: rep_eid, rep_mobno: rep_mobno, org_name: org_name, org_type: org_type, org_status: org_status, org_tech_domain: org_tech_domain, org_employee_count: org_employee_count, org_revenue:org_revenue, org_address: org_address});
                newUserReq.done(function(newUserRes){
                    console.log(newUserRes);
                   
                        var startSessionReq = $.post("apis/startSession.php",{uid:user.uid,org_name:org_name, email_id:rep_eid, type:org_type});
                        startSessionReq.done(function(session_res){
                          if(session_res == "200"){
                              if(org_type==1){
                                  window.location = "startup_home.php";
                              }
                              else{
                                  window.location = "coprate_home.php";
                              }
                          }
                          else{
                              alert("An error occured.. :(");
                          }
                        });
                    
                });
            }
        });
        });
     } 
        
    
  </script>

  <div id="main_div" style="display:none" class="about-area area-padding" style="margin-top: 15%; padding:50px">
    
       
                
                
                   
            <form id="contact">
    
    <div class="container">
                <h2>Registration</h2>
                 <div class="row" style="margin-top: 3%">
                  <div class="col-md-12" style="width:100%; padding-left: 28%;  padding-bottom:5%;">
                              <img style="width:150px; height: 150px" id="me_img">
                    </div>
                
    
    <fieldset>
      <input placeholder="Name" type="text" tabindex="1" required autofocus id="rep_name" required>
    </fieldset>
    <fieldset>
      <input placeholder="Email Address" type="email" tabindex="2" id="rep_eid" required>
    </fieldset>
    <fieldset>
      <input placeholder="Phone Number" type="tel" tabindex="3" id="rep_mobno" required>
    </fieldset>
    <h4>Organizational Details</h4>
    <fieldset>
      <input placeholder="Organization Name" type="oname" tabindex="4" id="org_name" required>
      </fieldset>
      <fieldset>
      <textarea placeholder="Organization Details" tabindex="5" required id="org_desc"></textarea>
    </fieldset>
      <fieldset>
      <select class="text" id="org_type" type="otype"required>
            <option value="" disabled selected><h4>Organization Type</h4></option>
            <option value="1"><h4>Start-UP</h4></option>
            <option value="2"><h4>Corporate</h4></option>
      </select>
      </fieldset>
          <fieldset>
      <select  class="text" id="org_status" type="ostatus"required required>
                                         <option value="" disabled selected>Organization Status</option>
                                         <option value="Active">Active</option>
                                         <option value="Dormant">Dormant</option>
                                         <option value="Active in Progress">Active in Progress</option>
                                         <option value="Under liquidation">Under liquidation</option>
                                         <option value="Under process of Striking Off">Under process of Striking Off</option>
                                         <option value="Closed">Closed</option>
      </select>
      </fieldset>
      <fieldset>
        <input placeholder="Tech Domain" type="TDomain" tabindex="4" id="org_tech_domain" required>
      </fieldset>
      <fieldset>
        <input placeholder="Employee Count" type="Ecount" tabindex="4" id="org_employee_count" required>
      </fieldset>
      <fieldset>
        <input placeholder="Latest Revenue(INR)" type="Revenue" tabindex="4" id="org_revenue" required>
      </fieldset>
      

     <fieldset>
      <textarea placeholder="Organization Address" tabindex="5" required id="org_address"></textarea>
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending" onclick="NewUser()">Submit</button>
    </fieldset>
    
  </form>
        </div>
        
  </div>







  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/venobox/venobox.min.js"></script>
  <script src="lib/knob/jquery.knob.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/parallax/parallax.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/nivo-slider/js/jquery.nivo.slider.js" type="text/javascript"></script>
  <script src="lib/appear/jquery.appear.js"></script>
  <script src="lib/isotope/isotope.pkgd.min.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <script src="js/main.js"></script>
</body>

</html>