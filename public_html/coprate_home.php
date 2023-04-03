<?php session_start();
if($_SESSION["uid"] == null || $_SESSION["type"]!=2)
{
header('Location:index.html');
}

?>
<html lang="en">
  <style>


input[type="date"]:not(.has-value):before{
  color: lightgray;
  content: attr(placeholder);
}

.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 28px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(18px);
  -ms-transform: translateX(18px);
  transform: translateX(18px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
  
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  text-decoration: none;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  
}

.button1 {
  background-color: #F7F7F7; 
  color: black; 
  border: 2px solid #F7F7F7;
}

.button1:hover {
  background-color: white;
  color: black;
}
  </style>
<head>
  <meta charset="utf-8">
  <title>UNITE</title>

  <!-- Firebase Libs -->
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


<!-- ajax framework -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

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

 
</head>

<body data-spy="scroll" data-target="#navbar-example">


<script>
 //Search Functions
    function Search_view(){
        var SearchHTML = '<div class="container" id="search_div" style="padding:2%"><div class="row" style="margin-top: 30px"> <div class="col-md-12" style="width:30%"> <h3 id="search_title"> Search! </h3> </div> <div class="col-md-12" style="width:10%; margin-left:60%; cursor:pointer" onclick="FilterView()">Set Filter</div></div> <div class="row" style="margin-top: 3px">  <div class="col-md-12">   <input class="form-control" type="text" placeholder="Search with Organization Name: " onkeyup="Search_Fun(this)" id="search_bar">      </div>    </div>    </div> <div class="container" id="search_result_container"></div>';
        document.getElementById('main_div').innerHTML = SearchHTML;
    }
    function FilterView(){
      $('#FilterModal').modal();
    }


    function Search_Fun(ip_box){
      document.getElementById('search_result_container').innerHTML = "";
              
        var org_name = ip_box.value;
        var flt_tech_domain = document.getElementById('flt_tech_domain').value;
        var flt_org_status = document.getElementById("flt_org_status").value;
        var flt_org_type = document.getElementById("flt_org_type").value;
        if(flt_tech_domain!="" || flt_org_status!="" || flt_org_type!=""){
          document.getElementById("search_title").innerText = "Search! (With Filters)"
        }
        else{
          document.getElementById("search_title").innerText = "Search!";
        }
        
        var search_req = $.post("apis/orgSearch.php", {org_name: org_name, org_type: flt_org_type, org_status:flt_org_status, tech_domain:flt_tech_domain});
        search_req.done(function(search_d){
           var search_data = JSON.parse(search_d);
            var i = 0;
            if(search_data.length > 0){
             // console.log(search_data);
              document.getElementById('search_result_container').innerHTML = "";
              for(i = 0; i<search_data.length; i++){
                if(i>4){
                  break;
                }
               var OrgHTML = '<div class="row button button1" style="border-radius: 15px; padding: 15px; margin:15px;"> <div class="col-md-12" style="text-align:left; width:45%" id="OrgName'+i+'"></div><div id="Orgid'+i+'" style="display:none;"></div><div class="col-md-12" style="width:15%;cursor: pointer; text-align: right; text-decoration: underline; color: #497B19" onclick="ViewProfile('+i+')">View Profile</div> <div class="col-md-12" style="width:15%; margin-left:18%;cursor: pointer; text-align: right; text-decoration: underline; color: #497B19" onclick="FindMatch('+i+')">Find Match</div></div>';
                 document.getElementById('search_result_container').innerHTML += OrgHTML;
                document.getElementById('Orgid'+i).innerText = search_data[i].uid;
                document.getElementById('OrgName'+i).innerText = "Company Name: "+search_data[i].org_name;
              }
            }
        })
    }

    function FindMatch(index){

        var uid = document.getElementById('Orgid'+index).innerText;
        var him_req = $.post("apis/isThere.php",{uid:uid});



        him_req.done(function(him_dat){
          var him_data = JSON.parse(him_dat);
          var me_uid = '<?php echo $_SESSION["uid"]?>';
          var me_req = $.post("apis/isThere.php",{uid: me_uid});
          me_req.done(function(me_dat){
            var me_data = JSON.parse(me_dat);
            $("#MatchModal").modal();
            var domain_me = me_data[0].tech_domain.split(",");
                        var him_domain = him_data[0].tech_domain.split(",");
                        var domain_similarity = (domain_me.diff(him_domain).length);           
                        var greater_domaincount = 0;
                      
            if(!uid.localeCompare(me_uid) == 0){
                          var match_index = 0.0;
                        var iftype = false;
                        var ifcstatus = false;
                      // console.log(him_data[0])
                        if(me_data[0].type == him_data[0].type){
                          match_index += 1;
                          iftype = true;
                        }
                        if(me_data[0].company_status.localeCompare(him_data[0].company_status) == 0){
                          match_index +=2;
                          ifcstatus = true;
                        }

                        
                        
                          if(him_data[0].tech_domain.split(",").length >= me_data[0].tech_domain.split(",").length){
                          greater_domaincount = him_data[0].tech_domain.split(",").length; 
                        }
                        else{
                          greater_domaincount = me_data[0].tech_domain.split(",").length;
                        }
                        var mid_factor = greater_domaincount * 0.5;
                        var low_lactor = greater_domaincount * 0.3;
                        var above_factor= greater_domaincount * 0.8;
                        if(0<domain_similarity>low_lactor){
                          match_index += 1;
                        }
                        else if(low_lactor<=domain_similarity>mid_factor){
                          match_index += 2;
                        }
                        else if(mid_factor <= domain_similarity>= above_factor){
                          match_index +=2.5;
                        }
                        else if(domain_similarity >= greater_domaincount){
                          match_index+=3;
                        }



                        if(me_data[0].type == 1){
                          if(me_data[0].revenue>=him_data[0].revenue){
                            if((me_data[0].revenue - him_data[0].revenue) <= 0.4 * me_data[0].revenue ){
                              match_index+=2;
                            }
                          }
                          else{
                            if((him_data[0].revenue - me_data[0].revenue) <= 0.4 * him_data[0].revenue ){
                              match_index+=2;
                            }
                          }

                          if(me_data[0].employee_count >= him_data[0].employee_count){
                            if((me_data[0].employee_count - him_data[0].employee_count) <= 0.4 * me_data[0].employee_count ){
                              match_index+=2;
                            }
                          }
                          else{
                            if((him_data[0].employee_count - me_data[0].employee_count) <= 0.4 * him_dat[0].employee_count ){
                              match_index+=2;
                            }
                          }
                        }
                        else{
                          if(me_data[0].revenue>=him_data[0].revenue){
                            if((me_data[0].revenue - him_data[0].revenue) <= 0.2 * me_data[0].revenue ){
                              match_index+=2;
                            }
                          }
                          else{
                            if((him_data[0].revenue - me_data[0].revenue) <= 0.2 * him_data[0].revenue ){
                              match_index+=2;
                            }
                          }

                          if(me_data[0].employee_count >= him_data[0].employee_count){
                            if((me_data[0].employee_count - him_data[0].employee_count) <= 0.2 * me_data[0].employee_count ){
                              match_index+=2;
                            }
                          }
                          else{
                            if((him_data[0].employee_count - me_data[0].employee_count) <= 0.2 * him_dat[0].employee_count ){
                              match_index+=2;
                            }
                          }
                        }
                        

                        if(ifcstatus){
                          body+=" Both organisations have same status which is "+me_data[0].company_status;
                        }                  
                            
                        
            }
            else{
              match_index = 10;
              iftype = true;
            }

            match_index = match_index *10;
            if(match_index == 100){
              document.getElementById('mm_title').innerText = "A Perfect Match! ["+match_index+"%]";
            }
            else{
              document.getElementById('mm_title').innerText = "Your matching is "+match_index+"% ..!";
            }

            if(domain_similarity!=0){
            var body = "You have a "+match_index+"% match with "+him_data[0].org_name+". You have "+domain_similarity+" similar domains as them, which are"; 
            
            var x = 0;
            var temp = domain_me.diff(him_domain);
            for(x = 0; x<domain_similarity; x++){
              if(x==domain_similarity-1){
                body= body+" "+temp[x]+".";
              }
              else{
                body= body+" "+temp[x]+",";
              }
            
            }
            body+"."
            }
            else{
              var body = "You have a "+match_index+"% match with "+him_data[0].org_name+". You have NO similar domains as them."; 
            
            }

            if(iftype){
              body += " Both the organizations are of the same type which is ";
              if(me_data[0].type == 1){
                body +=" Startup."
              }
              else{
                body +=" Corporate."
              }
            }

            document.getElementById('mm_body').innerText = body;   
            
          });          
        });
        
    }



    Array.prototype.diff = function(arr2) {
    var ret = [];
    for(var i in this) {   
        if(arr2.indexOf(this[i]) > -1){
            ret.push(this[i]);
        }
    }
    return ret;
    };

   function ViewProfile(index){
      var uid = document.getElementById('Orgid'+index).innerText;
        var him_req = $.post("apis/isThere.php",{uid:uid});
        him_req.done(function(him_dat){
          var him_data = JSON.parse(him_dat);
         // console.log("/profile/index.php?uid="+him_data[0].uid);
          document.location = "/profile/index.php?uid="+him_data[0].uid;
        });
    }

    function Flt_Clear(){
      document.getElementById("flt_org_type").value = "";
      document.getElementById("flt_org_status").value = "";
      document.getElementById('flt_tech_domain').value = "";
    }
    //End Of Search Functions






    //Host functions


    function Host_view(){
      var uid = '<?php echo $_SESSION["uid"]?>';
      var EurekaHTML = '<div class="row" id="host_div" style="padding-top:30px"> <div class="row" id="eureka_null"><h3 style="padding-left:30%" id="host_title"> No Competition by you were found :( </h3><div class="tab" id="host_tabs" style="display:none">   <button class="tablinks"  style="width:50%" onclick="openActive(this)" id="openActive">Active</button>      <button class="tablinks" style="width:50%" id="openInactive" onclick="openInactive(this)">Inactive</button>           </div>  </div> <div class="row" id="host_holder"></div>  <div class="row" style="float: right; border-radius: 25px; margin: 20px;">  <div class="col-md-12" style="float: right;"> <button id="new_contest" style="border-radius: 50%; background-color: #9CBAC4; border: none; text-align: center; font-size: 30px; cursor: pointer; height: 56px; width: 56px;" onclick="Create_Contest()">+</button>  </div>  </div> </div>';
      document.getElementById('main_div').innerHTML = EurekaHTML;
      var myContestReq = $.post("apis/Contest.php", {type:"getmyConstest", uid:uid});
      myContestReq.done(function(myContestRes){
        var myContestArr = JSON.parse(myContestRes);
        if(myContestArr.length > 0){
          document.getElementById('host_title').style = "display:none";
          document.getElementById('host_tabs').style = "";
        }
      });
    }
    function Create_Contest(){
      $("#new_contest_modal").modal();

      document.getElementById('new_contest_submit').onclick = function(){
        var uid = '<?php echo $_SESSION["uid"]?>'
        var title = document.getElementById("T_name").value;
        var desc = document.getElementById('T_desc').value;
        var rules = document.getElementById('T_rule').value;
        var level = document.getElementById('T_level').value;
        var reward = document.getElementById('T_rew').value;

        var newContestReq = $.post("apis/Contest.php",{type:"newContest", uid:uid, title: title, desc: desc, rules:rules, level:level, reward:reward, status:status});
        newContestReq.done(function(data_newContest){
          if(data_newContest == "200"){
            Host_view();
          }
          else{
            console.log(data_newContest);
          }
        });

      }
    }


    function openActive(that){
      
      var uid = '<?php echo $_SESSION["uid"]?>';
      document.getElementById('host_holder').innerHTML = "";
       
        document.getElementById("openInactive").style.background = "#ccc";
        that.style.background = "#9CBAC4";

        var myContestReq = $.post("apis/Contest.php", {type:"getmyAConstest", uid:uid});
        myContestReq.done(function(myContestRes){
          console.log(myContestRes);
            var myContestArr = JSON.parse(myContestRes);
            var i = 0;
            for(i=0;i<myContestArr.length;i++){
              var element = '<div class="row" style="margin-top:25px"><div class="panel panel-default">      <div class="panel-heading">        <h4 class="check-title">            <a data-toggle="collapse" data-parent="#accordion" href="#check'+i+'">     <span class="acc-icons"></span> <h5 id="con_title'+i+'"></h5>       </a>      </h4>      </div>    <div id="check'+i+'" class="panel-collapse collapse">     <div class="panel-body">     <!--Apna matterial-->       <div class="row"><p id="con_desc'+i+'"></p></div> <div class="row" style="margin:10px"><div id="con_id'+i+'" style="display:none"></div> <div class="col-md-12" style="width:45%"><button id="solutions'+i+'" class="btn btn-default" onclick="View_Solution('+i+')">Solutions</button></div><div class="col-md-12" style="width:45%"><button id="edit'+i+'" class="btn btn-default" style="margin-left:90%" onclick="Con_Edit('+i+')">Edit</button></div><div class="col">        <label class="switch" >              <input type="checkbox" id="con_status'+i+'" onclick="Change_Status('+i+')">           <span class="slider round"></span>           </label>     </div>      </div> </div>  </div>  </div> </div>';
             document.getElementById('host_holder').innerHTML += element;
              var status = document.getElementById('con_status'+i);
              if(myContestArr[i].status == 1){
                status.checked = true;
              }
              document.getElementById("con_title"+i).innerText = "Title: "+ myContestArr[i].title;
              document.getElementById('con_id'+i).innerText = myContestArr[i].id;
              document.getElementById("con_desc"+i).innerHTML ="<h5>Description:</h5> <br>"+myContestArr[i].description;
            }
            
        });


    }

    function openInactive(that){
      
      var uid = '<?php echo $_SESSION["uid"]?>'
      document.getElementById('host_holder').innerHTML = "";
              
        document.getElementById("openActive").style.background = "#ccc";
        that.style.background = "#9CBAC4";

        var myContestReq = $.post("apis/Contest.php", {type:"getmyIConstest", uid:uid});
        myContestReq.done(function(myContestRes){
          //console.log(myContestRes);
            var myContestArr = JSON.parse(myContestRes);
            var i = 0;
            for(i=0;i<myContestArr.length;i++){
              var element = '<div class="row" style="margin-top:25px"><div class="panel panel-default">      <div class="panel-heading">        <h4 class="check-title">            <a data-toggle="collapse" data-parent="#accordion" href="#check'+i+'">     <span class="acc-icons"></span> <h5 id="con_title'+i+'"></h5>       </a>      </h4>      </div>    <div id="check'+i+'" class="panel-collapse collapse">     <div class="panel-body">     <!--Apna matterial-->       <div class="row"><p id="con_desc'+i+'"></p></div> <div class="row" style="margin:10px"><div id="con_id'+i+'" style="display:none"></div> <div class="col-md-12" style="width:45%"><button id="solutions'+i+'" class="btn btn-default" onclick="View_Solution('+i+')">Solutions</button></div><div class="col-md-12" style="width:45%"><button id="edit'+i+'" class="btn btn-default" style="margin-left:90%" onclick="Con_Edit('+i+')">Edit</button></div><div class="col">        <label class="switch" >              <input type="checkbox" id="con_status'+i+'" onclick="Change_Status('+i+')">           <span class="slider round"></span>           </label>     </div>      </div> </div>  </div>  </div> </div>';
              document.getElementById('host_holder').innerHTML += element;
              document.getElementById("con_title"+i).innerText = "Title: "+ myContestArr[i].title;
              document.getElementById('con_id'+i).innerText = myContestArr[i].id;
              var status = document.getElementById('con_status'+i);
              if(myContestArr[i].status == 1){
                status.checked = true;
              }
              document.getElementById("con_desc"+i).innerHTML ="<h5>Description:</h5> <br>"+myContestArr[i].description;
            }
            
        });
    }

    function Change_Status(index){
      var status = 0;
      var con_id = document.getElementById('con_id'+index).innerText;
      if($('#con_status'+index+':checked').val()){
        status = 1;
      }
      var changeStatusReq = $.post("apis/Contest.php", {type:"ChangeStatus",status:status, id:con_id});
      changeStatusReq.done(function(changeStatusRes){
          if(changeStatusRes == "200"){
            Host_view();
          }
          else{
            alert("Failed to change status");
            console.log(changeStatusRes);
          }
      })
    }

    function Con_Edit(index){
      var con_id = document.getElementById('con_id'+index).innerText;
      var getConReq = $.post("apis/Contest.php", {type:"getContest", id:con_id});
      getConReq.done(function(con_res){
  //console.log(con_res);
        if(con_res != null){
          var con = JSON.parse(con_res);
          $("#M_contest_modal").modal();

        document.getElementById('M_name').value = con[0].title;
        document.getElementById("M_desc").value = con[0].description;
        document.getElementById("M_rule").value = con[0].rules;
        document.getElementById("M_level").value = con[0].level;
        document.getElementById("M_rew").value = con[0].reward;

            document.getElementById("M_save").onclick = function(){
              var ConEditReq = $.post("apis/Contest.php", {type:"Con_Edit",id:con_id, title: document.getElementById('M_name').value, desc: document.getElementById("M_desc").value, rules:document.getElementById("M_rule").value,level:document.getElementById("M_level").value, reward: document.getElementById("M_rew").value});
              ConEditReq.done(function(ConEditRes){
                console.log(ConEditRes);
                if(ConEditRes == "200"){
                  alert("Contest Updated.. :)");
                  
                }
                else{
                  alert("Failed to update contest details.. :(");
                }

              }) 
            }
        }       
      })     
    }


    function View_Solution(index){
        var con_id = document.getElementById("con_id"+index).innerText;
        document.location = "view_solution.php?con_id="+con_id;
    }


    //End of hosts function








    //Eureka functions

    function Eureka_view(){
        var EurekaHTML = '<div class="row" id="eureka_div" style="padding-top:30px"> <div class="row" id="eureka_null"><h3 style="padding-left:35%" id="Eureka_head"> No Ideas were found :( </h3>  </div> <div class="row" id="eureka_holder"></div> </div>';
        document.getElementById('main_div').innerHTML = EurekaHTML;
                var myEurekaReq = $.post("apis/Eureka.php", {type:"allEurekas"});
                myEurekaReq.done(function(myEurekaData){
                   var myEurekas = JSON.parse(myEurekaData);
                   if(myEurekas.length>0){
                       document.getElementById("Eureka_head").innerText = " ↝ Trending on /Eureka..!";
                       var i = 0;
                        var temp_view = document.getElementById('eureka_holder');
                       for(i=0;i<myEurekas.length;i++){
                            var Eureka_element = '<div class="row"><div class="row button button1" style="border-radius: 20px; padding: 20px; margin-top:20px"> <div class="row"><div id="Eureka_id'+i+'" style="display:none;"></div>   <div class="col-md-12" style="width:55%"><h4 id="title'+i+'"></h4></div>   <div class="col-md-12" style="width:45%; text-align:right"><h5 id="domain'+i+'"></h5></div>      </div>    <div class="row">     <div class="col-md-12" id="desc'+i+'" style="width:69%"></div> <div class="col-md-12" id="view_eu'+i+'" style="width:6%; cursor:pointer; text-align:center; text-decoration: underline; color: #497B19"" onclick="view_this_eureka('+i+')">View</div> <div class="col-md-12" id="comment'+i+'" style="width:13%; cursor:pointer; text-align:right; text-decoration: underline; color: #497B19"" onclick="comment('+i+')">Comment</div>  <div class="col-md-12" id="upvote'+i+'" style="width:12%; cursor:pointer; text-align:right" onclick="Upvote(this)">UPVOTES: 10 ↑</div>        </div>    </div> <div class = "row" id="comment_holder'+i+'">.</div></div>';
                            temp_view.innerHTML+=Eureka_element;
                            document.getElementById('title'+i).innerText = myEurekas[i].title;
                            document.getElementById('Eureka_id'+i).innerText = myEurekas[i].id;
                            //document.getElementById('eureka_by'+i).innerText = "By: "+myEurekas[i].org_name;
                            document.getElementById('domain'+i).innerText = "["+myEurekas[i].domain+"]";
                            var desc = myEurekas[i].description;
                            if(desc.length>70){
                                var description = desc.substr(0,70)+"..";                                
                            }
                            else{
                                var description = desc;
                            }
                            
                            document.getElementById('desc'+i).innerText = description;
                            document.getElementById('upvote'+i).innerText = "↑ UPVOTES: "+myEurekas[i].upvotes;
                        }
                   }
                });
       
    }

    function view_this_eureka(div){
        var E_id = document.getElementById('Eureka_id'+div).innerText;
        var comm_req = $.post("apis/Eureka.php", {type:"getEureka",eid:E_id});
            comm_req.done(function(comm_da){
                var comm_data = JSON.parse(comm_da);
                console.log(comm_data);
                if(comm_data.length>0){
                    
                    $("#ViewEureka").modal();
                    document.getElementById('eu_title').value = "Title:  "+comm_data[0].title;
                    document.getElementById('eu_by').value = "By:  "+comm_data[0].org_name;
                    document.getElementById('eu_domain').value = "Domain:  "+comm_data[0].domain;
                    document.getElementById('eu_desc').value = "Description:  "+comm_data[0].description;
                    document.getElementById('eu_lookingfor').value = comm_data[0].lookingfor;

                }
            });

    }

    function Upvote(div){
        var E_id = div.parentNode.parentNode.childNodes[1].childNodes[0].innerText;
        var upvote_req = $.post("apis/Eureka.php", {type:"upvote",id:E_id});
        upvote_req.done(function(up_res){
            if(up_res == "200"){
                Eureka_view();
            }
            else{
                alert("Failed To Upvote :(");
            }
        })
    }

    function comment(div){
        console.log(div);
        document.getElementById('comment_holder'+div).innerHTML = "";
         var E_id = document.getElementById('Eureka_id'+div).innerText;
         var org_name = '<?php echo $_SESSION["org_name"];?>';
         var str_cmt_box = '<div class="row" style="border-radius: 20px; margin-top:15px; margin-left:20%"><div style="padding-left:25px"><input type="text" class="form-control" id="cmt_box'+div+'" placeholder="Enter your comment here"></div></div>';
         var i = 0;
            var comm_req = $.post("apis/Eureka.php", {type:"getComments",eid:E_id});
            comm_req.done(function(comm_da){
                var comm_data = JSON.parse(comm_da);
                if(comm_data.length>0){                
                document.getElementById('comment_holder'+div).innerHTML = "";
                for(i=0;i<comm_data.length; i++){
                var commHTML = '<div class="row button button1" style="border-radius: 20px; margin-top:15px; margin-left:20%"><div class="col-md-12" style="padding-left:25px; padding:15px; width:80%" id="cmt_msg'+div+i+'"> </div><div class="col-md-12" style="width:19%; text-align:right;padding:15px;" id="cmt_by'+div+i+'"></div></div>';
                document.getElementById('comment_holder'+div).innerHTML +=commHTML;
                console.log(comm_data[i].comment)
                document.getElementById('cmt_msg'+div+i).innerText = comm_data[i].comment;
                document.getElementById('cmt_by'+div+i).innerText = "| BY: "+comm_data[i].org_name;
                }

                document.getElementById('comment_holder'+div).innerHTML += str_cmt_box;
                }
                else{
                    document.getElementById('comment_holder'+div).innerHTML += str_cmt_box;
                }
                document.getElementById('cmt_box'+div).onkeydown = function(e){
                    if(e.keyCode == 13){
                        $('#cmt_sure_modal').modal();
                        document.getElementById('cmt_sure').onclick = function(){
                            var cmt_req = $.post("apis/Eureka.php", {type:"newComment", eid:E_id, org_name: org_name, email_id:'<?php echo $_SESSION["email_id"];?>', comment: document.getElementById('cmt_box'+div).value});
                            cmt_req.done(function(cmt_res){
                                alert("Comment Posted :)");
                                document.getElementById('cmt_box'+div).value = "";
                            });
                        }                      
                    }
                }
            });
            
        }
 
    
    //End Of Eureka Functions


