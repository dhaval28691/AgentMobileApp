 function baseurl()
{
var pathArray = window.location.href.split( '/' );
var protocol = pathArray[0];
var host = pathArray[2];
var hostname = pathArray[3];

////////////////to update in thatco dynamically
if(hostname=="AgentMobileApp")
{

hostname+="/property";
}
else
{
hostname=hostname;
}
////////////////

//var url = protocol + '//' + host + '/' +hostname;
var url = "http://www.itws.com.sg/AgentMobileApp/property"

return url;
}
 function setCookie(key, value) {
     var expires = new Date();
     expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
     document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
 }

 function getCookie(key) {
     var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
     return keyValue ? keyValue[2] : null;
 }
 //setCookie('test','');
 //alert(getCookie('test'));  

/*
$(document).on('pagebeforeshow', '#startin_place_map', function(){       
    $(document).on('click', '#save_start_place', function(){     
    });    
});
*/
 
//make dynamic changes in url while changing/cloning files.............. on 18-8-14 
 var img_propertylistimage="http://sghomey.com/admin/propertyimages_upload/";   //property images
 setCookie('img_propertylistimage',img_propertylistimage);

 var img_agentuserimage="http://sghomey.com/admin/agent_images/";  //agent images
 setCookie('img_agentuserimage',img_agentuserimage);

 ///////////////////////


