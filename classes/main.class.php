<?php

    require_once('SimpleConfig.php');
    require_once('mysqldatabase.php');
    require_once('mysqlresultset.php');
    require_once('class.phpmailer.php');

    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

  if (false !== strpos($url,'paypal')) {
    SimpleConfig::setFile('../connection/config.php');
  }
 else {
      SimpleConfig::setFile('./connection/config.php');
}
     //SimpleConfig::setFile('E:/wamp/www/milesoil/admin/connection/config.php');
     
    class mainClass {

        public $connection;
        public $db;
        public $config;

        private static $instance;
        
        /**
         * 
         */
        private function __construct(){
            $this->config = SimpleConfig :: getInstance();
            $this->db = MySqlDatabase :: getInstance();
            $this->connection = $this->db->connect($this->config->host, $this->config->user, $this->config->password,$this->config->database,true);
        } // __construct

        /**
         *
         * @return type 
         */
        public static function getInstance(){
            if (!isset(self::$instance)) {
                self::$instance = new mainClass;
            }
            return self::$instance;
        } // getInstance

        /**
         * 
         */
        public function closeConnection(){
            mysql_close($this->connection);
        }
        
         function generatePassword($length=9, $strength=8) {
            $vowels = 'aeuy';
            $consonants = 'bdghjmnpqrstvz';
            if ($strength & 1) {
                    $consonants .= 'BDGHJLMNPQRSTVWXZ';
            }
            if ($strength & 2) {
                    $vowels .= "AEUY";
            }
            if ($strength & 4) {
                    $consonants .= '23456789';
            }
            if ($strength & 8) {
                    $consonants .= '@#$%';
            }

            $password = '';
            $alt = time() % 2;
            for ($i = 0; $i < $length; $i++) {
                    if ($alt == 1) {
                            $password .= $consonants[(rand() % strlen($consonants))];
                            $alt = 0;
                    } else {
                            $password .= $vowels[(rand() % strlen($vowels))];
                            $alt = 1;
                    }
            }
            return $password;
        }
        
        
         public function getUserPassword($userEmail){
            $sql = "select password from tb_user where user_name = '$userEmail'";
            //pc_debug("SQL = $sql",__FILE__,__LINE__);
            $result = $this->db->fetchOne($sql);
            return $result;
        }
		
		/**
		* CHECK USER
		* VALID OR NOT
		*/
        public function isValidUser($userEmail,$password){
            //$password = md5($password);
            $sql = "select count(*) from tb_user where user_name =  '$userEmail' and password = '$password'";
            //pc_debug("SQL = $sql",__FILE__,__LINE__);
            $result = $this->db->fetchOne($sql);
            return $result;
        }
        
        
        
        /* Insert Data SQL */
		public function build_sql_insert($table, $data) {
			$key = array_keys($data);
			$val = array_values($data);
			$sql = "insert into $table (" . implode(', ', $key) . ") " . "values ('" . implode("', '", $val) . "')";
		        //$sql = "insert into $table ($key)values ($val))";
			return($sql);
		}
		
		/* Update Data SQL */
		public function build_sql_update($table, $dataArr,$conditionArr) {
			$key = array_keys($dataArr);
			$val = array_values($dataArr);
			$sql = "update $table set";
			
			for($i=0; $i<sizeof($dataArr);$i++){
				if($i>0){
					$sql .= ",";
				}
				$sql .= " ".$key[$i]."='".$val[$i]."'";
			}
			
			if($conditionArr != NULL){
				$condition_key = array_keys($conditionArr);
				$condition_val = array_values($conditionArr);
				
				$sql .= " where";
				for($j=0; $j<sizeof($conditionArr);$j++){
					if($j>0){
						$sql .= " and";
					}
					$sql .= " ".$condition_key[$j]."='".$condition_val[$j]."'";
				}
			}
			
			return($sql);
		}
		
		/* Get Data SQL */
		public function build_sql_get($table, $conditionArr=NULL, $orderArr=NULL, $groupArr=NULL, $relationTableArr=NULL ) {
			
			
			// inner join
			if($relationTableArr != NULL){  //array('tb'=>'re')
				$count = 0;
				$sql = "select tb.*";
				
				foreach($relationTableArr as $key => $val){ //$key = relation table name ## $val = column name
					$count = $count + 1;
					$sql .= ", rtb_$count.*"; // For multiple inner join selection
				}
				 
				$sql .= " from $table tb";
				
				$count = 0;
				$prev_count = 0;
				foreach($relationTableArr as $key => $val){
					
					$searchRelationTable = strrev(strtok(strrev($key),'_'));
					$count = $count + 1;
					
					if($count == 1 || $searchRelationTable === 'relation'){
						$sql .= " inner join " . $key . " rtb_$count on rtb_$count." . $val . " = tb." . $val;
					} else {
						$prev_count = $count-1;
						$sql .= " inner join " . $key . " rtb_$count on rtb_$count." . $val . " = rtb_$prev_count." . $val;
						
					}
					
				}
			} else {
				$sql = "select * from $table";
			}
			
			// where clause
			if($conditionArr != NULL){
				$condition_key = array_keys($conditionArr);
				$condition_val = array_values($conditionArr);
				
				$sql .= " tb where";
				for($j=0; $j<sizeof($conditionArr);$j++){
					if($j>0){
						$sql .= " and";
					}
                                        
					$sql .= " tb.".$condition_key[$j]."='".$condition_val[$j]."'";
				}
			}
			
			//order by
			if($orderArr != NULL){
				$order_key = array_keys($orderArr);
				$order_val = array_values($orderArr);
				
				$sql .= " order by";
				for($j=0; $j<sizeof($orderArr);$j++){
					if($j>0){
						$sql .= ", ";
					}
					//pc_debug("order ## $order_key[$j]",__FILE__,__LINE__);
					$sql .= " tb.".$order_key[$j]." ".$order_val[$j];
				}
			}
                        
                        //group by
                        if($groupArr != NULL){
				$order_key = array_keys($groupArr);
				$order_val = array_values($groupArr);
				
				$sql .= " group by";
				for($j=0; $j<sizeof($groupArr);$j++){
					if($j>0){
						$sql .= ", ";
					}
					//pc_debug("order ## $order_key[$j]",__FILE__,__LINE__);
					$sql .= " tb.".$order_key[$j]." ".$order_val[$j];
				}
			}
			
			return($sql);
		}
		
		/* Count Data SQL */
		public function build_sql_count($table, $conditionArr=NULL, $orderArr=NULL, $relationTableArr=NULL ) {
			
			
			// inner join
			if($relationTableArr != NULL){  //array('tb'=>'re')
				$count = 0;
				$sql = "select count(tb.*)";
				$sql .= " from $table tb";
				
				$count = 0;
				$prev_count = 0;
				foreach($relationTableArr as $key => $val){
					
					$searchRelationTable = strrev(strtok(strrev($key),'_'));
					$count = $count + 1;
					
					if($count == 1 || $searchRelationTable === 'relation'){
						$sql .= " inner join " . $key . " rtb_$count on rtb_$count." . $val . " = tb." . $val;
					} else {
						$prev_count = $count-1;
						$sql .= " inner join " . $key . " rtb_$count on rtb_$count." . $val . " = rtb_$prev_count." . $val;
					}
					
				}
			} else {
				$sql = "select count(*) from $table";
			}
			
			// where clause
			if($conditionArr != NULL){
				$condition_key = array_keys($conditionArr);
				$condition_val = array_values($conditionArr);
				
				$sql .= " where";
				for($j=0; $j<sizeof($conditionArr);$j++){
					if($j>0){
						$sql .= " and";
					}
					$sql .= " ".$condition_key[$j]."='".$condition_val[$j]."'";
				}
			}
			
			//order by
			if($orderArr != NULL){
				$order_key = array_keys($orderArr);
				$order_val = array_values($orderArr);
				
				$sql .= " order by";
				for($j=0; $j<sizeof($conditionArr);$j++){
					if($j>0){
						$sql .= ", ";
					}
					$sql .= " ".$order_key[$j]." ".$order_val[$j];
				}
			}
			
			return($sql);
		}
		
		/**************************************************************************************************************************************/
		/**************************************************************************************************************************************/
		
		/* Insert Data*/
		public function saveData($table,$dataArr,$relationTableArr=NULL,$column_name=NULL){
			
			$sql = $this->build_sql_insert($table,$dataArr);
			//pc_debug("SQL # $sql",__FILE__,__LINE__);
			$result = $this->db->insert($sql);
			$insert_id = mysql_insert_id();
			//pc_debug("insert Id ## $insertId",__FILE__,__LINE__);
			
			if($relationTableArr != NULL && $column_name != NULL){
				
				foreach($relationTableArr as $relationTable => $relationRow){
					foreach($relationRow as $relationColumn => $relationDataArr){
						foreach($relationDataArr as $relationData){
							$dataArrList = array(); // restructured array for each element
							$dataArrList[$column_name] = $insert_id;
							$dataArrList[$relationColumn] = $relationData;
							
							//print_r($dataArrList);
							
							$sql = $this->build_sql_insert($relationTable,$dataArrList);
							//pc_debug("SQL # $sql",__FILE__,__LINE__);
							$result = $this->db->insert($sql);
						}
					}
				}
				//exit;
			}
			
			return $insert_id;
		}
		
		/* Update Data*/
		public function updateData($table,$dataArr,$conditionArr=NULL){   //,$relationTableArr=NULL
			
			$sql = $this->build_sql_update($table,$dataArr,$conditionArr);
			//pc_debug("SQL # $sql",__FILE__,__LINE__);
			$result = $this->db->update($sql);
		}
		
		/* Get Data*/
		public function getData($table,$conditionArr=NULL,$orderArr=NULL,$groupArr=NULL,$relationTableArr=NULL){
			
			$sql = $this->build_sql_get($table,$conditionArr,$orderArr,$groupArr,$relationTableArr);
			//pc_debug("SQL # $sql",__FILE__,__LINE__);
			$result = $this->db->query($sql);
				
			$rows = array();			
			while($row = mysql_fetch_array($result,MYSQLI_ASSOC)){
				array_push($rows,$row);			
			}
			if(sizeof($rows) > 0){
				return $rows;
			}else {
				return false;
			}
		}
		
		/* Count Data*/
		public function countData($table,$conditionArr=NULL,$orderArr=NULL,$relationTableArr=NULL){
            $sql = $this->build_sql_count($table,$conditionArr,$orderArr,$relationTableArr);
			$result = $this->db->fetchOne($sql);
            return $result;
        } 
        
        public function createSalesReport($startDate, $endDate)
        {
            $rows = array();
            
            $sql = "select * from tb_order where order_date_time BETWEEN '$startDate' AND '$endDate' order by id desc";
            //pc_debug("SQL: ".$sql, __FILE__, __LINE__);
            $r = mysql_query($sql);
            while($row = mysql_fetch_array($r, MYSQLI_ASSOC))
            {
               array_push($rows,$row);
               
//              $q = "select * from tb_order_billing_relation where order_id = '$row[order_id]'";
//               $r0 = mysql_query($q);
//               $res =  mysql_fetch_array($r0);
//               
//               $q = "select * from tb_user_billing_address where id = $res[billing_id]"; 
//               $r1 = mysql_query($q);
//               while($ress = mysql_fetch_array($r1, MYSQLI_ASSOC))
//               {        
//                array_push($rows1,$ress);
//               }
//              
                
            }     
               //array_push($rows1,$rows2);
              
              
            return $rows; 
            
        } 
        
        public function getSalesReportUsers($orderId)
        {
            $rows = array();
            $q = "select * from tb_order_billing_relation where order_id = '$orderId'";
               $r0 = mysql_query($q);
               $res =  mysql_fetch_array($r0);
               
               $q = "select * from tb_user_billing_address where id = $res[billing_id]"; 
               $r1 = mysql_query($q);
               while($ress = mysql_fetch_array($r1, MYSQLI_ASSOC))
               {        
                array_push($rows,$ress);
               }
               return $rows;
        }
        
        
        function sendContactMail($fromName,$fromMail,$subject,$message)
        {
           
            $mail  = new PHPMailer();
            $mail->Host = 'smppout.secureserver.net';
            $mail->Port = 80;

            $mail->SetFrom("$fromMail", "$fromName");
            $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

            $mail->AddAddress('d_to_dbd@yahoo.com');

            

            try {
            //error_log("Subject is (2nd Time) = $subject");
            $mail->Subject = (string)$subject;
//            error_log("Subject is (3rd Time)= $subject");
            $mail->MsgHTML($message);
               
             
            
            $mail->Send();  
            return "Your email has been sent. Thank You";
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }  
        }
        
        

        function delProd($pr_id)
        {
            $sql = "delete from tb_product where id=".$pr_id;
            $r = mysql_query($sql);
            
            $sql = "delete from tb_category_product_relation where product_id=".$pr_id;
            $r1 = mysql_query($sql);
            
            $sql = "delete from tb_product_attributes where id=".$pr_id;
            $r2 = mysql_query($sql);
            
            $sql = "delete from tb_product_attributes_relation where product_id=".$pr_id;
            $r3 = mysql_query($sql);
            
            $sql = "delete from tb_product_msds where product_id=".$pr_id;
            $r4 = mysql_query($sql);
            
            return true;
            
        }  
        
        function getAllProd()
        {
            $rows = array();
            $q = "select id,name,price,insert_datetime from tb_product order by insert_datetime desc";
               $r = mysql_query($q);
               while($res =  mysql_fetch_array($r))
               {
                   array_push($rows,$res);
               }    
             return $rows;  
        }
        
        public function search($srch)
        {
            $rows=array();
            $sql = "select * from tb_product where name LIKE '%$srch%' OR specification LIKE '%$srch%'";
            $r = mysql_query($sql);
            while($res = mysql_fetch_array($r))
            {
              array_push($rows,$res);  
            }    
            return $rows;
        }
        
        public function productPaginationQry($page, $limit)
        {
            $sql = "SELECT * FROM tb_product ORDER BY id DESC";
            # find out query stat point
            $start = ($page * $limit) - $limit;
            # query for page navigation
            if( mysql_num_rows(mysql_query($sql)) > ($page * $limit) ){
                    $next = ++$page;
                    return $next;
            }
            $query = mysql_query( $sql . " LIMIT {$start}, {$limit}");
            if (mysql_num_rows($query) < 1) {
                    header('HTTP/1.0 404 Not Found');
                    return 'Page not found!';
                    //exit();
            }
        }        

    }  // Wallpaper Class



?>