function Profile_view(){
      var id = '<?php echo $_SESSION["uid"];?>';
      document.location = "profile/index.php?uid="+id;
    }

</script>


<div id="preloader"></div>






<!-- Modal -->
<div class="modal fade" id="FilterModal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Set Filter</h4>
        </div>
      <div class="modal-body">
        <div class="container">
          <div class="row"style="margin-top:2%">
            <div class="col-md-12" style="width:22.5%">
              <select id="flt_org_type" class="form-control">
                <option selected disabled value="">Select Organization Type:</option>
                <option value="1">Startup</option>
                <option value="2">Corprate</option>
              </select>
            </div>

            <div class="col-md-12" style="width:22.5%">
              <select class="form-control" id="flt_org_status">
                <option value="" disabled selected>Organization Status: </option>
                <option value="Active">Active</option>
                <option value="Dormant">Dormant</option>
                <option value="Active in Progress">Active in Progress</option>
                <option value="Under liquidation">Under liquidation</option>
                <option value="Under process of Striking Off">Under process of Striking Off</option>
                <option value="Closed">Closed</option>
            </select>
            </div>
        </div>

        <div class="row"style="margin-top:2%">
          <div class="col-md-12" style="width:45%">
            <input class="form-control" id="flt_tech_domain" type="text" placeholder="Tech Domain:">
          </div>
       </div>

       <div class="row"style="margin-top:2%">
        <div class="col-md-12" style="width:45%">
          <button id="flt_clear" class="btn btn-default" onclick="Flt_Clear()">CLEAR</button>
        </div>
      </div>

    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>



