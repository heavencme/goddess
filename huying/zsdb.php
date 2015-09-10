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
        
        function exist_uid($uid)
        {
            /*query in the database if the uid exists*/
            //echo "serching4".$uid;
            $query="SELECT * FROM usersinfo WHERE uid=$uid"; //where uid='xxx' ,如果存进了一个$uid=null，此时所有新用户都成“已经存在”了,所以上层要先判断
            $result=$this->query($query);
            $rows=$result->fetch_array();//
            //echo "rowis".$rows;
            if(!empty($rows))    
            {
                
                //echo"$uid"."already exists!".$rows;
                return true;
            }
            else
                return false;
            
        }
        /**
         *向usesinfo表中添加一条记录
         *包含用户基本信息
         **/
        function add_one($uid,$name,$sex,$university,$highschool,$access_token)
        {
            //$date=strftime("%Y-%m-%d %d %b" ,time());
            //echo "inserting4".$uid;
            $query="insert into usersinfo (uid,name,sex,university,highschool,access_token) values ($uid,'".$name."','".$sex."','".$university."','".$highschool."','".$access_token."')";
            $this->query($query);
            if($this->dbh->error)
                {
                    //echo $this->dbh->error;
                    return;
                }
            //echo "added!";
            
        }
        /**给用户的weibo的id，返回用户在usersinfo的id**/
        function wbuid2id($uid)
        {
            $query="SELECT id FROM usersinfo WHERE uid=$uid";
            $result=$this->query($query);
            $id=$result->fetch_array();
            return $id[0];
            
        }
        /**向guests表中添加一条记录，包括用户id，date，ip**/
        function aguest($id,$ip)
        {
            $query="insert into guests (date,id,ip) values (CURDATE(),$id,'"."$ip')";
            $this->query($query);
        }
        
        /**向like表中插入一条记录，包括用户id，like1,like2...like9,没有设置的默认为0**/
        function like($id,$likeuid)
        {
            //UPDATE ulike SET like4=444 WHERE id=13
            $exist=0;//标志是否已经like过此人了
            $add_new="insert into ulike (id) values ($id)";
            $add_head="UPDATE ulike SET like";
            $add_tail="=$likeuid WHERE id=$id";
            $query="select * from ulike where id=$id ";//select * from like where id=$id中like非法
            $result=$this->query($query);
            $arr=$result->fetch_array();
            if(empty($arr))
               $this->query($add_new);
            foreach($arr as $item)
                if($likeuid==$item)
                    $exist=1;
                    
            if($exist==0)
            {
                //看看likeN是空的就插入，顺序寻找
                if($arr['like1']==0)
                    $this->query($add_head."1".$add_tail);
                else if($arr['like2']==0)
                    $this->query($add_head."2".$add_tail);
                else if($arr['like3']==0)
                    $this->query($add_head."3".$add_tail);
                else if($arr['like4']==0)
                    $this->query($add_head."4".$add_tail);
                else if($arr['like5']==0)
                    $this->query($add_head."5".$add_tail);
                else if($arr['like6']==0)
                    $this->query($add_head."6".$add_tail);
                else if($arr['like7']==0)
                    $this->query($add_head."7".$add_tail);
                else if($arr['like8']==0)
                    $this->query($add_head."8".$add_tail);
                else if($arr['like9']==0)
                    $this->query($add_head."9".$add_tail);
                else //是一个新的并且此时原来九个已经满了，那么回环插到第一个,形成一个队列
                    {
                        $this->query($add_head."9=".$arr['like8']." WHERE id=$id");
                        $this->query($add_head."8=".$arr['like7']." WHERE id=$id");
                        $this->query($add_head."7=".$arr['like6']." WHERE id=$id");
                        $this->query($add_head."6=".$arr['like5']." WHERE id=$id");
                        $this->query($add_head."5=".$arr['like4']." WHERE id=$id");
                        $this->query($add_head."4=".$arr['like3']." WHERE id=$id");
                        $this->query($add_head."3=".$arr['like2']." WHERE id=$id");
                        $this->query($add_head."2=".$arr['like1']." WHERE id=$id");
                        $this->query($add_head."1".$add_tail);
                    }
            }
        }
        
        function addbook($text,$id,$seller)
        {
            $pregstr="/#南航小店#/u";
            if(preg_match($pregstr,$text,$matchArray))
            {
                //echo $matchArray[0]."......";
                $arr=preg_split($pregstr,$text);
                //echo $arr[0]."...".$arr[1];
                $sql = "INSERT INTO nuaabook (word, pic, id,seller) VALUES ('".$arr[0]."','".$arr[1]."',".$id.",'".$seller."')";
                $this->query($sql);
                if($this->dbh->error)
                    echo $this->dbh->error;
            }
        }
        
        function fetchbook(&$booknames,&$bookpics,&$sellers,$start=1,$end=81)//返回的值为多行的，传引用；$start,$end表示查询范围
        {
            $booknamess=array();//存储多行结果
            $bookpics=array();
            $sellers=array();
            $query="SELECT * FROM nuaabook LIMIT $start,$end"; 
            $result=$this->query($query);
            while ($row = $result->fetch_array())//自动向后移动指针
            {  
                array_push($booknames, $row['word']);
                array_push($bookpics,$row['pic']);
                array_push($sellers,$row['seller']);
            } 
            if(!empty($booknames)&&!empty($bookpics))    
            {
                return true;
            }
            else
                return false;
        }
    }
?>




















