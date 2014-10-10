<?php

include('db_connect.php');


 class st_response extends db_connect {
     
     protected $_action;
     protected $_info;
     protected $_request;
     
     public function __construct() {
         $this->_action 	= $_REQUEST['action'];
         $this->_request 	= base64_decode($_REQUEST['jsonData']);
	     $this->_info 		= json_decode($this->_request,true);
          
         parent::__construct();//syntax for calling parent constructor
         
         if (!empty($this->_action)) {
             call_user_func_array(array($this,$this->_action),array($this->_info)); //action name, param eg array("param1","param2") and so on....
         } else {
             echo json_encode(array('No method occur'));
         }
     }
     
     ///register...
     public function register($info) {
     
     
     	//exit;
     	
     	//  $firstname	= $info['firstname'];
     	//  $lastname		= $info['lastname'];
          $email_id		= $info['email_id'];
           $username	= $info['username'];
        //  $password		= md5($info['password']);
         $password		= $info['password'];
          
           $mobile		= $info['mobile'];
             $address	= $info['address'];
             $photoimage	= trim($info['photoimage']);

             
           // $created_date	= date("Y-m-d H:i:s");
          
         //  $data=array("username"=>$firstname,"surname"=>$lastname,"email"=>$email_id,"password"=>$password,"address"=>$address,"photoimage"=>$photoimage);
            $data=array("username"=>$username,"email"=>$email_id,"password"=>$password,"mobile"=>$mobile,"address"=>$address,"photoimage"=>$photoimage);
           
          // $result	= $this->insert('guestusers',$data);
            $result	= $this->insert('register_guest_users',$data);
   
   
          if ($result) {
          
          	$data['record']=$email_id;
            $data['Result']='Success';
          	$data['Message']='User has been registered successfully';
          	echo json_encode($data);
	    
          } else {
          	$response	= '{"Result":"Failure","Message":"User not registered"}';
	        echo $response;
          }

     }
     
     
 	public function login($info) {
     	   $email_id		= $info['email_id'];
      //   $password		= md5($info['password']);
           $password		= $info['password'];
           
          $query="select * from register_guest_users where email='$email_id' and password='$password'";  //guest users before
          
          $result 	= $this->select($query);
         
          $rows		= $this->rows($result);

          if ($rows>0) {
          /// to maintain sections.
          $values=$this->fetch_array($result);
          $useridsession=$values[0]['guestid'];
          $_SESSION['useridsession']=$useridsession;
          // $_SESSION['useridsessionreg']=$useridsession;
          $user_set=$_SESSION['useridsession'];
           //$user_setreg=$_SESSION['useridsessionreg'];
          $usernamesession=$values[0]['username'];
          $_SESSION['usernamesession']=$usernamesession;
          $user_setname=$_SESSION['usernamesession'];
          /////  name
          /// image
          $userimagesession=$values[0]['photoimage'];
          if($userimagesession){
        
          $_SESSION['userimagesession']=$userimagesession;
          $user_setimage=$_SESSION['userimagesession'];
           $data['record3']=$user_setimage;//image
          }
          ///
         
          
         /////////////
          	$data['record']=$user_set;
          	$data['record1']=$user_setname;//email
           
          //	$data['record3']='registeruser';   //$user_setreg
            $data['record2']='registeruser'; 
          	$data['Result']='Success';
          	echo json_encode($data);
          //	$response	= '{"Result":"Success","Message":"Valid user"}';
	      // 	echo $response;
          } else if($rows==0)
          {
        //  $query1="select * from admin where email='$email_id' and password='$password'";  //admin login
          $query1="select * from agent where email='$email_id' and password='$password'";
          
          $result1	= $this->select($query1);
         
          $rows1		= $this->rows($result1);
            if ($rows1>0) {
          /// to maintain sections.
          $values1=$this->fetch_array($result1);
          $useridsession=$values1[0]['id'];
          $_SESSION['useridsession']=$useridsession;
         //  $_SESSION['useridsessionagent']=$useridsession;
          $user_set=$_SESSION['useridsession'];
       //   $user_setagent=$_SESSION['useridsessionagent'];
          $usernamesession=$values1[0]['name'];
          $_SESSION['usernamesession']=$usernamesession;
          $user_setname=$_SESSION['usernamesession'];
          
         
          /// image
          $userimagesession=$values1[0]['image'];
          if($userimagesession){
          $_SESSION['userimagesession']=$userimagesession;
          $user_setimage=$_SESSION['userimagesession'];
           $data['record3']=$user_setimage;//image
          }
    
          ///
          
         /////////////
          	$data['record']=$user_set;
          	$data['record1']=$user_setname;  //email
          //	$data['record3']=$user_setimage;//image
          	
          //	$data['record2']='agent'; //$user_setagent
          	$data['record2']='agent';  
          	$data['Result']='Success';
          	echo json_encode($data);
          //	$response	= '{"Result":"Success","Message":"Valid user"}';
	      // 	echo $response;
          } 
          else
          {
          	$response	= '{"Result":"Failure","Message":"Invalid user"}';
	        echo $response;
          }
          
          }
            
          else 
          {
          	$response	= '{"Result":"Failure","Message":"Invalid user"}';
	        echo $response;
          }
          	
        
          
            
     }
 //while register check unique email.
 public function loginwithfb($info) {
     	  $email_id		= $info['email_id'];
        //  $password		= md5($info['password']);
        // $data['recordmsg1']=$email_id;
     	  
          $query="select * from register_guest_users where email='$email_id' "; //before..
          $result 	= $this->select($query);
          $rows		= $this->rows($result);
          
         // $query1="select * from admin where email='$email_id' ";  //before..
         $query1="select * from agent where email='$email_id' ";  //before..
          $result1 	= $this->select($query1);
          $rows1		= $this->rows($result1);
          

          
         if($rows1>0)
          	{
          		$data['recordmsg']='agent';
          	}
          	
          if ($rows>0 || $rows1>0) {
          	//$data['recordmsg1']=$email_id;
          	
          	    /// to maintain sections.
          $values=$this->fetch_array($result);
          $useridsession=$values[0]['guestid'];
          $_SESSION['useridsession']=$useridsession;
          // $_SESSION['useridsessionreg']=$useridsession;
          $user_set=$_SESSION['useridsession'];
           //$user_setreg=$_SESSION['useridsessionreg'];
          $usernamesession=$values[0]['username'];
          $_SESSION['usernamesession']=$usernamesession;
          $user_setname=$_SESSION['usernamesession'];
          /////  name
          /// image
          $userimagesession=$values[0]['photoimage'];
          if($userimagesession){
        
          $_SESSION['$userimagesession']=$userimagesession;
          $user_setimage=$_SESSION['$userimagesession'];
           $data['record3']=$user_setimage;//image
          }
           ///
                 $useremailsession=$values[0]['email'];
          $_SESSION['useremailsession']=$useremailsession;
          $user_setemail=$_SESSION['useremailsession'];
          $data['recordmsg1']=$user_setemail;

         
            /////////////
          	$data['record']=$user_set;
          	$data['record1']=$user_setname;//email
           
            //	$data['record3']='registeruser';   //$user_setreg
            $data['record2']='registeruser'; 
          	/////////////////////////
          	
          	
            $data['Result']='Success';
          	echo json_encode($data);
        
          } else {
          	$response	= '{"Result":"Failure","Message":"Invalid user"}';
	        echo $response;
          }
          
            
     }
 //update profile
  public function update_profile1($info) {
        $userid=$info['userid'];
        $firstname= $info['firstname'];
        $lastname= $info['lastname'];
        $email= $info['email'];

            //  $phone		= $info['phone'];
              $address	= $info['address'];
            //  $photoimage	= trim($info['photoimage']);
		
         $data=array("username"=>$firstname,"surname"=>$lastname,"email"=>$email,"address"=>$address);
        
          
          $condition="userid='$userid'";
          //$result 	= $this->update('guestusers',$data,$condition);
          $result 	= $this->update('register_guest_users',$data,$condition);
         
          if ($result) {
          	$response	= '{"Result":"Success","Message":"Profile has been updated successfully"}';
	       	echo $response;
          } else {
          	$response	= '{"Result":"Failure","Message":"Profile not updated"}';
	        echo $response;
          }
        
    }
     
  //get postproperty list.............all.....
 public function getpostproperty($info) {
 	   //  $id=$info['id'];
	     $date = date('Y-m-d H:i:s');
 	     
 	
 //  $query="select property.*,property_location.*,property_details.*,property_media.* from property,property_location,property_details,property_media where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 group by property.property_id order by property.property_id desc";
 // $query="select property.*,property_location.*,property_details.*,property_media.*,property_type.* from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 and property.property_type=property_type.id group by property.property_id order by property.property_id desc";

	     //mine correct one 4_8_14
	     //   $query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 and property.property_type=property_type.id  group by property.property_id order by property.property_id desc";

	     //$query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property.property_id and property_details.property_id=property.property_id and property.activate=1 and property.property_type=property_type.id  group by property.property_id order by property.property_id desc";  // and property_media.cover_image=1

	     	      // the last change according to get correct result.......12-9-14......
	     
	//mine
	 //   $query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type from property,property_location,property_details,property_media,property_type where property.activate=1 group by property.property_id order by property.property_id desc";  //property.property_id=property_location.property_id and property_media.property_id=property.property_id and property_details.property_id=property.property_id and and property.property_type=property_type.id	     
	     //ni
	   //  $query="select property.*,property_location.* from property,property_location where  property.property_id=property_location.property_id and activate=1 group by property.property_id order by property.property_id desc";
$query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type from property left join property_location on  property.property_id=property_location.property_id  left join property_details  on  property_details.property_id=property.property_id  left join property_media on  property_media.property_id=property.property_id left join property_type  on property.property_type=property_type.id 
where  property.activate=1   group by property.property_id order by property.property_id desc";
	     //$query="select * from property where activate=1";
	     //to inlcude property type i changed. 
  $result 	= $this->select($query);
   $rows	= $this->rows($result);
     
          if($rows>0)
          {
          	
           $values=$this->fetch_array($result);
            
          foreach ($values as $value){
          
       //mine
         $data_get[]=array("agent"=>$value['agent'],"price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"front_status"=>$value['front_status'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id']);
          //ni
           //      $data_get[]=array("agent"=>$value['agent'],"price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"front_status"=>$value['front_status'],"rooms"=>$value['rooms'],"listing_type"=>$value['listing_type'],"property_id"=>$value['property_id']);
         
         
         // $data_get[]=array("price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id']);

         
           $ss=$value['agent'];
           
           /*
           $propget=$value['property_id'];
              ///////////////////////////////
            $query7n="select  property_media.*,property.* from property,property_media where cover_image=1 and property_id='$propget' ";
            
             $result7n = mysql_query($query7n);
            $rows7n	= $this->rows($result7n);
            if($rows7n>0)
            {
              $values7n=$this->fetch_array($result7n);
            
          foreach ($values7n as $value7n){
          
         $data_get7n[]=array("media"=>$value7n['media']);
      
       
          	
          }
           $data['record7n']=$data_get7n;
            }
            //else 
          //  {
          //  $data['record7n']="";
          //  } 
            //////////////////////////////////
        */
          }
           $query7="select * from agent where id='$ss' ";
     
          $result7 = mysql_query($query7);
            $rows7	= $this->rows($result7);
            if($rows7>0)
            {
              $values7=$this->fetch_array($result7);
            
          foreach ($values7 as $value7){
          
         $data_get7[]=array("image"=>$value7['image'],"name"=>$value7['name']);
         $data['record7']=$data_get7;
          
          	
          }
            }
            else 
            {
            $data['record7']="";
            } 
            
          // $data['record7n']=$data_get7n;
           $data['record']=$data_get;
          
            /*
            ///for agent img purpose
            $query7="select * from agent where id='$id' ";
            $result7 = mysql_query($query7);
            $rows7	= $this->rows($result7);
            if($rows7>0)
            {
              $values7=$this->fetch_array($result7);
            
          foreach ($values7 as $value7){
          
         $data_get7[]=array("image"=>$value7['image']);
         $data['record7']=$data_get7;
          	
          }
            }
            else 
            {
            $data['record7']="";
            }
            /////////////

          */           
            $data['Result']='Success';
          	echo json_encode($data);
          }
       else 
          {
          $data['Result']='Failure';
          	echo json_encode($data);
          }
        
    }
 
    
    //get postproperty list sale names.............all.....
 public function getpostpropertysale($info) {
	     $date = date('Y-m-d H:i:s');
 	     
 	
 //  $query="select property.*,property_location.*,property_details.*,property_media.* from property,property_location,property_details,property_media where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 group by property.property_id order by property.property_id desc";
//  $query="select property.*,property_location.*,property_details.*,property_media.*,property_type.* from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 and property.property_type=property_type.id and property.listing_type='SALE' group by property.property_id order by property.property_id desc";
  //to inlcude property type i changed. 
  //to make if unique only necessary fields taken...
 //correct one
	    $query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property.property_id and property_details.property_id=property.property_id and property.activate=1 and property_media.cover_image=1  and property.property_type=property_type.id and property.listing_type='SALE' group by property.property_id order by property.property_id desc";
	    //  $query="select * from property where activate=1 and listing_type='SALE' ";
  $result 	= $this->select($query);
   $rows	= $this->rows($result);
     
          if($rows>0)
          {
             $values=$this->fetch_array($result);
            
          foreach ($values as $value){
          
          $data_get[]=array("price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"front_status"=>$value['front_status'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id']);
        //  $data_get[]=array("price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id']);
          	
          }
             
            $data['record']=$data_get;
            $data['Result']='Success';
          	echo json_encode($data);
          }
       else 
          {
          $data['Result']='Failure';
          	echo json_encode($data);
          }
        
    }
 
    
  //get postproperty list sale names..by click on sale name...........all.....
 public function getpostproperty_bysaleclick($info) {
	     $date = date('Y-m-d H:i:s');
 	     $property_id=$info['property_id'];
 	
 //  $query="select property.*,property_location.*,property_details.*,property_media.* from property,property_location,property_details,property_media where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 group by property.property_id order by property.property_id desc";
//correct one
 	    $query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property.property_id and property_details.property_id=property.property_id and property.activate=1 and property_media.cover_image=1  and property.property_type=property_type.id and property.listing_type='SALE' and property.property_id='$property_id' group by property.property_id order by property.property_id desc";
  //to inlcude property type i changed. 
 // $query="select * from property where activate=1 and listing_type='SALE' and property_id='$property_id' ";
   $result 	= $this->select($query);
   $rows	= $this->rows($result);
     
          if($rows>0)
          {
             $values=$this->fetch_array($result);
            
          foreach ($values as $value){
          
         $data_get[]=array("price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"front_status"=>$value['front_status'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id']);
            //       $data_get[]=array("price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id']);
          	
          }
             
            $data['record']=$data_get;
            $data['Result']='Success';
          	echo json_encode($data);
          }
       else 
          {
          $data['Result']='Failure';
          	echo json_encode($data);
          }
        
    }
    /////////
 //get postproperty list rent names.............all.....
 public function getpostpropertyrent($info) {
	     $date = date('Y-m-d H:i:s');
 	     
 	
 //  $query="select property.*,property_location.*,property_details.*,property_media.* from property,property_location,property_details,property_media where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 group by property.property_id order by property.property_id desc";
//  $query="select property.*,property_location.*,property_details.*,property_media.*,property_type.* from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 and property.property_type=property_type.id and property.listing_type='SALE' group by property.property_id order by property.property_id desc";
  //to inlcude property type i changed. 
  //to make if unique only necessary fields taken...
    //correct one
	    $query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property.property_id and property_details.property_id=property.property_id and property.activate=1 and property_media.cover_image=1  and property.property_type=property_type.id and property.listing_type='RENT' group by property.property_id order by property.property_id desc";
	  //$query="select * from property where activate=1 and listing_type='RENT' ";
  $result 	= $this->select($query);
   $rows	= $this->rows($result);
     
          if($rows>0)
          {
             $values=$this->fetch_array($result);
            
          foreach ($values as $value){
          
          $data_get[]=array("price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"front_status"=>$value['front_status'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id']);
                  // $data_get[]=array("price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id']);
          	
          }
             
            $data['record']=$data_get;
            $data['Result']='Success';
          	echo json_encode($data);
          }
       else 
          {
          $data['Result']='Failure';
          	echo json_encode($data);
          }
        
    }
 
    
  //get postproperty list rent names..by click on rent name...........all.....
 public function getpostproperty_byrentclick($info) {
	     $date = date('Y-m-d H:i:s');
 	     $property_id=$info['property_id'];
 	
    //$query="select property.*,property_location.*,property_details.*,property_media.* from property,property_location,property_details,property_media where  property.property_id=property_location.property_id and property_media.property_id=property.property_id and property_details.property_id=property.property_id and activate=1 and cover_image=1 group by property.property_id order by property.property_id desc";
  	    $query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property.property_id and property_details.property_id=property.property_id and property.activate=1 and property_media.cover_image=1  and property.property_type=property_type.id and property.listing_type='RENT' and property.property_id='$property_id' group by property.property_id order by property.property_id desc";
    
    //correct one.
 // $query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 and property.property_type=property_type.id and property.listing_type='RENT' and property.property_id='$property_id' group by property.property_id order by property.property_id desc";
  //to inlcude property type i changed. 
  //$query="select * from property where activate=1 and listing_type='RENT' and property_id='$property_id' ";
  
  $result 	= $this->select($query);
   $rows	= $this->rows($result);
     
          if($rows>0)
          {
             $values=$this->fetch_array($result);
            
          foreach ($values as $value){
          
         $data_get[]=array("price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"front_status"=>$value['front_status'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id']);
         //$data_get[]=array("price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id']);
          	
          }
             
            $data['record']=$data_get;
            $data['Result']='Success';
          	echo json_encode($data);
          }
       else 
          {
          $data['Result']='Failure';
          echo json_encode($data);
          }
        
    }
  /////////
 //get postproperty list sold names.............all.....
 public function getpostpropertysold($info) {
	     $date = date('Y-m-d H:i:s');
 	     
 	
//  $query="select property.*,property_location.*,property_details.*,property_media.* from property,property_location,property_details,property_media where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 group by property.property_id order by property.property_id desc";
//  $query="select property.*,property_location.*,property_details.*,property_media.*,property_type.* from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 and property.property_type=property_type.id and property.listing_type='SALE' group by property.property_id order by property.property_id desc";
  //to inlcude property type i changed. 
  //to make if unique only necessary fields taken...
    //correct one
    $query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property.property_id and property_details.property_id=property.property_id and property.activate=1 and property_media.cover_image=1 and property.property_type=property_type.id and property.listing_type='SOLD' group by property.property_id order by property.property_id desc";
	 //    $query="select * from property where activate=1 and listing_type='SOLD' ";
  $result 	= $this->select($query);
   $rows	= $this->rows($result);
     
          if($rows>0)
          {
             $values=$this->fetch_array($result);
            
          foreach ($values as $value){
          
          $data_get[]=array("price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"front_status"=>$value['front_status'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id']);
              //     $data_get[]=array("price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id']);
          	
          }
             
            $data['record']=$data_get;
            $data['Result']='Success';
          	echo json_encode($data);
          }
       else 
          {
          $data['Result']='Failure';
          	echo json_encode($data);
          }
        
    }
 
    
  //get postproperty list sold names..by click on sold name...........all.....
 public function getpostproperty_bysoldclick($info) {
	     $date = date('Y-m-d H:i:s');
 	     $property_id=$info['property_id'];
 	
  //  $query="select property.*,property_location.*,property_details.*,property_media.* from property,property_location,property_details,property_media where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 group by property.property_id order by property.property_id desc";
 //correct one
  $query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property.property_id and property_details.property_id=property.property_id and property.activate=1 and property_media.cover_image=1 and property.property_type=property_type.id and property.listing_type='SOLD' and property.property_id='$property_id' group by property.property_id order by property.property_id desc";
  //to inlcude property type i changed. 
  //$query="select * from property where activate=1 and listing_type='SOLD' and property_id='$property_id' ";
  $result 	= $this->select($query);
   $rows	= $this->rows($result);
     
          if($rows>0)
          {
             $values=$this->fetch_array($result);
            
          foreach ($values as $value){
          
         $data_get[]=array("price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"front_status"=>$value['front_status'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id']);
             //    $data_get[]=array("price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id']);
          	
          }
             
            $data['record']=$data_get;
            $data['Result']='Success';
          	echo json_encode($data);
          }
       else 
          {
          $data['Result']='Failure';
          echo json_encode($data);
          }
        
    }
    /////////////////
   //get postproperty list in details based on property click.............all.....
 public function getpropertylist_details($info) {
	     $date = date('Y-m-d H:i:s');
 	     $property_id=$info['property_id'];
 	
 //  $query="select property.*,property_location.*,property_details.*,property_media.* from property,property_location,property_details,property_media where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 group by property.property_id order by property.property_id desc";
 // $query="select property.*,property_location.*,property_details.*,property_media.*,property_type.* from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 and property.property_type=property_type.id group by property.property_id order by property.property_id desc";
       //correct one
 	  //   $query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type,property_location.district from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 and property.property_type=property_type.id and property.property_id='$property_id'group by property.property_id order by property.property_id desc";

 	     
 	  // $query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type,property_location.district from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property.property_id and property_details.property_id=property.property_id andactivate=1  and property.property_type=property_type.id and property.property_id='$property_id' group by property.property_id order by property.property_id desc";  //and cover_image=1

 	        // $query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type,property_location.district from property,property_location,property_details,property_media,property_type where  activate=1  and property.property_id='$property_id' group by property.property_id order by property.property_id desc";  //and cover_image=1

 	         
 	         //property.property_id=property_location.property_id and property_media.property_id=property.property_id and property_details.property_id=property.property_id and and property.property_type=property_type.id
 	  
 	         $query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type,property_location.district from property left join property_location on  property.property_id=property_location.property_id  left join property_details  on  property_details.property_id=property.property_id  left join property_media on  property_media.property_id=property.property_id left join property_type  on property.property_type=property_type.id 
where  property.activate=1 and property.property_id='$property_id'  group by property.property_id order by property.property_id desc";
 	         
 	         
 	  //to inlcude property type i changed. 
	    // $query="select * from property where activate=1 and property_id='$property_id' ";
   $result 	= $this->select($query);
   $rows	= $this->rows($result);
     
          if($rows>0)
          {
          	
           $values=$this->fetch_array($result);
            
          foreach ($values as $value){
          
          $data_get[]=array("price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"front_status"=>$value['front_status'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id'],"postcode"=>$value['postcode'],"district"=>$value['district'],"co_broke"=>$value['co_broke']);
          //$data_get[]=array("price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id'],"district"=>$value['district'],"postcode"=>$value['postcode']);
          	
          }
             
            $data['record']=$data_get;
            
            
          $query1="select * from property_facilites where property_id='$property_id' ";
          $result1 	= $this->select($query1);
          $rows1	= $this->rows($result1);
           if($rows1>0)
          {
          $values1=$this->fetch_array($result1);
            
          foreach ($values1 as $value1){
          
          $data_get1[]=array("facilities"=>$value1['facilities']);
         
          }
            $data['record1']=$data_get1;
          }
          else 
          {
          	 $data['record1']="";
          }   
                	 
            $data['Result']='Success';
          	echo json_encode($data);
          }
       else 
          {
          $data['Result']='Failure';
          	echo json_encode($data);
          }
        
    }
    
 ///save new property details..............
 
	public function create_new_propertysave($info) {

    	
   	    //$property_id=$_POST['property_id'];
   	    $title=$info['title'];
   	    $address=$info['address'];
   	    $price=$info['price'];
   	    $district=$info['district'];
   	    $type=$info['type'];
   	    $postcode=$info['postcode'];
   	    $area=$info['area'];
   	    $description=$info['description'];
   	    $rooms=$info['rooms'];
   	    $bathrooms=$info['bathrooms'];
   	    $listing_type=$info['listing_type'];

   	    $agentid=$info['guestid'];
   	    $imageprop=$info['imageprop'];
   	       
   	    
   	       $a1=$info['a1'];
   	       $a2=$info['a2'];
   	       $a3=$info['a3'];
   	       $a4=$info['a4'];
   	       
   	       $cobroke=$info['cobroke'];
   	      // if($cobroke=="")$cobroke="0";
   	  // $facilities=$info['facilities'];
   	    
   	    ///
   	    $activate=1;
   	    $created_date=date('Y-m-d H:i:s');
   	    //
   	    
   	    //
   	    $group=4;
   	    //
   	    
   	    //location
   	    $streetnumber="";
   	    $longitude="";
   	    $latitude="";
   	    //
   	    
   	    //listing_type --property
   	    //media image---property_media
   	    if($imageprop!="")
   	    {
   	    $media=$imageprop;
   	    }
   	    else 
   	    {
   	    $media="";
   	    }
   	    $cover_image=1;
   	
   	    
	  
          $datapropertytype=array("type"=>$type);
          $resultpropertytype	= $this->insert('property_type',$datapropertytype);  //property_type drop down to make with ids and type.
          
          
          if($resultpropertytype)
          {
          $query="select * from property_type where type='$type' ";  // && group='$group' ---property_type
	      $result 	= $this->select($query);
          $rows	= $this->rows($result);
     
          if($rows>0)
          {
          	$values=$this->fetch_array($result);
          	$property_type=$values[0]['id'];
          	
          }
          else 
          {
          	$property_type="";
          }
          
	       if($property_type!="")
          	{
                $property_type=$property_type;
                $data=array("address"=>$title,"asking_price"=>$price,"postcode"=>$postcode,"floor_area"=>$area,"rooms"=>$rooms,"activate"=>$activate,"created_date"=>$created_date,"property_type"=>$property_type,"listing_type"=>$listing_type,"agent"=>$agentid,"co_broke"=>$cobroke);
                $result1	= $this->insert('property',$data);     
          	}
          	else 
          	{
           $data=array("address"=>$title,"asking_price"=>$price,"postcode"=>$postcode,"floor_area"=>$area,"rooms"=>$rooms,"activate"=>$activate,"created_date"=>$created_date,"listing_type"=>$listing_type,"agent"=>$agentid,"co_broke"=>$cobroke);
           $result1	= $this->insert('property',$data);             
          }
	
	
         // $data=array("address"=>$title,"asking_price"=>$price,"postcode"=>$postcode,"floor_area"=>$area,"rooms"=>$rooms,"activate"=>$activate,"created_date"=>$created_date);
         // $result1	= $this->insert('property',$data); 
          
          if($result1)
          {
          $query="select * from property where address='$title' && asking_price='$price' ";  // && group='$group' 
	      $result 	= $this->select($query);
          $rows	= $this->rows($result);
     
          if($rows>0)
          {
          	$values=$this->fetch_array($result);
          	$property_id=$values[0]['property_id'];
          	
          }
          else 
          {
          	
          $property_id="";	
          }
      
          
	       if($property_id!="")
          	{
                 $property_id=$property_id;
                 $datadetails=array("property_id"=>$property_id,"description"=>$description,"bathrooms"=>$bathrooms);
                 $datalocation=array("property_id"=>$property_id,"district"=>$district,"streetnumber"=>$streetnumber,"streetname"=>$address,"postcode"=>$postcode,"longitude"=>$longitude,"latitude"=>$latitude);
                 $datamedia=array("property_id"=>$property_id,"media"=>$media,"cover_image"=>$cover_image);
                 
                $dataamen1=array("property_id"=>$property_id,"facilities"=>$a1);
                $dataamen2=array("property_id"=>$property_id,"facilities"=>$a2);
                $dataamen3=array("property_id"=>$property_id,"facilities"=>$a3);
                $dataamen4=array("property_id"=>$property_id,"facilities"=>$a4);
                 
                 $result2	= $this->insert('property_details',$datadetails);
                 $result3	= $this->insert('property_location',$datalocation);

               //  if($imageprop!="") { $result4	= $this->insert('property_media',$datamedia);  } //not in if...
                  $result4	= $this->insert('property_media',$datamedia); 
                  
                 if($a1!=""){ $result51	= $this->insert('property_facilites',$dataamen1);}
                 if($a2!=""){ $result52	= $this->insert('property_facilites',$dataamen2);}
                 if($a2!=""){ $result53	= $this->insert('property_facilites',$dataamen3);}
                 if($a3!=""){ $result54	= $this->insert('property_facilites',$dataamen4);}
                 
                 if($result2 && $result3)
                 {
                 	$data['record']=$property_id;
                 	
                 	/*
                 	 $queryn="select * from property_media where cover_image=1";  // && group='$group' ---property_type
	                 $resultn = $this->select($queryn);
                     $rowsn	= $this->rows($resultn);
                     if($rowsn>0)
                     {
                     		$valuesn=$this->fetch_array($resultn);
          	              //  $media=$valuesn[0]['media'];
                             foreach ($valuesn as $valuen){
          
                                $data_getn[]=array("media"=>$valuen['media']);
         
                            }
          	                $data['recordn']=$data_getn;
                     }
                     */
                     
          	        $data['Result']='Success';
          	        $data['Message']='Property details has been saved successfully';
          	        echo json_encode($data);
                 	//$response	= '{"Result":"Success","Message":"Property details has been saved successfully"}';
	       	       // echo $response;
                 }
          	        else {
          	      // $response	= '{"Result":"Failure","Message":"Property details not saved"}';
	              //  echo $response;
	              $data['Result']='Failure';
                  echo json_encode($data);
                    }
                 
          	}

          
          
          
          }  //if result1
          
          } //property
          else 
          {
            
          	//$response	= '{"Result":"Failure","Message":"Property details not saved"}';
	        //echo $response;
	        $data['Result']='Failure';
            echo json_encode($data);
       
          }
          
        //  $datadetails=array("property_id"=>$property_id,"description"=>$description,"bathrooms"=>$bathrooms);
       // $datalocation=array("property_id"=>$property_id,"district"=>$district,"streetnumber"=>$streetnumber,"streetname"=>$address,"longitude"=>$longitude,"latitude"=>$latitude);
        // $datamedia=array("media"=>$media,"cover_image"=>$cover_image);

                 
               //  $result2	= $this->insert('property_details',$datadetails);
               //  $result3	= $this->insert('property_location',$datalocation);
              // $result4	= $this->insert('property_media',$datamedia);
          
          /*
         // if($resultropertytype)
        //  {
         // if ($result1) {
          	   if ($result2){
          	   	if($result3)
          	   	{
          	   		
          	   
          	$response	= '{"Result":"Success","Message":"Property details has been saved successfully"}';
	       	echo $response;
          }
         	}
          	  // } //} 
          	   
         
          	   else {
          	$response	= '{"Result":"Failure","Message":"Property details not saved"}';
	        echo $response;
          }
         
      

      */
	}
    
    /*
       public function create_new_propertysave($info) {

    	
   	    //$property_id=$_POST['property_id'];
   	    $title=$info['title'];
   	    $address=$info['address'];
   	    $price=$info['price'];
   	    $district=$info['district'];
   	    $type=$info['type'];
   	    $postcode=$info['postcode'];
   	    $area=$info['area'];
   	    $description=$info['description'];
   	    $rooms=$info['rooms'];
   	    $bathrooms=$info['bathrooms'];
   	    $listing_type=$info['listing_type'];
   	    $guestid=$info['guestid'];
   	    $facilities=$info['facilities'];
   	    ///
   	    $activate=1;
   	    $created_date=date('Y-m-d H:i:s');
   	    //
   	      $data=array("address"=>$title,"asking_price"=>$price,"postcode"=>$postcode,"floor_area"=>$area,"rooms"=>$rooms,"activate"=>$activate,"created_date"=>$created_date,"description"=>$description,"bathrooms"=>$bathrooms,"district"=>$district,"streetname"=>$address,"listing_type"=>$listing_type,"type"=>$type,"guestid"=>$guestid,"facilities"=>$facilities);
          $result1	= $this->insert('property',$data);
          

          if($result1)
          {
          ///to get propertyid..............
       $query="select * from property where address='$title' ";  // && group='$group' ---property_type
	   $result 	= $this->select($query);
       $rows	= $this->rows($result);
     
          if($rows>0)
          {
          	$values=$this->fetch_array($result);
          	$property_id=$values[0]['property_id'];
          	
        
        
	      
          	//  foreach ($values as $value){
       // $data_get[]=array("property_id"=>$value['property_id']);
       //   }
            $data['record']=$property_id;
          	$data['Result']='Success';
          	echo json_encode($data);
          }   
          else 
          {
           $data['Result']='Failure';
           echo json_encode($data);
          } 
          }
       ///////////////////*
          
       
          if($result1)
                 {
                 	$response	= '{"Result":"Success","Message":"Property details has been saved successfully"}';
	       	        echo $response;
                 }
          	        else {
          	       $response	= '{"Result":"Failure","Message":"Property details not saved"}';
	                echo $response;
                    }
                    /////////////////
       }
       */
 //get dynamic property types
public function getpropertytype($info) {
	
	  
           $query="select * from property_type";
 	       $result 	= $this->select($query);
           $rows		= $this->rows($result);
          if($rows>0)
          {
          $values=$this->fetch_array($result);
          foreach ($values as $value){
          $data_get[]=array("id"=>$value['id'],"type"=>$value['type']);
          }
            $data['record']=$data_get;
          	$data['Result']='Success';
          	echo json_encode($data);
          }
       else 
          {
          $data['Result']='Failure';
          	echo json_encode($data);
          }
    
        
    }
 //update profile
  public function update_profile($info) {
        $userid=$info['userid'];
        $firstname= $info['firstname'];

        $phone= $info['phone'];

        $email= $info['email'];
        $password= $info['password'];
       
             // $phone		= $info['phone'];
        $address	= $info['address'];
            //  $photoimage	= trim($info['photoimage']);
		
         // $queryc="select * from register_guest_users where email='$email' ";  //registered user users before
         		
          $queryc="select * from register_guest_users where guestid='$userid' ";  //registered user users before
          $resultc 	= $this->select($queryc);
          $rowsc	= $this->rows($resultc);
          
          if($rowsc>0)
          {
          
          $data=array("username"=>$firstname,"mobile"=>$phone,"email"=>$email,"address"=>$address,"password"=>$password);
          
         $data1=array("name"=>$firstname);
         $condition="guestid='$userid'";
          $condition1="from_id='$userid'";
          //$result 	= $this->update('guestusers',$data,$condition);
          $result 	= $this->update('register_guest_users',$data,$condition);
          $result1 	= $this->update('message_list',$data1,$condition1);
         
          if ($result) {
          	$response	= '{"Result":"Success","Message":"Registered User Profile has been updated successfully"}';
	       	echo $response;
          } else {
          	$response	= '{"Result":"Failure","Message":"Profile not updated"}';
	        echo $response;
          }
          }
          else if($rowsc==0)
          {
          	
          $queryc1="select * from agent where id='$userid' ";  //registered user users before  ;;; first given email.........
          $resultc1 	= $this->select($queryc1);
          $rowsc1		= $this->rows($resultc1);
          	if($rowsc1>0)
          	{
          $data=array("name"=>$firstname,"contact_mobile"=>$phone,"email"=>$email,"address"=>$address,"password"=>$password);
          $data1=array("name"=>$firstname);
          $condition="id='$userid'";
          $condition1="from_id='$userid'";
          //$result 	= $this->update('guestusers',$data,$condition);
          $result 	= $this->update('agent',$data,$condition);
          $result1 	= $this->update('message_list',$data1,$condition1);
          if ($result) {
          	$response	= '{"Result":"Success","Message":"Agent Profile has been updated successfully"}';
	       	echo $response;
          } else {
          	$response	= '{"Result":"Failure","Message":"Profile not updated"}';
	        echo $response;
          }
          	
          	}
          	
          else 
          {
          	$response	= '{"Result":"Failure","Message":"Profile not updated"}';
	        echo $response;
          }
          
          
          	
          }
          else 
          {
          	$response	= '{"Result":"Failure","Message":"Profile not updated"}';
	        echo $response;
          }
        
    }
    
     //get images in new property profile
  public function get_images_newproperty($info) {
             $queryn="select * from property_media";  // && group='$group' ---property_type  //where cover_image=1
	                 $resultn = $this->select($queryn);
                     $rowsn	= $this->rows($resultn);
                     if($rowsn>0)
                     {
                     		$valuesn=$this->fetch_array($resultn);
          	              //  $media=$valuesn[0]['media'];
                             foreach ($valuesn as $valuen){
          
                                $data_getn[]=array("id"=>$valuen['id'],"media"=>$valuen['media']);
         
                            }
          	                $data['recordn']=$data_getn;
          	                $data['Result']='Success';
          	                  echo json_encode($data);
                     }
                     else
                     {
                     	 $data['Result']='Failure';
          	             echo json_encode($data);
                     }
                     
  }
  //remove iamges from property........
public function removeimages($info) {
	 $id=$info['id'];
          
  // $query="delete from property_media where id='$id' ";
  // $result = $this->select($query); 
     $condition1="id='$id'";
     $result1=$this->delete('property_media',$condition1);
   

          if($result1){
          	 ///again want to select image...........
 $queryn="select * from property_media ";  // && group='$group' ---property_type  //where cover_image=1
	                 $resultn = $this->select($queryn);
                     $rowsn	= $this->rows($resultn);
                     if($rowsn>0)
                     {
                     		$valuesn=$this->fetch_array($resultn);
          	              //  $media=$valuesn[0]['media'];
                             foreach ($valuesn as $valuen){
          
                                $data_getn[]=array("id"=>$valuen['id'],"media"=>$valuen['media']);
         
                            }
          	                $data['recordn']=$data_getn;
          	                $data['Result']='Success';
          	                echo json_encode($data);
                     }
                     else
                     {
                     	$data_getn="";
                     	$data['recordn']=$data_getn;
                     	// $data['Result']='Failure';
                     	 $data['Result']='Success';
          	             echo json_encode($data);
                     }
     
/////////////////
          	//$response	= '{"Result":"Success","Message":"Image removed successfully"}';
	       //echo $response;
          } else {
          	$response	= '{"Result":"Failure","Message":"Image not removed"}';
	        echo $response;
          }
    }
    
  //remove /delete property from propertylist manage........
public function deleteproperty($info) {
         $id=$info['id'];
	  
            $condition1="property_id='$id'";
            $result1=$this->delete('property',$condition1);
         
              if($result1){
                             $data['Result']='Success';
          	                 echo json_encode($data);
                     }
                else {
             	$response	= '{"Result":"Failure","Message":"property not deleted"}';
	            echo $response;
                }
              
        
    }

  //to edit select property from propertylist manage........
public function getpropertylisttoedit($info) {
         $id=$info['id'];
	  
        $queryn="select * from property where property_id='$id' ";  // && group='$group' ---property_type
	                 $resultn = $this->select($queryn);
                     $rowsn	= $this->rows($resultn);
    
                     
                     if($rowsn>0)
                     {
                     		$valuesn=$this->fetch_array($resultn);
          	              //  $media=$valuesn[0]['media'];
                             foreach ($valuesn as $valuen){
          
                                //$data_getn[]=array("id"=>$valuen['id'],"media"=>$valuen['media']);
                                $data_getn[]=array("title"=>$valuen['address'],"price"=>$valuen['asking_price'],"postcode"=>$valuen['postcode'],"area"=>$valuen['floor_area'],"rooms"=>$valuen['rooms'],"property_type"=>$valuen['property_type'],"listing_type"=>$valuen['listing_type'],"agentid"=>$valuen['agent']);
                                
         
                            }
          	                $data['recordn']=$data_getn;
          	                $data['Result']='Success';
          	                echo json_encode($data);
                     }
                     else
                     {
                     	$response	= '{"Result":"Failure","Message":"Not able to get the particular property"}';
	                    echo $response;
                     }
          
        
    }
    
    ///edit/update  new property details..............
	public function update_propertyedit($info) 
	{
	    //$property_id=$_POST['property_id'];
   	    $title=$info['title'];
   	    $address=$info['address'];
   	    $price=$info['price'];
   	    $district=$info['district'];
   	    $type=$info['type'];
   	    $postcode=$info['postcode'];
   	    $area=$info['area'];
   	    $description=$info['description'];
   	    $rooms=$info['rooms'];
   	    $bathrooms=$info['bathrooms'];
   	    $listing_type=$info['listing_type'];

	    $agentid=$info['guestid'];
   	    $imageprop=$info['imageprop'];
   	       	    
   	    $id=$info['id'];
   	    $cobroke=$info['cobroke'];
   	    
   	       $a1=$info['a1'];
   	       $a2=$info['a2'];
   	       $a3=$info['a3'];
   	       $a4=$info['a4'];
   	  // $facilities=$info['facilities'];
   	    
   	    
   	    $activate=1;
   	    $created_date=date('Y-m-d H:i:s');
   	    
   	    
   	   
   	 //   $group=4;
   	   
   	    
   	    //location
   	    $streetnumber="";
   	    $longitude="";
   	    $latitude="";
   	    //
   	    
   	    //listing_type --property
   	    //media image---property_media
   	    if($imageprop!="")
   	   {
   	    $media=$imageprop;
   	    }
   	    else 
   	    {
   	    $media="";
   	    }
   	    $cover_image=1;
   	
   	    
	  $condition="property_id='$id' ";
	  
	   if($type!="")
       {
          $datapropertytype=array("type"=>$type);
          $resultpropertytype	= $this->insert('property_type',$datapropertytype);  //property_type drop down to make with ids and type.
	   }    
          
if($type!="")
{
        if($resultpropertytype)
          {
          $query="select * from property_type where type='$type' ";  // && group='$group' ---property_type
	      $result 	= $this->select($query);
          $rows	= $this->rows($result);
     
          if($rows>0)
          {
          	$values=$this->fetch_array($result);
          	$property_type=$values[0]['id'];
          	
          }
          else 
          {
          	$property_type="";
          }
            
	       if($property_type!="")
          	{
                $property_type=$property_type;
                $data=array("address"=>$title,"asking_price"=>$price,"postcode"=>$postcode,"floor_area"=>$area,"rooms"=>$rooms,"activate"=>$activate,"created_date"=>$created_date,"property_type"=>$property_type,"listing_type"=>$listing_type,"agent"=>$agentid,"co_broke"=>$cobroke);
                $result1	= $this->update('property',$data,$condition);     
          	}
          	else 
          	{
           $data=array("address"=>$title,"asking_price"=>$price,"postcode"=>$postcode,"floor_area"=>$area,"rooms"=>$rooms,"activate"=>$activate,"created_date"=>$created_date,"listing_type"=>$listing_type,"agent"=>$agentid,"co_broke"=>$cobroke);
           $result1	= $this->update('property',$data,$condition);             
          }
 }
          	else 
          	{
           $data=array("address"=>$title,"asking_price"=>$price,"postcode"=>$postcode,"floor_area"=>$area,"rooms"=>$rooms,"activate"=>$activate,"created_date"=>$created_date,"listing_type"=>$listing_type,"agent"=>$agentid,"co_broke"=>$cobroke);
           $result1	= $this->update('property',$data,$condition);   
           $result1=1;          
          }
       
	
	
         // $data=array("address"=>$title,"asking_price"=>$price,"postcode"=>$postcode,"floor_area"=>$area,"rooms"=>$rooms,"activate"=>$activate,"created_date"=>$created_date);
         // $result1	= $this->insert('property',$data); 
          
         if($result1)
          {
          $query="select * from property where property_id='$id' ";  // && group='$group' 
	      $result 	= $this->select($query);
          $rows	= $this->rows($result);
     
          if($rows>0)
          {
          	$values=$this->fetch_array($result);
          	$property_id=$values[0]['property_id'];
          	
          }
          else 
          {
          	
          $property_id="";	
          }
      
	    if($id!="")
         	{
          		//$condition="property_id='$id' ";
               $property_id=$id;
                
            
       
         
                 $datadetails=array("property_id"=>$property_id,"description"=>$description,"bathrooms"=>$bathrooms);
                 $datalocation=array("property_id"=>$property_id,"district"=>$district,"streetnumber"=>$streetnumber,"streetname"=>$address,"postcode"=>$postcode,"longitude"=>$longitude,"latitude"=>$latitude);
                // $datamedia=array("property_id"=>$property_id,"media"=>$media,"cover_image"=>$cover_image);
                 
                $dataamen1=array("property_id"=>$property_id,"facilities"=>$a1);
                $dataamen2=array("property_id"=>$property_id,"facilities"=>$a2);
                $dataamen3=array("property_id"=>$property_id,"facilities"=>$a3);
                $dataamen4=array("property_id"=>$property_id,"facilities"=>$a4);
                 
                 $result2	= $this->update('property_details',$datadetails,$condition);
                 $result3	= $this->update('property_location',$datalocation,$condition);
              

               if($imageprop!="") { $result4	= $this->update('property_media',$datamedia,$condition);  } //not in if...
                 // $result4	= $this->update('property_media',$datamedia,$condition); 
                  
                 if($a1!=""){ $result51	= $this->update('property_facilites',$dataamen1,$condition);}
                 if($a2!=""){ $result52	= $this->update('property_facilites',$dataamen2,$condition);}
                 if($a2!=""){ $result53	= $this->update('property_facilites',$dataamen3,$condition);}
                 if($a3!=""){ $result54	= $this->update('property_facilites',$dataamen4,$condition);}
                 
                // if($result2 && $result3)
                if($result1)
                 {
                 	$data['record']=$property_id;
                 	
                 	/*
                 	 $queryn="select * from property_media where cover_image=1";  // && group='$group' ---property_type
	                 $resultn = $this->select($queryn);
                     $rowsn	= $this->rows($resultn);
                     if($rowsn>0)
                     {
                     		$valuesn=$this->fetch_array($resultn);
          	              //  $media=$valuesn[0]['media'];
                             foreach ($valuesn as $valuen){
          
                                $data_getn[]=array("media"=>$valuen['media']);
         
                            }
          	                $data['recordn']=$data_getn;
                     }
                     */
                     
          	        $data['Result']='Success';
          	        $data['Message']='Property details has been edited successfully';
          	        echo json_encode($data);
                 	//$response	= '{"Result":"Success","Message":"Property details has been saved successfully"}';
	       	       // echo $response;
                 }
          	        else {
          	      // $response	= '{"Result":"Failure","Message":"Property details not saved"}';
	              //  echo $response;
	              $data['Result']='Failure';
                  echo json_encode($data);
                    }
                 
       	}

          
          
          
         }  //if result1
          
          } //property
         else 
          {
            
          // 	$response	= '{"Result":"Failure","Message":"Property details not saved"}';
	     //  echo $response;
	       $data['Result']='Failure';
            echo json_encode($data);
       
        }
          
    
	}
	
  //to get all messages /chat list
public function getallmessages($info) {
               $id=$info['id'];
               
               
               ///to check which type instead of static id 25............
               $queryc="select id from agent where id='$id' ";
               $resultc = $this->select($queryc);
               $rowsc	= $this->rows($resultc);
               
               if($rowsc>0)
               {
               $valuesc=$this->fetch_array($resultc);
          	   $idc=$valuesc[0]['id'];
          	   if($idc!="")
          	   $idtype='agent';
          	   else 
          	   $idtype='register';
               }
               else 
               {
               	$idtype="";
               	$idc="";
               }
               /////////////////
               
               //////////////////////
               $querycn="select id from message_list where to_id='$id' ";
               $resultcn = $this->select($querycn);
               $rowscn	= $this->rows($resultcn);
               
               ///////////////////////
               
   //$queryn="select * from message_list m left join register_guest_users r where r.guestid=m.from_id";  // && group='$group' ---property_type
   // $queryn="select DISTINCT name,from_id,to_id,message,image,created_date from message_list where from_id!='$id' ";   //before *
   // $queryn="select from_id,to_id,name,message,image,created_date,count( * ) from message_list where from_id!='$id' GROUP BY from_id HAVING count( * ) >= 1";
if($id=='25' || $idtype=='agent' || $id==$idc)
{
               $queryn="select *,count( * ) from (select * from message_list where  from_id!='$id' order by id desc) as m GROUP BY from_id  HAVING count( * ) >= 1 order by id desc";  
               //order by id desc latest added....
       }
       else
       { 
       	
       	if($rowscn>0)
       	{
       	        $queryn="select *,count( * ) from (select * from message_list where  ((from_id='25' || from_id='$idc') && to_id='$id' ) order by id desc) as m GROUP BY from_id  HAVING count( * ) >= 1 order by id desc";  
       	}
       	else 
       	{
       	       $queryn="select *,count( * ) from (select * from message_list where  ((from_id='25' || from_id='$idc') ) order by id desc) as m GROUP BY from_id  HAVING count( * ) >= 1 order by id desc";  
       		
       	}
       }
	                $resultn = $this->select($queryn);
                     $rowsn	= $this->rows($resultn);
    
                     
                     if($rowsn>0)
                     {
                     		$valuesn=$this->fetch_array($resultn);
          	              //  $media=$valuesn[0]['media'];
                             foreach ($valuesn as $valuen){
          
                                //$data_getn[]=array("id"=>$valuen['id'],"media"=>$valuen['media']);
                                $data_getn[]=array("from_id"=>$valuen['from_id'],"to_id"=>$valuen['to_id'],"message"=>$valuen['message'],"name"=>$valuen['name'],"image"=>$valuen['image'],"usertype"=>$valuen['usertype'],"created_date"=>$valuen['created_date']);
                                
         
                            }
          	                $data['recordn']=$data_getn;
          	                $data['Result']='Success';
          	                echo json_encode($data);
                     }
                     else
                     {
                     	$response	= '{"Result":"Failure","Message":"Not able to get the Messages}';
	                    echo $response;
                     }
        
    }
	
  //to get for particular id messages /chat list
public function getidmessages($info) {
       $id=$info['id'];
       $tomine=$info['tomine'];
	  //   $queryn="select * from message_list where from_id='$id' || to_id='$id'  "; 
	  // $queryn="select * from message_list where (from_id='$tomine' && to_id='$id') || (from_id='$id' && to_id='$tomine')  order by id desc limit 4";  //order by asc or desc limit4 given............
	  $queryn="SELECT * FROM (select * from message_list where (from_id='$tomine' && to_id='$id') || (from_id='$id' && to_id='$tomine') ORDER BY id DESC) sub ORDER BY id ASC"; //LIMIT 10
	   $resultn = $this->select($queryn);
                     $rowsn	= $this->rows($resultn);
    
                     
                     if($rowsn>0)
                     {
                     		$valuesn=$this->fetch_array($resultn);
          	              //  $media=$valuesn[0]['media'];
                             foreach ($valuesn as $valuen){
          
                                //$data_getn[]=array("id"=>$valuen['id'],"media"=>$valuen['media']);
                                $data_getn[]=array("from_id"=>$valuen['from_id'],"to_id"=>$valuen['to_id'],"message"=>$valuen['message'],"name"=>$valuen['name'],"image"=>$valuen['image'],"created_date"=>$valuen['created_date']);
                                
         
                            }
          	                $data['recordn']=$data_getn;
          	                $data['Result']='Success';
          	                echo json_encode($data);
                     }
                     else
                     {
                     	$response	= '{"Result":"Failure","Message":"Not able to get the particular Message"}';
	                    echo $response;
                     }
        
          
          
        
    }
  //to get for particular id messages /chat list
public function getsavemessages($info) {
          $from_id=$info['from_id'];
          $to_id=$info['to_id'];
          $message=$info['message'];
          $name=$info['name'];
          $image=$info['image'];
          $usertype=$info['usertype'];
         // $created_date=$info['date1'];
          
          $created_date=date('Y-m-d H:i:s');
          
          $data=array("from_id"=>$from_id,"to_id"=>$to_id,"message"=>$message,"name"=>$name,"image"=>$image,"usertype"=>$usertype,"created_date"=>$created_date);
          
          $result1	= $this->insert('message_list',$data);       
	  
                if($result1){
                             $data['Result']='Success';
          	                 echo json_encode($data);
                     }
                else {
             	$response	= '{"Result":"Failure","Message":"Message not saved"}';
	            echo $response;
                }
          
        
    }
 //to send/save the appointment details from reg users /guest users............
public function appointment_submit($info) {
          $dateappoint=$info['dateappoint'];
          $nameappoint=$info['nameappoint'];
          $emailappoint=$info['emailappoint'];
          $phoneappoint=$info['phoneappoint'];
          $subappoint=$info['subappoint'];
          $remarks=trim($info['remarks']);
          $image=trim($info['image']);
          $created_date=date('Y-m-d H:i:s');
          
	      $data=array("appointmentdate"=>$dateappoint,"username"=>$nameappoint,"email"=>$emailappoint,"phone"=>$phoneappoint,"subject"=>$subappoint,"remarks"=>$remarks,"created_date"=>$created_date,"image"=>$image);
          $result=$this->insert('make_appointment',$data);  
          
          
       
           	 
           	 
              if($result){
              	
              	///to send mail to agent................
               $query1="select email from agent";
          
             $result1 	= $this->select($query1);
             $rows1		= $this->rows($result1);
        
          
          if ($rows1>0) {
          	  $values1=$this->fetch_array($result1);
          	if($values1){
          		$from=$nameappoint;
          		$email=$values1[0]['email'];
          		$to=$email;
          		//$subject="Appointment Details:";
          		$message1="username:".$nameappoint."     on Date:".$dateappoint;
          		//$message = " </br> </br> </br> </br> </br> Hi ,</br>";
          		//$message.= "You got the appointment details from user ".$nameappoint."</br>";
          		//$message.= "On ".$dateappoint."</br>";
          		//$message.= "Make process either to approve/reject from view list appoint.".$dateappoint."</br>";
          		
             $mail=$this->sendmail($to,$message1,$from);  //send mail
          //   $mail=mail($to,$subject,$message);
          	         if($mail)
          	          {
                       $data['Result']='Success';
          	           echo json_encode($data);
                      }
                else {
                	   $data['Result']='Success';
          	           echo json_encode($data);
             //	$response	= '{"Result":"Failure","Message":"Appointment details mail not send"}';
	         //   echo $response;
                }  //mail
          	}
         else 
         {
         		$response	= '{"Result":"Failure","Message":"No agent mail id is there."}';
	            echo $response;
         }   //values1
          
          }  //rows
          else
          {
               	$response	= '{"Result":"Failure","Message":"No agent"}';
	            echo $response;
          } ///no rows
          
              } ///result
              else 
              {
               	$response	= '{"Result":"Failure","Message":"Appointment details not saved"}';
	            echo $response;
              }
    }
   //to get all appointment details list
public function getallappointments($info) {
               $id=$info['id'];

    //$queryn="select * from make_appointment ma join register_guest_users rg where rg.email=ma.email"; //first left,inner
    // $queryn="select * from make_appointment ma join register_guest_users rg where rg.flag=ma.flag";
    $queryn="select * from make_appointment where setenable!=1 order by id  desc";
	$resultn = $this->select($queryn);
                     $rowsn	= $this->rows($resultn);
    
                     
                     if($rowsn>0)
                     {
                     		$valuesn=$this->fetch_array($resultn);
          	              //  $media=$valuesn[0]['media'];
                             foreach ($valuesn as $valuen){
          
                                //$data_getn[]=array("id"=>$valuen['id'],"media"=>$valuen['media']);
                            //    $data_getn[]=array("username"=>$valuen['username'],"email"=>$valuen['email'],"photoimage"=>$valuen['photoimage'],"appointmentdate"=>$valuen['appointmentdate'],"id"=>$valuen['id'],"remarks"=>$valuen['remarks']);
                                
                              $data_getn[]=array("username"=>$valuen['username'],"email"=>$valuen['email'],"image"=>$valuen['image'],"appointmentdate"=>$valuen['appointmentdate'],"id"=>$valuen['id'],"remarks"=>$valuen['remarks']);
                             	
                            }
          	                $data['recordn']=$data_getn;
          	                $data['Result']='Success';
          	                echo json_encode($data);
                     }
                     else
                     {
                     	$data_getn="";
                        $data['recordn']=$data_getn;
                        $data['Result']='Failure';
          	            echo json_encode($data); 
                     //	$response	= '{"Result":"Failure","Message":"Not able to get the appointment details}';
	                 //   echo $response;
                     }
        
    }
   //remove /delete appointment from  view appointment manage........
public function rejectappointment($info) {
         $id=$info['id'];
	  
            $condition1="id='$id'";
            $result1=$this->delete('make_appointment',$condition1);
         
              if($result1){
              	///to get mail based on id and send mail...............
          	           $queryn="select * from make_appointment where id='$id' ";
	                   $resultn = $this->select($queryn);
                       $rowsn	= $this->rows($resultn);
                       
                     
                     if($rowsn>0)
                     {
                     		$valuesn=$this->fetch_array($resultn);
          	                $emailid=$valuesn[0]['email'];
          	                 $subject = "Appointment details";

                             $message = "Hai,";
                              $message.="Sorry! Your Appointment details rejected.";

                              $headers  = 'MIME-Version: 1.0' . "\r\n";
                              $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                              $headers .= 'From: Noreply <noreply@example.com>' . "\r\n";

                             $mail = mail($emailid, $subject, $message, $headers);
                     }
          	          	///////////////////////////
                             $data['Result']='Success';
          	                 echo json_encode($data);
                     }
                else {
                		$data_getn="";
                        $data['recordn']=$data_getn;
                        $data['Result']='Failure';
          	            echo json_encode($data); 
             	//$response	= '{"Result":"Failure","Message":"Appointment not rejected"}';
	            //echo $response;
                }
              
        
    }
 //to get all appointment details with dates to check block or not.....
public function getallappointmentswithdate($info) {
          $dateappoint=$info['dateappoint'];
          $timeappoint=$info['timeappoint'];
	  
    $queryn="select * from make_appointment where appointmentdate='$dateappoint' ";
	$resultn = $this->select($queryn);
    $rowsn	= $this->rows($resultn);
    
    
    $queryn7="select * from appointmentdate_block where blockdate='$dateappoint'";
	$resultn7 = $this->select($queryn7);
    $rowsn7	= $this->rows($resultn7);
    
 if($rowsn7>0)
                     {
                     	
                     		$valuesn7=$this->fetch_array($resultn7);
                             foreach ($valuesn7 as $valuen7){
          
                                $data_getn7[]=array("timeblock"=>$valuen7['timeblock']);
                             	$timeblockval=$valuen7['timeblock'];
                            }
          	               if($timeblockval=='00:00:00')
          	               {
          	                $queryn1="select * from appointmentdate_block where blockdate='$dateappoint'";
	$resultn1 = $this->select($queryn1);
    $rowsn1	= $this->rows($resultn1);
          	               }
          	               else 
          	               {
          	                $timestamp = strtotime($timeappoint) - 60*60*60;  //front add means here -
    $time = date('H:i:s', $timestamp);
    //$queryn1="select * from appointmentdate_block where (blockdate='$dateappoint') && (timeblock='$timeappoint' || timeblock='$time') ";
	$queryn1="select * from appointmentdate_block where (blockdate='$dateappoint') && (timeblock='$timeappoint' || (TIMEDIFF('$timeappoint',timeblock) < '01:00:00') && '$timeappoint'>timeblock) ";
    $resultn1 = $this->select($queryn1);
    $rowsn1	= $this->rows($resultn1);  //need to check calc.
          	               }
                    
    
    /*
                     if($timeappoint=='00:00:00')
    {
    $queryn1="select * from appointmentdate_block where blockdate='$dateappoint'";
	$resultn1 = $this->select($queryn1);
    $rowsn1	= $this->rows($resultn1);
    }
    else 
    {
    $timestamp = strtotime($timeappoint) - 60*60*60;  //front add means here -
    $time = date('H:i:s', $timestamp);
    $queryn1="select * from appointmentdate_block where (blockdate='$dateappoint') && (timeblock='$timeappoint' || timeblock='$time') ";
	$resultn1 = $this->select($queryn1);
    $rowsn1	= $this->rows($resultn1);
    }
    
  */   //correct                
                       /*
                     if($rowsn>0)
                     {
                     		$valuesn=$this->fetch_array($resultn);
                             foreach ($valuesn as $valuen){
          
                                $data_getn[]=array("username"=>$valuen['username'],"email"=>$valuen['email'],"image"=>$valuen['image'],"appointmentdate"=>$valuen['appointmentdate'],"id"=>$valuen['id'],"remarks"=>$valuen['remarks']);
                             	
                            }
          	                $data['recordn']=$data_getn;
          	                $data['Result']='Success';
          	                echo json_encode($data);
                     }
                     */
              
                     if($rowsn1>0)
                     {
                     	
                     		$valuesn1=$this->fetch_array($resultn1);
                             foreach ($valuesn1 as $valuen1){
          
                                $data_getn1[]=array("blockdate"=>$valuen1['blockdate'],"timeblock"=>$valuen1['timeblock']);
                             	
                            }
          	                $data['recordn1']=$data_getn1;
          	                $data['Result']='Success';
          	                echo json_encode($data);
                     }
                     else
                     {
                     	
                     	$data_getn="";
                        $data['recordn']=$data_getn;
                        $data['Result']='Failure';
          	             echo json_encode($data);
                     //	$response	= '{"Result":"Failure","Message":"Not able to get the appointment details particular date}';
	                 //  echo $response;
                     }
                     } //last else need but no such situation.
          else 
          {
          	            $data_getn="";
                        $data['recordn']=$data_getn;
                        $data['Result']='Failure';
          	             echo json_encode($data);
          
          }
        
    }
     //to send/save the appointment blocked  details from reg users /guest users............
public function appointmentblock_submit($info) {
          $dateappoint=$info['dateappoint'];
          $timeappoint=$info['timeappoint'];
                 
	      $data=array("blockdate"=>$dateappoint,"timeblock"=>$timeappoint);
          
           ///////////////////
    $queryn7="select * from appointmentdate_block where blockdate='$dateappoint' && timeblock='$timeappoint' ";
	$resultn7 = $this->select($queryn7);
    $rowsn7	= $this->rows($resultn7);
    
                     if($rowsn7>0)
                     {
                      $response	= '{"Result":"Failure","Message":"Appointment details not saved"}';
	                  echo $response;
                     }
                     else 
                     {
 
          $result=$this->insert('appointmentdate_block',$data);  
          
                      if($result)
          	          {
                       $data['Result']='Success';
          	           echo json_encode($data);
          	          }
          	          else
          	          {
          	          $response	= '{"Result":"Failure","Message":"Appointment details not saved"}';
	                  echo $response;
          	          }
                     }
}
 //share link................
public function sharelinkmail($info) {
          $emailidshare=$info['emailidshare'];
    $subject = "SG Homey App Link";

$message = "Hai,";
//$message.="http://install.diawi.com/8zT3KX";
//$message.="http://install.diawi.com/pZVovJ";


$message.="IPA Link: http://install.diawi.com/xGJxW1";
$message.="Android Link: http://install.diawi.com/xGJxW1";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Noreply <noreply@example.com>' . "\r\n";

$mail = mail($emailidshare, $subject, $message, $headers);
                       if($mail)
          	          {
                       $data['Result']='Success';
          	           echo json_encode($data);
                      }
                else {
                	  
             	$response	= '{"Result":"Failure","Message":"Appointment details mail not send"}';
	            echo $response;
                }  //mail
        
    }
  //accept  appointment details from appointment........
public function acceptappointment($info) {
         $id=$info['id'];
         $setenable=1;
	  
         

          $data=array("setenable"=>$setenable);
          $condition="id='$id'";
         // $result=$this->update('make_appointment',$data,$condition);  
          
          $resultquery="update make_appointment set setenable='$setenable' where id='$id' ";
          $result = $this->select($resultquery);
          
                      if($result)
          	          {
          	          	///to get mail based on id and send mail...............
          	           $queryn="select * from make_appointment where id='$id' ";
	                   $resultn = $this->select($queryn);
                       $rowsn	= $this->rows($resultn);
                       
                     
                     if($rowsn>0)
                     {
                    
                     	//$sqlk = "SELECT email FROM make_appointment WHERE id='$id' ";
                        //$resultk = mysql_query($sqlk);
                       //  $valuek= mysql_fetch_object($resultk);
                       //   $emailid=$valuek;
                       
                     		$valuesn=$this->fetch_array($resultn);
          	                $emailid=$valuesn[0]['email'];
          	                
          	                 $subject = "Appointment details";

                             $message = "Hai,";
                             $message.="Your Appointment details accepted.";

                              $headers  = 'MIME-Version: 1.0' . "\r\n";
                              $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                              $headers .= 'From: Noreply <noreply@example.com>' . "\r\n";

                             $mail = mail($emailid, $subject, $message, $headers);
                             
                             /*
                             if($mail)
                             {
                                $data['Result']='Success';
          	                     echo json_encode($data);
                             }
                             else 
                             {
                         $response	= '{"Result":"Failure","Message":"Appointment details not updated"}';
	                    echo $response; 
                             }
                             */
                             
                     }
          	          	///////////////////////////
          	          	 $data['Result']='Success';
          	             echo json_encode($data);
                    
          	          }
          	          else
          	          {
          	          $response	= '{"Result":"Failure","Message":"Appointment details not updated"}';
	                  echo $response;
          	          }
          
        
    }
  //get all news blog
public function getallnews($info) {
         $id=$info['id'];
	  
          $queryn="select * from News_app order by id desc limit 4";
	      $resultn = $this->select($queryn);
          $rowsn	= $this->rows($resultn);
    
                     
                     if($rowsn>0)
                     {
                     		$valuesn=$this->fetch_array($resultn);
          	              //  $media=$valuesn[0]['media'];
                             foreach ($valuesn as $valuen){
          
                                //$data_getn[]=array("id"=>$valuen['id'],"media"=>$valuen['media']);
                                $data_getn[]=array("title"=>$valuen['title'],"description"=>$valuen['description'],"image"=>$valuen['image'],"created_date"=>$valuen['created_date'],"user"=>$valuen['user'],"username"=>$valuen['username']);
                                
         
                            }
          	                $data['recordn']=$data_getn;
          	                $data['Result']='Success';
          	                echo json_encode($data);
                     }
                     else
                     {
                     	$response	= '{"Result":"Failure","Message":"Not able to get the News blog"}';
	                    echo $response;
                     }
        
         
    
        
    }
  //submit/save news blog.
public function submitnewsblog($info) {
         $id=$info['id'];
         $title=$info['title'];
         $descript=$info['descript'];
         $username=$info['username'];
         $created_date=date('Y-m-d H:i:s');
	  
          $data=array("user"=>$id,"title"=>$title,"description"=>$descript,"created_date"=>$created_date,"username"=>$username);
          $result=$this->insert('News_app',$data);  
          
                      if($result)
          	          {
                       $data['Result']='Success';
          	           echo json_encode($data);
          	          }
          	          else
          	          {
          	          $response	= '{"Result":"Failure","Message":"News blog  not saved"}';
	                  echo $response;
          	          }
          
        
    }
  //get account details..........for settings.........
public function getaccountdetails($info) {
         $id=$info['id'];
      
    $queryn="select * from register_guest_users where guestid='$id' ";  // && group='$group' ---property_type
	                 $resultn = $this->select($queryn);
                     $rowsn	= $this->rows($resultn);
                     
                       $queryn1="select * from agent where id='$id' ";  // && group='$group' ---property_type
	                 $resultn1 = $this->select($queryn1);
                     $rowsnn	= $this->rows($resultn1);
                     
   
                     if($rowsn>0)
                     {
                     		$valuesn=$this->fetch_array($resultn);
          	            
                            foreach ($valuesn as $valuen){
          
                                $data_getn[]=array("id"=>$valuen['guestid'],"username"=>$valuen['username'],"phone"=>$valuen['mobile'],"email"=>$valuen['email'],"password"=>$valuen['password'],"address"=>$valuen['address']);
         
                            }
          	                $data['recordn']=$data_getn;
          	                $data['Result']='Success';
          	                echo json_encode($data);
                     }
                 
                     	
                   
                     
                    else if($rowsnn>0)
                     {
                     $valuesn1=$this->fetch_array($resultn1);
          	            
                            foreach ($valuesn1 as $valuen1){
          
                                $data_getn1[]=array("id"=>$valuen1['id'],"username"=>trim($valuen1['name']),"phone"=>$valuen1['contact_mobile'],"email"=>$valuen1['email'],"password"=>$valuen1['password'],"address"=>$valuen1['address']);
         
                            }
          	                $data['recordnn']=$data_getn1;
          	                $data['Result']='Success';
          	                echo json_encode($data);
                     }
                     
                     else
                     {
                     	 $data['Result']='Failure';
          	             echo json_encode($data);
                     }
     
                     
                     
          
        
    }
 //get linked in login details from linkedin
public function getlinkedindetails($info) {
        $username=$info['username'];
        $email=$info['email'];
        $image=$info['image'];
         
    //    if($_SESSION['username']) {$username=$_SESSION['username'];}else{$username="";}
    //   if($_SESSION['email']) {$email=$_SESSION['email'];}else{$email="";}
     //   if($_SESSION['image']) {$image=$_SESSION['image'];}else{$image="";}

      
	  
         if($email!="")
         {
          $query="select * from register_guest_users where email='$email' ";  //before..
          $result 	= $this->select($query);
          $rows		= $this->rows($result);
          
         // $query1="select * from admin where email='$email_id' ";  //before..
         $query1="select * from agent where email='$email' ";  //before..
          $result1 	= $this->select($query1);
          $rows1		= $this->rows($result1);
          
          
         if($rows1>0)
          	{
          		$data['recordmsg']='agent';
          		 $data['Result']='Success';
          	     echo json_encode($data);
          	}
          	
         else if($rows>0) {
          	$data['recordmsg1']='registeruser';
            $data['Result']='Success';
          	echo json_encode($data);
        
          }
          
          else 
          {
          $data=array("username"=>$username,"email"=>$email,"photoimage"=>$image);
          $result=$this->insert('register_guest_users',$data); 
          
          $queryn="select * from register_guest_users where email='$email' ";  // && group='$group' ---property_type
	                 $resultn = $this->select($queryn);
                     $rowsn	= $this->rows($resultn);
                     
   
                     if($rowsn>0)
                     {
                     		$valuesn=$this->fetch_array($resultn);
          	            
                            foreach ($valuesn as $valuen){
          
                                $data_getn[]=array("username"=>$valuen['username'],"email"=>$valuen['email'],"image"=>$valuen['photoimage']);
         
                            }
          	                $data['recordn']=$data_getn;
          	                $data['Result']='Success';
          	                echo json_encode($data);
                     }
                      else
                     {
                     	 $data_getn="";
                     	 $data['recordn']=$data_getn;
                     	 $data['Result']='Failure';
          	             echo json_encode($data);
                     }
          }
         }
         else
         {
         	 $data_getn="";
                     	 $data['recordn']=$data_getn;
                     	 $data['Result']='Failure';
          	             echo json_encode($data);
         }
                 
        
    }
     //get postproperty list cobroke.............all.....
 public function getpostpropertycobroke($info) {
 	   //  $id=$info['id'];
	     $date = date('Y-m-d H:i:s');
 	     
 	
 //  $query="select property.*,property_location.*,property_details.*,property_media.* from property,property_location,property_details,property_media where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 group by property.property_id order by property.property_id desc";
 // $query="select property.*,property_location.*,property_details.*,property_media.*,property_type.* from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 and property.property_type=property_type.id group by property.property_id order by property.property_id desc";

	     //mine correct one 4_8_14
	     //   $query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property_details.property_id and activate=1 and cover_image=1 and property.property_type=property_type.id  group by property.property_id order by property.property_id desc";
	    // $query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type from property,property_location,property_details,property_media,property_type where  property.property_id=property_location.property_id and property_media.property_id=property.property_id and property_details.property_id=property.property_id and property.activate=1 and property.co_broke=1  and property.property_type=property_type.id  group by property.property_id order by property.property_id desc";  //and property_media.cover_image=1

$query="select property.*,property_location.streetname,property_details.bathrooms,property_details.description,property_media.media,property_type.id,property_type.type from property left join property_location on  property.property_id=property_location.property_id  left join property_details  on  property_details.property_id=property.property_id  left join property_media on  property_media.property_id=property.property_id left join property_type  on property.property_type=property_type.id 
where  property.activate=1 and  property.co_broke=1 group by property.property_id order by property.property_id desc";
	    
	    //$query="select * from property where activate=1";
	     //to inlcude property type i changed. 
  $result 	= $this->select($query);
   $rows	= $this->rows($result);
     
          if($rows>0)
          {
          	
           $values=$this->fetch_array($result);
            
          foreach ($values as $value){
          
         $data_get[]=array("agent"=>$value['agent'],"price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"front_status"=>$value['front_status'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id']);
        // $data_get[]=array("price"=>$value['asking_price'],"floor_area"=>$value['floor_area'],"streetname"=>$value['streetname'],"address"=>$value['address'],"description"=>$value['description'],"media"=>$value['media'],"rooms"=>$value['rooms'],"bathrooms"=>$value['bathrooms'],"listing_type"=>$value['listing_type'],"type"=>$value['type'],"property_id"=>$value['property_id']);
           $ss=$value['agent'];
          
        
          }
           $query7="select * from agent where id='$ss' ";
     
          $result7 = mysql_query($query7);
            $rows7	= $this->rows($result7);
            if($rows7>0)
            {
              $values7=$this->fetch_array($result7);
            
          foreach ($values7 as $value7){
          
         $data_get7[]=array("image"=>$value7['image'],"name"=>$value7['name']);
         $data['record7']=$data_get7;
          
          	
          }
            }
            else 
            {
            $data['record7']="";
            } 
           $data['record']=$data_get;
          
            /*
            ///for agent img purpose
            $query7="select * from agent where id='$id' ";
            $result7 = mysql_query($query7);
            $rows7	= $this->rows($result7);
            if($rows7>0)
            {
              $values7=$this->fetch_array($result7);
            
          foreach ($values7 as $value7){
          
         $data_get7[]=array("image"=>$value7['image']);
         $data['record7']=$data_get7;
          	
          }
            }
            else 
            {
            $data['record7']="";
            }
            /////////////

          */           
            $data['Result']='Success';
          	echo json_encode($data);
          }
       else 
          {
          $data['Result']='Failure';
          	echo json_encode($data);
          }
        
    }
 ///get all the blocked dates...........................
	public function getblockeddates() {

     $queryn="select * from appointmentdate_block where timeblock='00:00:00' ";
	      $resultn = $this->select($queryn);
          $rowsn	= $this->rows($resultn);
    
                     
                     if($rowsn>0)
                     {
                     		$valuesn=$this->fetch_array($resultn);
          	              //  $media=$valuesn[0]['media'];
                             foreach ($valuesn as $valuen){
          
                                //$data_getn[]=array("id"=>$valuen['id'],"media"=>$valuen['media']);
                                $data_getn[]=array("blockdate"=>$valuen['blockdate'],"timeblock"=>$valuen['timeblock'],"id"=>$valuen['id']);
                                
         
                            }
          	                $data['recordn']=$data_getn;
          	                $data['Result']='Success';
          	                echo json_encode($data);
                     }
                     else
                     {
                     	$response	= '{"Result":"Failure","Message":"Not able to get the blocked dates"}';
	                    echo $response;
                     }
        
      
       }
///get about us description.............
	public function getaboutdes() {

    	 $queryn="select * from agent";
	      $resultn = $this->select($queryn);
          $rowsn	= $this->rows($resultn);
    
                     
                     if($rowsn>0)
                     {
                     		$valuesn=$this->fetch_array($resultn);
          	              //  $media=$valuesn[0]['media'];
                             foreach ($valuesn as $valuen){
          
                                //$data_getn[]=array("id"=>$valuen['id'],"media"=>$valuen['media']);
                                $data_getn[]=array("abouttitle"=>$valuen['abouttitle'],"aboutdescription"=> html_entity_decode($valuen['aboutdescription']));
                                
         
                            }
          	                $data['recordn']=$data_getn;
          	                $data['Result']='Success';
          	                echo json_encode($data);
                     }
                     else
                     {
                     	$response	= '{"Result":"Failure","Message":"Not able to get the about us"}';
	                    echo $response;
                     }
        
      
       }
    ////////////////////////
 }
 
 $st_response = new st_response();
?>