<!-- Modal -->
<div class="modal fade" role="dialog" id="cmt_sure_modal">
        <div class="modal-dialog">        
          <!-- Modal content-->
          <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Are you sure?</h4>
                </div>
                <div class="modal-body">
                This will post the comment (With your Organization name).
                </div>
                <div class="modal-footer">
                    <button type="button" id="cmt_sure" class="btn btn-default" data-dismiss="modal">YES</button>
                </div>
          </div>
          
        </div>
</div>



<!-- Modal -->
<div class="modal fade" role="dialog" id="new_contest_modal">
  <div class="modal-dialog">        
    <!-- Modal content-->
    <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">New Contest</h4>
          </div>
          <div class="modal-body">
        
            <div class="container">
              <div class="row" style="margin:25px">
              <div class="col-md-12">
                  <input placeholder="Title" type="text" style="width: 45%" tabindex="1" required autofocus id="T_name" required class="form-control">
              </div>
              </div>

              <div class="row" style="margin:25px">
              <div class="col-md-12">
                  <textarea placeholder="Description" style="width: 45%" tabindex="5" required id="T_desc" class="form-control"></textarea>
              </div>
              </div>

              <div class="row" style="margin:25px">
              <div class="col-md-12">
                  <textarea placeholder="Rules" style="width: 45%" tabindex="5" required id="T_rule" class="form-control"></textarea>
              </div>
              </div>

              <div class="row" style="margin:25px">
              <div class="col-md-12">
                  <select id="T_level" required class="form-control" style="width: 45%">
                        <option value="" disabled selected><h4>Level</h4></option>
                        <option value="Simple"><h4>Simple</h4></option>
                        <option value="Moderate"><h4>Moderate</h4></option>
                        <option value="Complex"><h4>Complex</h4></option>  
                  </select>
                </div>
              </div>

              <div class="row" style="margin:25px">
                <div class="col-md-12">
                  <input placeholder="Reward(INR)" style="width: 45%" type="text" tabindex="1" required autofocus id="T_rew" required class="form-control">
                </div>
              </div>

                  
                  
               
            </div>
       
        </div>
          <div class="modal-footer">
              <button type="button" id="new_contest_submit" class="btn btn-default" data-dismiss="modal">Submit</button>
          </div>
    </div>
    
  </div>
