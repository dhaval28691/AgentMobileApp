<?php
class st_request {

	protected $_vars;
    protected $_url;
    protected $_action;
    protected $_data;

    public function __construct() {
	    $this->_action = $_REQUEST['action'];
	     
	    if (!empty($this->_action)) {
	   
	   $base_url=$_SERVER['SERVER_NAME']; //.$_SERVER['REQUEST_URI']; 
	 
	
	 $this->_url  = $base_url.'/AgentMobileApp/property/WS/p_response.php?action='.$this->_action;  //local & server.
	// $this->_url  = $base_url.'/property/WS/p_response.php?action='.$this->_action;  //server
	 ///for server property.....

	    	call_user_func_array(array($this,$this->_action),array()); //action name, param eg array("param1","param2") and so on....
	    } else {
	        echo json_encode(array('No method occur'));
	    }
    }
        
    public function register() {
    	
    	//$firstname		= $_POST['firstname'];
    	//$lastname		= $_POST['lastname'];
    	$username		= $_POST['username'];
    	$email_id		= $_POST['email'];
    	$password		= $_POST['password'];
    	$mobile		    = $_POST['mobile'];
    	$address		= $_POST['address'];
    	$photoimage	= $_POST['photoimage'];  //direct post.
        $photoimage=trim($photoimage);
        
        
        
     //  $trimdata = '{"firstname":"'.$firstname.'","lastname":"'.$lastname.'","email_id":"'.$email_id.'","password":"'.$password.'","address":"'.$address.'","photoimage":"'.$photoimage.'"}';
         $trimdata = '{"username":"'.$username.'","email_id":"'.$email_id.'","password":"'.$password.'","mobile":"'.$mobile.'","address":"'.$address.'","photoimage":"'.$photoimage.'"}';
    	
       $this->_data = trim($trimdata);
      

    	$info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
        /*echo "<pre>";
        print_r($response);
        echo "</pre>";*/
        
    }
    
   ///login..............
	public function login() {

    	$email_id		= $_POST['email'];
    	$password		= $_POST['password'];
   	
	    $this->_data 	= '{"email_id":"'.$email_id.'","password":"'.$password.'"}';
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
      
       }

    ///whil register check unique email
public function loginwithfb() {

    	$email_id		= $_POST['email'];
    
    	
        $this->_data 	= '{"email_id":"'.$email_id.'"}';
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
        /*echo "<pre>";
        print_r($response);
        echo "</pre>";*/
		
        
    }
//update profile
public function update_profile1() {
          
	    $userid=$_POST['userid'];
        $firstname= $_POST['firstname'];
        $lastname= $_POST['lastname'];
        $email= $_POST['email'];
        
       // $phone		    = $_POST['phone'];
    	$address		= $_POST['address'];
    	
       // $photoimage	= $_POST['photoimage'];  //direct post.
        $photoimage=trim($photoimage);
        /*
	    $userid="3";
        $firstname="sss1";
        $lastname= "sss";
        */

        //$this->_data 	= '{"userid":"'.$userid.'","firstname":"'.$firstname.'","lastname":"'.$lastname.'","email":"'.$email.'"}';
       $this->_data 	= '{"userid":"'.$userid.'","firstname":"'.$firstname.'","lastname":"'.$lastname.'","email":"'.$email.'","address":"'.$address.'"}';
        
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
          
        
    }    
    