var obj; //user information (json)
t=0;
endplace=0;
noofpassengers=0;
userid='';
sessionStorage['usersetid']="";
useridset='';
//typeoftaxi=0;
$(document).ready(function(e) {
	
	
	var loginas=getCookie('loginas');
	   // var agentid=getCookie('agentid');
	  //  var userreg=getCookie('userreg');

	if(loginas=='agent')
	{
		$('#testnewprop1').css('display', 'block');
		$('.managelist').css('display', 'block');
		//$('#appshareroot').css('display', 'block');
		//$('#logoutpp').css('display', 'block');
		//$('#exitpp').css('display', 'none');
		//$('#apppost1').css('display', 'block');
		$('#apppost1').css('display', 'none');
	}
	else
	{
		$('#testnewprop1').css('display', 'none');
		$('.managelist').css('display', 'none');
	
		//$('#appshareroot').css('display', 'none');
		$('#apppost1').css('display', 'none');
	}
	if(loginas=='guest')
	{
	$('#profile1').css('display', 'none');
	$('#logoutpp').css('display', 'none');
	$('#exitpp').css('display', 'block');
	
	
	}
	else
		{
		$('#profile1').css('display', 'block');
		$('#logoutpp').css('display', 'block');
		$('#exitpp').css('display', 'none');
		}
		
  //$(document).on('pageinit'){
	
	
	//guest user click
	$("#guest").click(function(){
		setCookie('useridset','guestid');
		setCookie('usernameset','guest');
		setCookie('loginas','guest');
		//setCookie('propid','');
		window.location.assign(baseurl()+"/postproperty.html"); 
	});
	//
	
	
	///for place agent image and name in side nav......each page...
	var agentnamefromdb=getCookie('agentnamefromp');
	var agentimagefromdb=getCookie('agentimagefromp');
	$('div.name').html(agentnamefromdb);
	$('div.img').html(agentimagefromdb);

	$('div.usrdet').html(agentnamefromdb);
	$('div.profimg').html(agentimagefromdb);
	
	/////////////
	

	
	///////////////
	
	/////////////
	//// removed upload pic in register..
	///register...................
	$("#register_user").on('submit',(function(e) {  //uploadForm1
		//$('#userImage').bind('change', function(e) {
			
			e.preventDefault();
			$.ajax({
	        	url: "uploaduser.php",
				type: "POST",
				data:  new FormData(this),
				contentType: false,
	    	    cache: false,
				processData:false,
				success: function(data)
			    {
				if(data)
					{
				getregisternew(data);
					}
				else
					{
					//alert("sorry some technical issue!");
					data="";
					getregisternew(data);
					//alert("Please enter the values!");
					//window.location.assign(baseurl()+"/facebook.html");
					
					}
				//$('#photoimage').val(uploadimage);
			    //alert(data);
			    //exit;
				//$("#targetLayer").html(data);
			    },
			  	error: function() 
		    	{
			    	alert("sorry some technical issue!");
			    	window.location.assign(baseurl()+"/index.html");
		    	} 	        
		   });
		}));
   

	///// TO check email unique 
	////for register
	///$("#register_submit").click(function(){
	function getregisternew(img) 
	{
	//var firstname=$("#firstname").val();
	//var lastname=$("#lastname").val();
	var email=$("#email1").val();
	var password=$("#password1").val();
	var username=$("#username").val();
	var mobile=$("#mobile").val();
	var address=$("#address").val();
	var img=img;
	// alert(password);
	// alert(img);
	//alert(email);
    if(email=="")
	{
	   
	   alert("Email should not be empty!");
	   //jQuery($inputItemReference).focus();
	  // $('#email').select();
	  //  $('#email').focus();
	   // $('#email').trigger('change');
	   var email1 = document.getElementById('email');
	   email1.focus;
	   //$("#email").focus();
		return false;	
	}
    else if(password=="")
	{
		alert("Password should not be empty!");
		//$("#password").focus();
		var password1 = document.getElementById('password');
		password1.focus;
		return false;
	}
	else if(username=="")
	{
		
		alert("Username should not be empty!");
		// jQuery($inputItemReference).focus();
		// $('#firstname').select();
		//    $('#firstname').focus();
		//    $('#firstname').trigger('change');
		 //$('#firstname').focus();
		 var username1 = document.getElementById('username');
		 username1.focus;
		return false;
	}
	else if(mobile=="")
	{
		
		alert("Mobile no should not be empty!");
		// jQuery($inputItemReference).focus();
		// $('#firstname').select();
		//    $('#firstname').focus();
		//    $('#firstname').trigger('change');
		 //$('#firstname').focus();
		 var mobile1 = document.getElementById('mobile');
		 mobile1.focus;
		return false;
	}
	else if(img=="")
	{
		
		alert("Please upload the pic of yours!");
		// jQuery($inputItemReference).focus();
		// $('#firstname').select();
		//    $('#firstname').focus();
		//    $('#firstname').trigger('change');
		 //$('#firstname').focus();
		// var mobile1 = document.getElementById('mobile');
		// mobile1.focus;
		return false;
	}

	else if(email!="")
	{
		    var email1 = document.getElementById('email1');
		    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	         if (!filter.test(email1.value)) {
		    alert('Please provide a valid email address');
		    email1.focus;
		    return false;
	         }
	        
	}
	 else if(mobile!="")
	   {
	      var phone1 = document.getElementById('mobile');
	      var phoneno2 = /^\d{10}$/;  
	      if(!phone1.value.match(phoneno2))  
	      {  
	      alert("Please enter the valid phone number!");  
	      phone1.focus;
	      return false;  
	      }  
	   }
    if(mobile!="")
    {
    	// var stripped = phone.replace(/[\(\)\.\-\ ]/g, '');    

    	  
    	   if (isNaN(mobile)) {
    	        alert("The phone number contains illegal characters!");
    	        mobile.focus;
    	        return false;
    	    }
    	   else if(!(mobile.length==10))
    	   {
    	        alert("The phone number must contains 10 numbers!");
    	        mobile.focus;
    	        return false;
    	   }
    	    
    }
	

	checkemailsignin(email,img);
	//checkemailsignin(email);
	//});  //close check.reg
	}
	//check mail....
	function checkemailsignin(email1,img1){  //removed img1
		
	var img=img1;
	var email=email1;
	alert(email1,img1);
	//alert(email+"2");
	//alert(email);
	$.ajax({
	
	    type: "POST",
	    url: baseurl()+"/WS/p_request.php?action=loginwithfb",  //local & server
	    data: "email="+email,
	    dataType: "json",
	    async: 'true',
	    success: function(msg) {     
			console.log(msg);
	        if(msg.Result=="Success")   //message from response			
	        {
	        	if(msg.recordmsg)
	        		{
	        		alert("Sorry! already this email id exists as Agent");
	        		window.location.assign(baseurl()+"/index.html");
	        		}
	        	else
	        		{
	        		 alert("Sorry! already this email id exists");
	         		 window.location.assign(baseurl()+"/index.html");
	        		}
	        	
	        }
	        else
	        {
			
	        	registeruser(img);
	        	//registeruser();
	         }
	    
	                            },
	    error: function (xhr, ajaxOptions, thrownError) {
	   // alert(xhr.status);
	   // alert(thrownError);
	   alert("Sorry! network problem");    
	  }

	    });


	}  //check mail..


	////for register

	function registeruser(img)  //img removed
	{
	
		var email=$("#email1").val();
		var password=$("#password1").val();
		var username=$("#username").val();
		var mobile=$("#mobile").val();
		var address=$("#address").val();
        var img=img;

	
    if(email=="")
	{
	   
	   alert("Email should not be empty!");
	   //jQuery($inputItemReference).focus();
	  // $('#email').select();
	  //  $('#email').focus();
	   // $('#email').trigger('change');
	   var email1 = document.getElementById('email');
	   email1.focus;
	   //$("#email").focus();
		return false;	
	}
    else if(password=="")
	{
		alert("Password should not be empty!");
		//$("#password").focus();
		var password1 = document.getElementById('password');
		password1.focus;
		return false;
	}
	else if(username=="")
	{
		
		alert("Username should not be empty!");
		// jQuery($inputItemReference).focus();
		// $('#firstname').select();
		//    $('#firstname').focus();
		//    $('#firstname').trigger('change');
		 //$('#firstname').focus();
		 var username1 = document.getElementById('username');
		 username1.focus;
		return false;
	}
	else if(mobile=="")
	{
		
		alert("Mobile no should not be empty!");
		// jQuery($inputItemReference).focus();
		// $('#firstname').select();
		//    $('#firstname').focus();
		//    $('#firstname').trigger('change');
		 //$('#firstname').focus();
		 var mobile1 = document.getElementById('mobile');
		 mobile1.focus;
		return false;
	}

	else if(email!="")
	{
		    var email1 = document.getElementById('email1');
		    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	         if (!filter.test(email1.value)) {
		    alert('Please provide a valid email address');
		    email1.focus;
		    return false;
	         }
	        
	}
	 else if(mobile!="")
	   {
	      var phone1 = document.getElementById('mobile');
	      var phoneno2 = /^\d{10}$/;  
	      if(!phone1.value.match(phoneno2))  
	      {  
	      alert("Please enter the valid phone number!");  
	      phone1.focus;
	      return false;  
	      }  
	   }
    if(mobile!="")
    {
    	// var stripped = phone.replace(/[\(\)\.\-\ ]/g, '');    

    	  
    	   if (isNaN(mobile)) {
    	        alert("The phone number contains illegal characters!");
    	        mobile.focus;
    	        return false;
    	    }
    	   else if(!(mobile.length==10))
    	   {
    	        alert("The phone number must contains 10 numbers!");
    	        mobile.focus;
    	        return false;
    	   }
    	    
    }

	$.ajax({
	type: "POST",
	url: baseurl()+"/WS/p_request.php?action=register",  //local & server

	data:"username="+username+"&email="+email+"&password="+password+"&mobile="+mobile+"&address="+address+"&photoimage="+img,
	dataType: "json",
	async: 'true',


	success: function(msg) {    
	//alert(data);
	if(msg.Result=="Success")   //message from response
	{
	  
	 // $.mobile.ajaxEnabled = false;
	  alert("successfully registered,please login");
	 // $.mobile.changePage("login.html");  //success
	  window.location.assign(baseurl()+"/index.html");
	}
	else
	{
	  alert("Wrong details");
	  $.mobile.changePage("index.html");   //failure
	}

	                    },
	error: function (xhr, ajaxOptions, thrownError) {
	//alert(xhr.status);
	//alert(thrownError);
	alert("Sorry! network problem");    
	}



	});
		
	//});
	}
	///////////////////////
	
	

	
	//// for login with gmail....
	//$(document).on('pageinit', '#login', function(){  
$("#login_guest1").click(function(){

	      //  setCookie('useridset','');
	      //   setCookie('usernameset','');
            var email=$("#email").val();
            var password=$("#password").val();
          
          // var url= baseurl()+"/WS/st_request.php?action=login";
          //  alert(url);
            if(email=="")
            	{
            	alert("Please enter email!");
            	return false;
            	}
            else if(password=="")
            	{
            	alert("Please enter password!");
            	return false;
            	}
            else if(email!="")
    	    {
    	    	    var email1 = document.getElementById('email');
    	    	    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                     if (!filter.test(email1.value)) {
    	    	    alert('Please provide a valid email address');
    	    	    email1.focus;
    	    	    return false;
                     }
                    
    	    }
          
    
        $.ajax({
        type: "POST",
        url: baseurl()+"/WS/p_request.php?action=login",  //local & server
      //   url:"http://localhost/kup/WS/st_request.php?action=login",           //local
      //  url: "http://thatco.com/kup/WS/st_request.php?action=login",   //server
        data: "email="+email+"&password="+password,
        dataType: "json",
        async: 'true',
        success: function(msg) {     
            if(msg.Result=="Success")   //message from response
            {
            	if(msg.record!="")
            		{
            		var userid=msg.record;
            		var username=msg.record1;
            		var userimage=msg.record3;
            		
            		if(msg.record2!="")
            			{
            			//var agentid=msg.record2;
            			//}
            		//if(msg.record3!="")
        			//{
        			//var userreg=msg.record3;
            			
            			var loginas=msg.record2;
        			}
            	 
            		
            		
            		setCookie('useridset',userid);
            		setCookie('usernameset',username);
            		setCookie('loginas',loginas);
            		setCookie('userimageset',userimage);
            	//	setCookie('agentid',agentid);
            	//	setCookie('userreg',userreg);
            		//var useridset=$.cookie("useridset");
            		}
            	 alert("successfully login");
            	 //postproperty();
                window.location.assign(baseurl()+"/postproperty.html");  //newproperty
            }
            else
            {
             alert("wrong username and password");
             $.mobile.changePage("index.html");   //failure
             
            }
        
                                },
        error: function (xhr, ajaxOptions, thrownError) {
        //alert(xhr.status);
       // alert(thrownError);
                                	alert("Sorry! network problem");    
      }



        });
    });

///////////////////////////

////for login with facebook....
//$(document).on('pageinit', '#login', function(){  
$("#login_facebook").click(function(){

      //  setCookie('useridset','');
      //   setCookie('usernameset','');
        var email=$("#email").val();
        var password=$("#password").val();
      
      // var url= baseurl()+"/WS/st_request.php?action=login";
      //  alert(url);
        if(email=="")
        	{
        	alert("Please enter email!");
        	return false;
        	}
        else if(password=="")
        	{
        	alert("Please enter password!");
        	return false;
        	}
        else if(email!="")
	    {
	    	    var email1 = document.getElementById('email');
	    	    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                 if (!filter.test(email1.value)) {
	    	    alert('Please provide a valid email address');
	    	    email1.focus;
	    	    return false;
                 }
                
	    }
      

    $.ajax({
    type: "POST",
    url: baseurl()+"/WS/p_request.php?action=login",  //local & server
  //   url:"http://localhost/kup/WS/st_request.php?action=login",           //local
  //  url: "http://thatco.com/kup/WS/st_request.php?action=login",   //server
    data: "email="+email+"&password="+password,
    dataType: "json",
    async: 'true',
    success: function(msg) {     
        if(msg.Result=="Success")   //message from response
        {
        	if(msg.record!="")
        		{
        		var userid=msg.record;
        		var username=msg.record1;
        		
        		
        		setCookie('useridset',userid);
        		setCookie('usernameset',username);
        		//var useridset=$.cookie("useridset");
        		}
        	 alert("successfully login");
        	 window.location.assign(baseurl()+"/postproperty.html");  //newproperty
        }
        else
        {
         alert("wrong username and password");
         $.mobile.changePage("index.html");   //failure
         
        }
    
                            },
    error: function (xhr, ajaxOptions, thrownError) {
   // alert(xhr.status);
  //  alert(thrownError);
                            	alert("Sorry! network problem");    
  }



    });
});

///////////////////////////

////for login with twitter....
//$(document).on('pageinit', '#login', function(){  
$("#login_linkedin").click(function(){

    //  setCookie('useridset','');
    //   setCookie('usernameset','');
      var email=$("#email").val();
      var password=$("#password").val();
    
    // var url= baseurl()+"/WS/st_request.php?action=login";
    //  alert(url);
      if(email=="")
      	{
      	alert("Please enter email!");
      	return false;
      	}
      else if(password=="")
      	{
      	alert("Please enter password!");
      	return false;
      	}
      else if(email!="")
	    {
	    	    var email1 = document.getElementById('email');
	    	    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
               if (!filter.test(email1.value)) {
	    	    alert('Please provide a valid email address');
	    	    email1.focus;
	    	    return false;
               }
              
	    }
    

  $.ajax({
  type: "POST",
  url: baseurl()+"/WS/p_request.php?action=login",  //local & server
//   url:"http://localhost/kup/WS/st_request.php?action=login",           //local
//  url: "http://thatco.com/kup/WS/st_request.php?action=login",   //server
  data: "email="+email+"&password="+password,
  dataType: "json",
  async: 'true',
  success: function(msg) {     
      if(msg.Result=="Success")   //message from response
      {
      	if(msg.record!="")
      		{
      		var userid=msg.record;
      		var username=msg.record1;
      		var userimage=msg.record3;
      		
      		
      		setCookie('useridset',userid);
      		setCookie('usernameset',username);
      		setCookie('userimageset',userimage);
      	
      		//var useridset=$.cookie("useridset");
      		}
      	 alert("successfully login");
      	 window.location.assign(baseurl()+"/postproperty.html");  //newproperty
      }
      else
      {
       alert("wrong username and password");
       $.mobile.changePage("index.html");   //failure
       
      }
  
                          },
  error: function (xhr, ajaxOptions, thrownError) {
  //alert(xhr.status);
 // alert(thrownError);
 alert("Sorry! network problem");    
}



  });
});

///////////////////////////



//property list from new property post -- go to list of properties.....
$("#donelist").click(function(){
  	 window.location.assign(baseurl()+"/postproperty.html");
});
///


/*
//////To get into dynamic property types........... 

$(".type_property").click(function(){
	   $(".propertytype7").html('');
$.ajax({
type: "POST",
url: baseurl()+"/WS/p_request.php?action=getpropertytype",  //local & server

dataType: "json",
async: 'true',
success: function(msg) {  
	
	   if(msg)
		{
		var json =msg.record;
	             
	 	         var data=[];
	 	     $(".propertytype7").html('');
	 	         $.each(json, function(idx, obj) {
	 	        	var type=obj.type;
	 	        	var id=obj.id;
	 	        	
	 	     	    $(".propertytype7").append(' <div class="pick_psgr"><div class="count_psngr"><a href="#" class="type_property" name="t_p" id="t_p">'+type+'</a><br/><br/></div>'
	 	     	    		                
	 				/////////////
	       			);
	 	     
	 	        });
	 	      $(".propertytype7").append ('<div class="done_psr"><a href="#" id="typep" class="typep" data-rel="back">Done</a></div></div>');
	 	   
	 	         ///action done select taxi name from popup 
	 	       $(".type_property").click(function(){
	 	    	  
					$(".type_property").removeClass('active2');
					$(this).addClass('active2');
				});
				$( ".typetaxi" ).click(function() {
					
					//alert($(".active1").text())
					var type_property=$(".active2").text();
					$('#type').val(type_property);	   
				});
	         
	     }
              },
error: function (xhr, ajaxOptions, thrownError) {
alert(xhr.status);
alert(thrownError);
}

});


});	
//end for dynamic property type...............
//////////////
*/
   
   
////
//////////////update profile footer.....
//$("#updatep").click(function(){
$("#updatep").click(function(){

	
	var userid=getCookie('useridset');

	if(userid=="" || userid==null)
		{
		 alert("Sorry your login expired!");
		 window.location.assign(baseurl()+"/index.html");
		}
	
  var firstname=$("#username").val();
  var lastname=$("#surname").val();
  var email=$("#email").val();
  var address=$("#address").val();
  
  if(firstname=="")
  	{
  	alert("Firstname should not be empty!");
  	
  	return false;
  	 $('#firstname').focus();
  	}
 
  else if(email=="")
	{
	alert("Email should not be empty!");
	 $('#email').focus();
	return false;
	}
  else if(email!="")
  {
  	    var email1 = document.getElementById('email');
  	    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
           if (!filter.test(email1.value)) {
  	    alert('Please provide a valid email address');
  	    email1.focus;
  	    return false;
           }
          
  }
 
$.ajax({
type: "POST",
url: baseurl()+"/WS/p_request.php?action=update_profile",  //local & server
//url:"http://localhost/kup/WS/st_request.php?action=change_password",
//url: "http://thatco.com/kup/WS/st_request.php?action=change_password",
data: "userid="+userid+"&firstname="+firstname+"&lastname="+lastname+"&email="+email+"&address="+address,
dataType: "json",
async: 'true',
success: function(msg) {     
  if(msg.Result=="Success")   //message from response
  {
    //alert("successfully updated the profile");
  	alert(msg.Message);
   // $.mobile.changePage("login.html");  //success
   // window.location.assign(baseurl()+"/index.html");  //before login.html
  	 window.location.assign(baseurl()+"/postproperty.html");
  }
  else
  {
   // alert("Failure to update the profile");
	  alert("Sorry this mail id doesn't exists!");
    $.mobile.changePage("profile.html");   //failure
  }

                      },
error: function (xhr, ajaxOptions, thrownError) {
//alert(xhr.status);
//alert(thrownError);
 alert("Sorry! network problem");  
 window.location.assign(baseurl()+"/index.html");
}



});
});
///
//cancel in update class
$(".cancelpp").click(function(){
	window.location.assign(baseurl()+"/postproperty.html"); 
});

///
///header section things.......................
//profile page get from any in header
$("#profilep").click(function(){
	window.location.assign(baseurl()+"/profile.html"); 
});
//

//header.................
//post property list page get from any in header
$("#propertylist").click(function(){
   
	window.location.assign(baseurl()+"/postproperty.html"); 
});
//


/////for chat message.......
	$("#testmsg").click(function(){
		
		var loginas=getCookie('loginas');
		if(loginas=='guest')
		{
			alert("Please Register to send message to agent!");
		}
		else
			{
			//window.location.assign(baseurl()+"/chat.html"); 
			window.location.assign(baseurl()+"/messages.html"); 
			}
	});
///
	
	//aboutus page get from any in header accounts
	$("#about1").click(function(){
		window.location.assign(baseurl()+"/aboutus.html"); 
	});
	//
	
	//new property list page get from any in header
	$("#testnewprop1").click(function(){
		window.location.assign(baseurl()+"/newproperty.html"); 
	});
	//
	
	///side nav linkswork..............
	//post property list page get from any in header
	$(".postpropertylist").click(function(){
		
		window.location.assign(baseurl()+"/postproperty.html"); 
	});
	//
	//manage property list page get from any in header
	$(".managelist").click(function(){
		//window.location.assign(baseurl()+"/managelist.html"); 
	
		window.location.assign(baseurl()+"/postpropertymanage.html"); 
	});
	//
	//messages list page get from any in header
	$(".messages").click(function(){
		var loginas=getCookie('loginas');
		if(loginas=='guest')
		{
			alert("Please Register to send/view messages list!");
		}
		else
			{
			window.location.assign(baseurl()+"/messages.html"); 
			}
	
	});
	//
	//messages list page get from any in header
	$(".appointment").click(function(){
		window.location.assign(baseurl()+"/appointment.html"); 
	});
	//
	///////////////
	
	//news page get from any in nav accounts
	$(".news").click(function(){
		window.location.assign(baseurl()+"/news.html"); 
	});
	//
	
	
	
	
	//share...........apps
	//share list page get from any in header
	//$("#appshare1").click(function(){
	//	window.location.assign(baseurl()+"/appshare.html"); 
  //	});
	//
	
	//messages list page get from any in header
	$("#apppost1").click(function(){
		window.location.assign(baseurl()+"/propertylist.html"); 
	});
	//
	
	//profile page get from any in nav accounts
	$("#profile1").click(function(){
		window.location.assign(baseurl()+"/profile.html"); 
	});
	//
	
	
	
	
	
	///////////////////////////////////////////////////////////

//log out class side nav
//$(".logoutpp").click(function(){
	$("#logoutpp").click(function(){
		var answer1 = confirm ("Are you sure want to logout your section!");
 		if (answer1)
 		{
	setCookie('useridset','');
	setCookie('usernameset','');
	setCookie('loginas','');
	setCookie('userimageset','');
	setCookie('propid','');
	setCookie('agentnamefromdb','');
	setCookie('agentimagefromdb','');
	
	///////////////////
	setCookie('img_propertylistimage','');
	setCookie('img_agentuserimage','');
	/////////////////
	//alert("your account logout successfully!");
	window.location.assign(baseurl()+"/index.html"); 
 		}
 		else
 			{
 			
 			}
});
//
	
//log out class side nav
//$(".logoutpp").click(function(){
	$("#exitpp").click(function(){
		var answer1 = confirm ("Are you sure want to exit your section!");
 		if (answer1)
 		{
		setCookie('useridset','');
		setCookie('usernameset','');
		setCookie('loginas','');
		setCookie('userimageset','');
		setCookie('propid','');
		setCookie('agentnamefromdb','');
		setCookie('agentimagefromdb','');
		
		
		///////////////////
		setCookie('img_propertylistimage','');
		setCookie('img_agentuserimage','');
		/////////////////
		
		
		//alert("your session exit successfully!");
		window.location.assign(baseurl()+"/index.html"); 
 		}
 		else
 			{
 			
 			}
	});
	//

////////////////////////////////////////////
	
	
	
	//share links.. by email in all pages...................
	$(".sendtxt").click(function(){
		
		var emailidshare=$("#emailshare1").val();
		//alert(emailidshare);
		  if(emailidshare=="")
			{
			   alert("Email id should not be empty!");
			   var emailshare = document.getElementById('emailshare1');
			   emailshare.focus;
			   return false;	
			}
 else if(emailidshare!="")
			{
				    var emailshare1 = document.getElementById('emailshare1');
				    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			         if (!filter.test(emailshare1.value)) {
				    alert('Please provide a valid email address');
				    emailshare1.focus;
				    return false;
			         }
			        
			}
			$.ajax({
			    type: "POST",
			    url: baseurl()+"/WS/p_request.php?action=sharelinkmail",  //local & server
			    data: "emailidshare="+emailidshare,
			    dataType: "json",
			    async: 'true',
			    success: function(msg) {     
			        if(msg.Result=="Success")   //message from response
			        {
			        	    alert("Successfuly share the link");
			        		window.location.assign(baseurl()+"/postproperty.html");
			         }
			        else
			        {
			        	alert("Sorry! Some problem to share the link");
		        		window.location.assign(baseurl()+"/index.html");
			        	
			         }
			    
			                            },
			    error: function (xhr, ajaxOptions, thrownError) {
			   // alert(xhr.status);
			   // alert(thrownError);
			   alert("Sorry! network problem");   
			   window.location.assign(baseurl()+"/index.html");
			  }

			    });  ///ajax close
		
	}); ///click for share close............
	//
	
	
	
/////////////////////////////////////////////////////////
//end......
});

///chat_widow////////







