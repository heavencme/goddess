<?php
    class zsdb
    {
        var $ready;
        /*
         database connect is ready===true/false
        */
        
        var $charset;
        /*
         charset
        */
        
        protected $dbuser;
        /*
         database user name
        */
        
        protected $dbname;
        /*
         database name
        */
        
        protected $dbpassword;
        /*
         database password
        */
        
        protected $dbhost;
        /*
         database host
        */
        
        protected $dbh;
        /*
         current query for database;
        */
        
        function get_total_users()
        {
            /*get total user number*/
        }
        
        function db_con()
        {
            @ $this->dbh=new mysqli($this->dbhost, $this->dbuser, $this->dbpassword,$this->dbname);
            if(mysqli_connect_errno())
                {
                    //echo mysqli_connect_errno();
                    return;
                }
            $this->dbh->set_charset("utf8"); //set character set to utf8
            $this->ready = true; //database connection is ready
            //echo "dbconnected!!!";
            
        }
        
        function db_discon()
        {
            if(!$this->dbh)
                {
                    //echo"<h1>no database connection.</h1>";
                    return;
                }
            $this->dbh->close(); //for manually disconnect to the database
            //echo"dbclosed!!!";
            $this->ready=false;
        }
        
        function select($newdbname)
        {
            /*
             change current database connection to a new one
            */
            if(!$this->dbh)
                {
                    //echo"<h1>Error establishing a database connection.</h1>";
                    return;
                }
            if($this->dbh->query("SELECT DATABASE()")===$newdbname)
                return;
            $this->dbh->select_db($newdbname);
        }
        
        function query($query)
        {
            /*
             $query is a sql language string
            */
            return $this->dbh->query($query);
            
        }
        
        function __construct($dbuser,$dbpassword,$dbname,$dbhost)
        {
            $this->dbuser=$dbuser;
            $this->dbpassword=$dbpassword;
            $this->dbname=$dbname;
            $this->dbhost=$dbhost;
            $this->db_con(); //defualt to connect database
        }
        
        
        /**
         *向travel_info表中添加一条记录
         *包含用户基本信息
         **/
        function add_one($name,$place,$time)
        {
            $query="insert into travel_info (name,time,place) values ('" .$name. "','".$time."',$place)";
            $this->query($query);
            if($this->dbh->error)
                {
                    echo $this->dbh->error;
                    return;
                }
            
        }
        
    }
?>




