</div>


<!-- Modal -->
<div class="modal fade" role="dialog" id="M_contest_modal">
  <div class="modal-dialog">        
    <!-- Modal content-->
    <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">New Contest</h4>
          </div>
          <div class="modal-body">
        
            <div class="container">
              <div class="row" style="margin:25px">
              <div class="col-md-12">
                  <input placeholder="Title" type="text" style="width: 45%" tabindex="1" required autofocus id="M_name" required class="form-control">
              </div>
              </div>

              <div class="row" style="margin:25px">
              <div class="col-md-12">
                  <textarea placeholder="Description" style="width: 45%" tabindex="5" required id="M_desc" class="form-control"></textarea>
              </div>
              </div>

              <div class="row" style="margin:25px">
              <div class="col-md-12">
                  <textarea placeholder="Rules" style="width: 45%" tabindex="5" required id="M_rule" class="form-control"></textarea>
              </div>
              </div>

              <div class="row" style="margin:25px">
              <div class="col-md-12">
                  <select id="M_level" required class="form-control" style="width: 45%">
                        <option value="" disabled selected><h4>Level</h4></option>
                        <option value="Simple"><h4>Simple</h4></option>
                        <option value="Moderate"><h4>Moderate</h4></option>
                        <option value="Complex"><h4>Complex</h4></option>  
                  </select>
                </div>
              </div>

              <div class="row" style="margin:25px">
                <div class="col-md-12">
                  <input placeholder="Reward(INR)" style="width: 45%" type="text" tabindex="1" required autofocus id="M_rew" required class="form-control">
                </div>
              </div>

                  
                  
               
            </div>
       
        </div>
          <div class="modal-footer">
              <button type="button" id="M_save" class="btn btn-default" data-dismiss="modal">Save</button>
          </div>
    </div>
    
  </div>
