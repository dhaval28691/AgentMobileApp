<?php

include "db_config.php";
/**
 * A class file to connect to database
 */
class DB_CONNECT {

    // constructor
    function __construct() {
        // connecting to database
        $this->connect();
        
    }

    // destructor
    function __destruct() {
        // closing db connection
        $this->close();
    }

    /**
     * Function to connect with database
     */
    function connect() {
    	// Connecting to mysql database
        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());

        // Selecing database
        $db = mysql_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error());

        // returing connection cursor
        return $con;
    }

    /**
     * Function to close db connection
     */
    function close() {
        // closing db connection
        mysql_close();
    }
    
	function execute_query($query) {
		$result = mysql_query($query);
		return $result;
	}
	
	function insert($table,$data) {
		foreach($data as $key=>$val) {
			$fields[]=$key."='".$val."'";	
		}
		$col	= implode($fields,",");
		$query	= "insert into $table set $col";
		$result	= $this->execute_query($query);
		return $result;
	}
	
	function select($query) {
		return $this->execute_query($query);
	}
	
	function update($table,$data,$condition) {
		foreach($data as $key=>$val) {
			$fields[]=$key."='".$val."'";	
		}
		$col	= implode($fields,",");
	//	foreach($condition as $key=>$val) {
	//		$fields[]=$key."='".$val."'";	
	//	}
		//$condition=implode($fields,",");
		$query	= "update $table set $col where $condition";
		$result	= $this->execute_query($query);
		$result=mysql_affected_rows();  //return by sra on 30-6-14 
		
		return $result;
	}
	
	function delete($table,$condition) {
		$query	= "delete from $table where $condition";
		return $this->execute_query($query);
	}
	
	function rows($query) {
		$rows = mysql_num_rows($query);
		return $rows;
		
	}
	
	function fetch_array($query) {
		
		while($result=mysql_fetch_array($query)) {
			$response[] = $result;
		}
		return $response;
		
	}
	function sendmail1($to,$newpassword)
	{
  //  $to     = 'nobody@example.com';
   $to=$to;
   $subject = 'Password Recovery';
   $message = 'Hai,\n';
   $message.= 'Your recovery password is:'.$newpassword;
   $message.= 'Now you can continue your accessing with this password.';
   
   
   $headers = 'From: dhavalthakor28691@gmail.com' . "\r\n" .
    'Reply-To: dhavalthakor28691@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
  mail($to, $subject, $message, $headers);
	}
	function sendmail($to,$message1,$from)
	{

   $to=$to;
   $message1=$message1;
   
   
   $subject = 'Appointment Details';
   $message = 'Hai, ';
   $message.= 'Appointment details as follows:         '.$message1;
  
 
    $from=$from;
    $headers = 'From:'.$from. "\r\n" .
     'Reply-To:'.$to. "\r\n" .
     'X-Mailer: PHP/' . phpversion();

    //error_reporting(E_ALL);
   //ini_set('display_errors', '1');
  $mail=mail($to, $subject, $message, $headers);
  
  return $mail;

	}
}

//$DB_CONNECT=new DB_CONNECT();
?>
