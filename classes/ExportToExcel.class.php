<?php
/*Author: Raju Mazumder
  email:rajuniit@gmail.com
  Class:A simple class to export mysql query and whole html and php page to excel,doc etc*/
require_once('SimpleConfig.php');
require_once('mysqldatabase.php');

if (false !== strpos($url,'cart')) {
   SimpleConfig::setFile('../connection/config.php');
} else {
    SimpleConfig::setFile('./connection/config.php');
}

class ExportToExcel
{
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
                self::$instance = new ExportToExcel;
            }
            return self::$instance;
        } // getInstance

        /**
         * 
         */
        public function closeConnection(){
            mysql_close($this->connection);
        }
        
        
	function exportWithPage($php_page,$excel_file_name)
	{
		$this->setHeader($excel_file_name);
		require_once "$php_page";
	
	}
	function setHeader($excel_file_name)//this function used to set the header variable
	{
		
		header("Content-type: application/octet-stream");//A MIME attachment with the content type "application/octet-stream" is a binary file.
		//Typically, it will be an application or a document that must be opened in an application, such as a spreadsheet or word processor. 
		header("Content-Disposition: attachment; filename=$excel_file_name");//with this extension of file name you tell what kind of file it is.
		header("Pragma: no-cache");//Prevent Caching
		header("Expires: 0");//Expires and 0 mean that the browser will not cache the page on your hard drive
		
	
	
	}
	function exportWithQuery($qry,$excel_file_name)//to export with query
	{
		$tmprst=mysql_query($qry);
		$header="<center><table border=1px><tr><th colspan=3 align=left><b>Newsletter Subscribers List</b></th></tr>";
		$num_field=mysql_num_fields($tmprst);
		while($row=mysql_fetch_array($tmprst,MYSQL_BOTH))
		{
			$body.="<tr>";
			for($i=0;$i<$num_field;$i++)
			{
				$body.="<td>".$row[$i]."</td>";
			}
			$body.="</tr>";	
		}
		
		$this->setHeader($excel_file_name);
		echo $header.$body."</table";
	}


}
?>