</div>



<!-- Modal -->
<div class="modal fade" role="dialog" id="MatchModal">
  <div class="modal-dialog">        
    <!-- Modal content-->
    <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="mm_title"></h4>
          </div>
          <div class="modal-body" id="mm_body">
          
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
    </div>
    
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="ViewEureka" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Eureka..!</h4>
        </div>
        <div class="modal-body">
            <form id="Eureka_form">
                <div class="row" style="margin:25px">
                    <div class="col-md-12">
                        <input class="form-control" type="text" placeholder="Title:" id="eu_title" required>
                    </div>     
                </div>


                <div class="row" style="margin:25px">
                        <div class="col-md-12">
                            <input class="form-control" type="text" placeholder="By:" id="eu_by" required>
                        </div>     
                    </div>


                <div class="row" style="margin:25px">
                    <div class="col-md-12">
                        <input class="form-control" type="text" placeholder="Domain:" id="eu_domain" required>
                    </div>
                </div>


                <div class="row" style="margin:25px">
                    <div class="col-md-12">
                            <textarea class="form-control" placeholder="Description" id="eu_desc" required></textarea>
                    </div>
                </div>

                <div class="row" style="margin:25px">
                    <div class="col-md-12">
                        <select class="form-control" id="eu_lookingfor" required>
                            <option disabled selected value="">Looking for: </option>
                            <option value="Funding">Funding</option>
                            <option value="Technical Assistance">Technical Assistance</option>
                        </select>
                    </div>
                </div>

                

            </form>
        </div>
        
      </div>
      
    </div>