  ///get post property list..............
	public function getpostproperty() {

    	// $id=$_POST['id'];
	  
        //  $this->_data 	= '{"id":"'.$id.'"}';
   	
	    //$this->_data 	= '{"email_id":"'.$email_id.'","password":"'.$password.'"}';
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
      
       }
///get post property list sale names..............
	public function getpostpropertysale() {

    	
   	
	    //$this->_data 	= '{"email_id":"'.$email_id.'","password":"'.$password.'"}';
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
      
       }
       
///get post property list sale names by click on sale name..............
	public function getpostproperty_bysaleclick() {

    	
   	    $property_id=$_POST['property_id'];
	    $this->_data 	= '{"property_id":"'.$property_id.'"}';
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
      
       }
///get post property list rent names..............
	public function getpostpropertyrent() {

    	
   	
	    //$this->_data 	= '{"email_id":"'.$email_id.'","password":"'.$password.'"}';
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
      
       }
///get post property list sale names by click on rent name..............
	public function getpostproperty_byrentclick() {

    	
   	    $property_id=$_POST['property_id'];
	    $this->_data 	= '{"property_id":"'.$property_id.'"}';
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
      
       }
///get post property list sold names..............
	public function getpostpropertysold() {

    	
   	
	    //$this->_data 	= '{"email_id":"'.$email_id.'","password":"'.$password.'"}';
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
      
       }
///get post property list sale names by click on sold name..............
	public function getpostproperty_bysoldclick() {

    	
   	    $property_id=$_POST['property_id'];
	    $this->_data 	= '{"property_id":"'.$property_id.'"}';
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
      
       }
///get post property list details based on property click..............
	public function getpropertylist_details() {

    	
   	    $property_id=$_POST['property_id'];
	    $this->_data 	= '{"property_id":"'.$property_id.'"}';
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
      
       }
///save new property details..............
	public function create_new_propertysave() {

    	
   	    //$property_id=$_POST['property_id'];
   	    $title=$_POST['title'];
   	    $address=$_POST['address'];
   	    $price=$_POST['price'];
   	    $district=$_POST['district'];
   	    $type=$_POST['type'];
   	    $postcode=$_POST['postcode'];
   	    $area=$_POST['area'];
   	    $description=$_POST['description'];
   	    $rooms=$_POST['rooms'];
   	    $bathrooms=$_POST['bathrooms'];
   	    $listing_type=$_POST['listing_type'];
   	    
   	     $imageprop=trim($_POST['imageprop']);
   	     $guestid=$_POST['guestid'];
   	     
   	    $a1=$_POST['a1'];
   	    $a2=$_POST['a2'];
   	    $a3=$_POST['a3'];
   	    $a4=$_POST['a4'];
   	    
   	     $cobroke=$_POST['cobroke'];
   	    
   	    //$guestid=$_POST['guestid'];
   	   // $facilities=$_POST['facilities'];
   	    
	//    $this->_data 	= '{"title":"'.$title.'","address":"'.$address.'","price":"'.$price.'","district":"'.$district.'","type":"'.$type.'","postcode":"'.$postcode.'","area":"'.$area.'","description":"'.$description.'","rooms":"'.$rooms.'","bathrooms":"'.$bathrooms.'","listing_type":"'.$listing_type.'","guestid":"'.$guestid.'","facilities":"'.$facilities.'"}';
    	   $this->_data 	= '{"title":"'.$title.'","address":"'.$address.'","price":"'.$price.'","district":"'.$district.'","type":"'.$type.'","postcode":"'.$postcode.'","area":"'.$area.'","description":"'.$description.'","rooms":"'.$rooms.'","bathrooms":"'.$bathrooms.'","listing_type":"'.$listing_type.'","imageprop":"'.$imageprop.'","guestid":"'.$guestid.'","a1":"'.$a1.'","a2":"'.$a2.'","a3":"'.$a3.'","a4":"'.$a4.'","cobroke":"'.$cobroke.'"}';
   	    
   	    $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
      
       }
       
//get dynamic pproperty types
public function getpropertytype() {
	
	  
	   // $this->_data 	= '{"userid":"'.$userid.'"}';
	 
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
    
        
    }
     //update profile
public function update_profile() {
          
	    $userid=$_POST['userid'];
        $firstname= $_POST['firstname'];
        $phone= $_POST['phone'];
        $email= $_POST['email'];
        $password= $_POST['password'];
      
        
       // $phone		    = $_POST['phone'];
    	$address		= $_POST['address'];
    	
     //   $photoimage	= $_POST['photoimage'];  //direct post.
     //   $photoimage=trim($photoimage);
        /*
	    $userid="3";
        $firstname="sss1";
        $lastname= "sss";
        */

        //$this->_data 	= '{"userid":"'.$userid.'","firstname":"'.$firstname.'","lastname":"'.$lastname.'","email":"'.$email.'"}';
      $this->_data 	= '{"userid":"'.$userid.'","firstname":"'.$firstname.'","email":"'.$email.'","address":"'.$address.'","phone":"'.$phone.'","password":"'.$password.'"}';
        
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
          
        
    }
     //get iamges to new property........
public function get_images_newproperty() {
          
	  
        
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
          
        
    }
 //remove iamges from property........
public function removeimages() {
         $id=$_POST['id'];
	  
          $this->_data 	= '{"id":"'.$id.'"}';
         
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
          
        
    }
 //remove /delete property from propertylist manage........
public function deleteproperty() {
         $id=$_POST['id'];
	  
          $this->_data 	= '{"id":"'.$id.'"}';
         
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
          
        
    }
 //to edit select property from propertylist manage........
public function getpropertylisttoedit() {
         $id=$_POST['id'];
	  
          $this->_data 	= '{"id":"'.$id.'"}';
         
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
          
        
    }
///edit/update  new property details..............
	public function update_propertyedit() {

    	
   	    //$property_id=$_POST['property_id'];
   	    $title=$_POST['title'];
   	    $address=trim($_POST['address']);
   	    $price=trim($_POST['price']);
   	    $district=trim($_POST['district']);
   	    $type=trim($_POST['type']);
   	    $postcode=trim($_POST['postcode']);
   	    $area=trim($_POST['area']);
   	    $description=trim($_POST['description']);
   	    $rooms=trim($_POST['rooms']);
   	    $bathrooms=trim($_POST['bathrooms']);
   	    $listing_type=trim($_POST['listing_type']);
   	    
   	    $imageprop=trim($_POST['imageprop']);
        $guestid=trim($_POST['guestid']);
   	     
        $a1=trim($_POST['a1']);
        $a2=trim($_POST['a2']);
  	    $a3=trim($_POST['a3']);
   	    $a4=trim($_POST['a4']);
   	    
   	     $id=$_POST['id'];
   	     $cobroke=$_POST['cobroke'];
   	    
   	    $guestid=$_POST['guestid'];
   	   // $facilities=$_POST['facilities'];
   	    
	 //$this->_data 	= '{"title":"'.$title.'","address":"'.$address.'","price":"'.$price.'","district":"'.$district.'","type":"'.$type.'","postcode":"'.$postcode.'","area":"'.$area.'","description":"'.$description.'","rooms":"'.$rooms.'","bathrooms":"'.$bathrooms.'","listing_type":"'.$listing_type.'","guestid":"'.$guestid.'","facilities":"'.$facilities.'"}';
    //$data1 	= '{"title":"'.$title.'","address":"'.$address.'","price":"'.$price.'","district":"'.$district.'","type":"'.$type.'","postcode":"'.$postcode.'","area":"'.$area.'","description":"'.$description.'","rooms":"'.$rooms.'","bathrooms":"'.$bathrooms.'","listing_type":"'.$listing_type.'","imageprop":"'.$imageprop.'","guestid":"'.$guestid.'","a1":"'.$a1.'","a2":"'.$a2.'","a3":"'.$a3.'","a4":"'.$a4.'","id":"'.$id.'"}}';
     $data1 	= '{"title":"'.$title.'","address":"'.$address.'","price":"'.$price.'","district":"'.$district.'","type":"'.$type.'","postcode":"'.$postcode.'","area":"'.$area.'","description":"'.$description.'","rooms":"'.$rooms.'","bathrooms":"'.$bathrooms.'","listing_type":"'.$listing_type.'","imageprop":"'.$imageprop.'","guestid":"'.$guestid.'","a1":"'.$a1.'","a2":"'.$a2.'","a3":"'.$a3.'","a4":"'.$a4.'","id":"'.$id.'","cobroke":"'.$cobroke.'"}';
         
   	     
   	   $this->_data=trim($data1);
    	   
   	    $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
      
       }
 //to get all messages /chat list
public function getallmessages() {
          $id=$_POST['id'];
	  
          $this->_data 	= '{"id":"'.$id.'"}';
	     $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
          
        
    }
 //to get for particular id messages /chat list
public function getidmessages() {
          $id=$_POST['id'];
          $tomine=$_POST['tomine'];
	  
          $this->_data 	= '{"id":"'.$id.'","tomine":"'.$tomine.'"}';
	      $info 			= $this->curl();
          $response 		= json_decode($info,true);
          echo $info;
          
        
    }
 //to get for particular id messages /chat list
public function getsavemessages() {
          $from_id=$_POST['from_id'];
          $to_id=$_POST['to_id'];
          $message=$_POST['message'];
          $name=$_POST['name'];
          $image=$_POST['image'];
          $usertype=$_POST['usertype'];
        //  $date1=$_POST['date1'];
          
	  
           //    $this->_data 	= '{"from_id":"'.$from_id.'","to_id":"'.$to_id.'","message":"'.$message.'","name":"'.$name.'","image":"'.$image.'","date1":"'.$date1.'"}';
          $this->_data 	= '{"from_id":"'.$from_id.'","to_id":"'.$to_id.'","message":"'.$message.'","name":"'.$name.'","image":"'.$image.'","usertype":"'.$usertype.'"}';
          $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
          
        
    }
 //to send/save the appointment details from reg users /guest users............
public function appointment_submit() {
          $dateappoint=$_POST['dateappoint'];
          $nameappoint=$_POST['nameappoint'];
          $emailappoint=$_POST['emailappoint'];
          $phoneappoint=$_POST['phoneappoint'];
          $subappoint=$_POST['subappoint'];
          $remarks=trim($_POST['remarks']);
          $image=$_POST['image'];
          //  $date1=$_POST['date1'];
          
	  
          $this->_data 	= '{"dateappoint":"'.$dateappoint.'","nameappoint":"'.$nameappoint.'","emailappoint":"'.$emailappoint.'","phoneappoint":"'.$phoneappoint.'","subappoint":"'.$subappoint.'","remarks":"'.$remarks.'","image":"'.$image.'"}';
          $info 			= $this->curl();
         $response 		= json_decode($info,true);
         echo $info;
          
        
    }
 //to get all appointment details.....
public function getallappointments() {
          $id=$_POST['id'];
	  
          $this->_data 	= '{"id":"'.$id.'"}';
	     $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
          
        
    }
 //remove /delete appointment details from appointment........
public function rejectappointment() {
         $id=$_POST['id'];
	  
          $this->_data 	= '{"id":"'.$id.'"}';
         
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
          
        
    }
//to get all appointment details with dates to check block or not.....
public function getallappointmentswithdate() {
          $dateappoint=$_POST['dateappoint'];
          $timeappoint=$_POST['timeappoint'];
	  
         $this->_data 	= '{"dateappoint":"'.$dateappoint.'","timeappoint":"'.$timeappoint.'"}';
	    $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
          
        
    }
 //to send/save the appointment blocked details from reg users /guest users............
public function appointmentblock_submit() {
          $dateappoint=$_POST['dateappoint'];
          $timeappoint=$_POST['timeappoint'];
         
          //  $date1=$_POST['date1'];
          
	  
          $this->_data 	= '{"dateappoint":"'.$dateappoint.'","timeappoint":"'.$timeappoint.'"}';
          $info 			= $this->curl();
         $response 		= json_decode($info,true);
         echo $info;
          
        
    }
 //share link................
public function sharelinkmail() {
          $emailidshare=$_POST['emailidshare'];
         
         $this->_data 	= '{"emailidshare":"'.$emailidshare.'"}';
         $info 		= $this->curl();
         $response 		= json_decode($info,true);
         echo $info;
          
        
    }
 //accept  appointment details from appointment........
public function acceptappointment() {
         $id=$_POST['id'];
	  
          $this->_data 	= '{"id":"'.$id.'"}';
         
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
          
        
    }
 //get all news blog
public function getallnews() {
         $id=$_POST['id'];
	  
          $this->_data 	= '{"id":"'.$id.'"}';
         
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
          
        
    }
 //submit/save news blog.
public function submitnewsblog() {
         $id=$_POST['id'];
         $title=$_POST['title'];
         $descript=$_POST['descript'];
         $username=$_POST['username'];
	  
         $this->_data 	= '{"id":"'.$id.'","title":"'.$title.'","descript":"'.$descript.'","username":"'.$username.'"}';
         
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
          
        
    }
 //get account details..........for settings.........
public function getaccountdetails() {
         $id=$_POST['userid'];
      
	  
         $this->_data 	= '{"id":"'.$id.'"}';
         
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
          
        
    }
//get linked in login details from linkedin
public function getlinkedindetails() {
    // if($_SESSION['username']) {$username=$_SESSION['username'];}else{$username="";}
   //   if($_SESSION['email']) {$email=$_SESSION['email'];}else{$email="";}
  //    if($_SESSION['image']) {$image=$_SESSION['image'];}else{$image="";}
   $email=$_POST['email'];
   $username=$_POST['username'];
   $image=$_POST['image'];
      
	  
         $this->_data 	= '{"username":"'.$username.'","email":"'.$email.'","image":"'.$image.'"}';
         
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
          
        
    }
///get post property list cobroke..............
	public function getpostpropertycobroke() {

    	// $id=$_POST['id'];
	  
        //  $this->_data 	= '{"id":"'.$id.'"}';
   	
	    //$this->_data 	= '{"email_id":"'.$email_id.'","password":"'.$password.'"}';
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
      
       }
///get all the blocked dates...........................
	public function getblockeddates() {

    	// $id=$_POST['id'];
	  
        //  $this->_data 	= '{"id":"'.$id.'"}';
   	
	    //$this->_data 	= '{"email_id":"'.$email_id.'","password":"'.$password.'"}';
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
      
       }
///get about us description.............
	public function getaboutdes() {

    	// $id=$_POST['id'];
	  
        //  $this->_data 	= '{"id":"'.$id.'"}';
   	
	    //$this->_data 	= '{"email_id":"'.$email_id.'","password":"'.$password.'"}';
        $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
      
       }
    /*
///save  amenties details..............
public function create_save_amen() {
        $a1=$_POST['a1'];
   	    $a2=$_POST['a2'];
   	    $a3=$_POST['a3'];
   	    $a4=$_POST['a4'];
        $this->_data 	= '{"a1":"'.$a1.'","a2":"'.$a2.'","a3":"'.$a3.'","a4":"'.$a4.'"}';
   	    
   	    $info 			= $this->curl();
        $response 		= json_decode($info,true);
        echo $info;
      
       }
  */  
    public function curl() {
            $ch = curl_init();

            curl_setopt($ch,CURLOPT_URL, $this->_url);
            curl_setopt($ch,CURLOPT_POST, count($this->_data));
            curl_setopt($ch,CURLOPT_POST, true);
            curl_setopt($ch,CURLOPT_POSTFIELDS, 'jsonData='.base64_encode($this->_data));
            //curl_setopt($ch,CURLOPT_HTTPHEADER, array('content-type => text/plain','content-length:200'));
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/20.0 (Linux; Android 4.1.1; Nexus 7 Build/JRO03D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Safari/535.19');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

            $info = curl_exec($ch);
            
            if($info === false) 
            { 
            
                return 'Curl error: ' . curl_error($ch); 

            } 
           
            curl_close($ch);
            return $info;
     }    
}



$st_request = new st_request();

/*
function base_url(){

    $baseUrl = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://'; // checking if the https is enabled

    $baseUrl .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv('HTTP_HOST'); // checking adding the host name to the website address

    return $baseUrl .= isset($_SERVER['SCRIPT_NAME']) ? dirname($_SERVER['SCRIPT_NAME']) : dirname(getenv('SCRIPT_NAME')); // adding the directory name to the created url and then returning it.

}

*/
?>