</div>



  <header>
    <!-- header-area start -->
    <div id="sticker" class="header-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">

            <!-- Navigation -->
            <nav class="navbar navbar-default">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".bs-example-navbar-collapse-1" aria-expanded="false">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
                <!-- Brand -->
                <a class="navbar-brand page-scroll sticky-logo" href="#">
                  <h1><span>C</span>orporate</h1></a>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse main-menu bs-example-navbar-collapse-1" id="navbar-example">
                <ul class="nav navbar-nav navbar-right">
                  <li class="active">
                    <a class="page-scroll" href="#home">Home</a>
                  </li>
                  <li>
                    <a class="page-scroll" href="#search_div" onclick="Search_view()">Search</a>
                  </li>
                  
                  <li>
                    <a class="page-scroll" href="#eureka_div" onclick="Eureka_view()">Eureka..!</a>
                  </li>
                  <li>
                    <a class="page-scroll" href="#host_div" onclick="Host_view()">Host</a>
                  </li>
                  <li>
                    <a class="page-scroll" href="#portfolio" onclick="Profile_view()">Profile</a>
                  </li>
                  <li>
                    <a class="page-scroll" href="apis/logout.php">Logout</a>
                  </li>
                 
                </ul>
              </div>
              <!-- navbar-collapse -->
            </nav>
            <!-- END: Navigation -->
          </div>
        </div>
      </div>
    </div>
    <!-- header-area end -->
  </header>
 

  <!-- Start Slider Area -->
  <div id="home" class="slider-area">
    <div class="bend niceties preview-2">
      <div id="ensign-nivoslider" class="slides">
        <img src="img/slider/first.jpg" alt="" title="#slider-direction-1" />
        <img src="img/slider/agri.jpg" alt="" title="#slider-direction-2" />
        <img src="img/slider/meet2.jpg" alt="" title="#slider-direction-3" />
      </div>

      <!-- direction 1 -->
      <div id="slider-direction-1" class="slider-direction slider-one">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">One Stop Destination for Startup and Corporate To Connect</h1>
                </div>
                <!-- layer 3 -->
               <!-- layer 3 -->
               <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- direction 2 -->
      <div id="slider-direction-2" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content text-center">
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">Helping Rural Community To Innovate,Discover And Present Ideas</h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">

                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- direction 3 -->
      <div id="slider-direction-3" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">Best Platform For Startup And Corporate Match-Up</h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Slider Area -->



  <div id="main_div" class="container" style="margin-top: 30px; padding:50px">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="check-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#check2">
                                      <span class="acc-icons"></span> <h5 id="con_title"></h5>
            </a>
          </h4>
      </div>
      <div id="check2" class="panel-collapse collapse">
        <div class="panel-body">
          <!--Apna matterial-->
            <p id="con_desc"></p>
          
        </div>
      </div>
    </div>
  </div>




    <div class="footer-area-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="copyright text-center">
              <p>
                &copy; Copyright <strong>Int Elligence</strong>. All Rights Reserved
              </p>
            </div>
          
          </div>
        </div>
      </div>
    </div>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

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