<?php
    include_once('renclient.php');
    class renfun extends renclient
    {
        
        function __construct($token)
        {
            $this->token=$token;
            
        }
        
        
        /********************************************************************/
        /********************************************************************/
        /******************api2.0功能部分**************************************/
        /********************************************************************/
        /********************************************************************/
        
        /**
        * 批量获取用户信息
        * <br />对应API:{$link http://dev.renren.com/API/v2/user/batch }
        * @param Long $userIds 批量获取的用户IDs
        * @return User 用户
        */
        function batchUser($userIds)
        {
                $params = array();
                if (isset($userIds))
                {
                        $userIdsList=null;
                        foreach($userIds as $value)
                        {
                                if($userIdsList == null)
                                {
                                    $userIdsList = strval($value);	
                                }
                                else
                                {
                                   $userIdsList =$userIdsList.",".strval($value);
                                }
                        }
                        $params ['userIds'] = $userIdsList;
                }
                return $this->execute('/v2/user/batch', 'GET', $params);
        } 
        /**
        * 以分页的方式获取某个用户与当前登录用户的共同好友
        * <br />对应API:{$link http://dev.renren.com/API/v2/user/friend/mutual/list }
        * @param Long $userId 用户ID
        * @return User 用户
        */
        function listUserFriendMutual($userId) {
                $params = array();
                
                if (isset($userId))
                {
                        $params ['userId'] = $userId;
                }
                return $this->execute('/v2/user/friend/mutual/list', 'GET', $params);
        } 
        /**
        * 获取用户信息
        * <br />对应API:{$link http://dev.renren.com/API/v2/user/get }
        * @param Long $userId 用户ID
        * @return User 用户
        */
        function getUser($userId)
        {
                $params = array();
         
                if (isset($userId))
                {
                        $params ['userId'] = $userId;
                }
                return $this->execute('/v2/user/get', 'GET', $params);
        } 
        /**
        * 获取当前登录用户在某个应用里的好友列表
        * <br />对应API:{$link http://dev.renren.com/API/v2/user/friend/app/list }
        * @return User 用户
        */
        function listUserFriendApp()
        {
                $params = array();
                return $this->execute('/v2/user/friend/app/list', 'GET', $params);
        } 
        /**
        * 获取某个用户的好友列表
        * <br />对应API:{$link http://dev.renren.com/API/v2/user/friend/list }
        * @param Long $userId 用户ID
        * @param Integer $pageSize 页面大小。取值范围1-100，默认大小20
        * @param Integer $pageNumber 页码。取值大于零，默认值为1
        * @return User 用户
        */
        function listUserFriend($userId, $pageSize, $pageNumber)
        {
                $params = array();
                
                
                if (isset($userId))
                {
                         $params ['userId'] = $userId;
                }
                if (isset($pageSize))
                {
                         $params ['pageSize'] = $pageSize;
                }
                if (isset($pageNumber))
                {
                        $params ['pageNumber'] = $pageNumber;
                }
                return $this->execute('/v2/user/friend/list', 'GET', $params);
        }
        
        /**
        * 获取当前登录用户信息
        * <br />对应API:{$http://wiki.dev.renren.com/wiki/V2/user/login/get }
        * @param Long $access_token值
        * @return User 用户信息
        */
        function info()
        {
                $params = array();
                
                
                return $this->execute('/v2/user/login/get', 'GET', $params);
        }
        
        
        /**
         * 获取用户状态列表
         * <br />对应API:{$link http://dev.renren.com/API/v2/status/list }
         * @param Long $ownerId 状态所有者的用户ID
         * @param Integer $pageSize 页面大小。取值范围1-100，默认大小20
         * @param Integer $pageNumber 页码。取值大于零，默认值为1
         * @return Status 状态
         */
        function listStatus($ownerId, $pageSize, $pageNumber)
        {
                $params = array();
                     
                     
        	    if(isset($ownerId)) 
                {
        	             $params ['ownerId'] = $ownerId;
        	    }
        	    if (isset($pageSize)) 
                {
        	             $params ['pageSize'] = $pageSize;
        	    }
        	    if (isset($pageNumber)) 
                {
        	             $params ['pageNumber'] = $pageNumber;
        	    }
                return $this->execute('/v2/status/list', 'GET', $params);
         } 
        /**
         * 获取用户状态
         * <br />对应API:{$link http://dev.renren.com/API/v2/status/get }
         * @param Long $statusId 状态ID
         * @param Long $ownerId 状态所有者的用户ID
         * @return Status 状态
         */
         function getStatus($statusId, $ownerId)
         {
                $params = array();
                     
                     
        	    if (isset($statusId)) 
                {
        	             $params ['statusId'] = $statusId;
        	    }
        	    if (isset($ownerId)) 
                {
        	             $params ['ownerId'] = $ownerId;
        	    }
                return $this->execute('/v2/status/get', 'GET', $params);
         } 
        /**
         * 更新用户状态
         * <br />对应API:{$link http://dev.renren.com/API/v2/status/put }
         * @param String $content 状态的内容。内容中的UBB表情代码未经过处理，需要开发者自行进行替换。UBB表情参见：[http://wiki.dev.renren.com/wiki/V2/ubb/list 获取人人网ubb列表]
         * @return Status 状态
         */
         function putStatus($content)
         {
                $params = array();
                     
                     
        	    if (isset($content)) 
                {
        	             $params ['content'] = $content;
        	    }
                return $this->execute('/v2/status/put', 'POST', $params);
         } 
        /**
         * 分享用户状态
         * <br />对应API:{$link http://dev.renren.com/API/v2/status/share }
         * @param String $content 状态的内容。内容中的UBB表情代码未经过处理，需要开发者自行进行替换。UBB表情参见：[http://wiki.dev.renren.com/wiki/V2/ubb/list 获取人人网ubb列表]
         * @param Long $statusId 状态ID
         * @param Long $ownerId 状态所有者的用户ID
         * @return Status 状态
         */
         function shareStatus($content, $statusId, $ownerId)
         {
                $params = array();
                     
                     
        	    if (isset($content)) 
                {
        	             $params ['content'] = $content;
        	    }
        	    if (isset($statusId)) 
                {
        	             $params ['statusId'] = $statusId;
        	    }
        	    if (isset($ownerId)) 
                {
        	             $params ['ownerId'] = $ownerId;
        	    }
                return $this->execute('/v2/status/share', 'POST', $params);
         }

         /**
         * 发送自定义新鲜事。新鲜事会发布用户的个人动态信息到用户人人网主页，<br> 同时会出现在好友的新鲜事中。
         * <br />对应API:{$link http://dev.renren.com/API/v2/feed/put }
         * @param String $message 用户输入的自定义内容。注意：最多200个字符
         * @param String $title 新鲜事标题 注意：最多30个字符
         * @param String $actionTargetUrl 新鲜事动作模块链接
         * @param String $imageUrl 新鲜事图片地址
         * @param String $description 新鲜事主体内容 注意：最多200个字符。
         * @param String $subtitle 新鲜事副标题 注意：最多20个字符
         * @param String $actionName 新鲜事动作模块文案。 注意：最多10个字符
         * @param String $targetUrl 新鲜事标题和图片指向的链接
         * @return Long 发布新鲜事的ID
         */
         function putFeed($message, $title, $actionTargetUrl, $imageUrl, $description, $subtitle, $actionName, $targetUrl) 
         {
                $params = array();
                     
                if (isset($message)) 
                {
                         $params ['message'] = $message;
                }
                if (isset($title)) 
                {
                         $params ['title'] = $title;
                }
                if (isset($actionTargetUrl)) 
                {
                         $params ['actionTargetUrl'] = $actionTargetUrl;
                }
                if (isset($imageUrl)) 
                {
                         $params ['imageUrl'] = $imageUrl;
                }
                if (isset($description)) 
                {
                         $params ['description'] = $description;
                }
                if (isset($subtitle)) 
                {
                         $params ['subtitle'] = $subtitle;
                }
                if (isset($actionName)) 
                {
                         $params ['actionName'] = $actionName;
                }
                if (isset($targetUrl)) 
                {
                         $params ['targetUrl'] = $targetUrl;
                }
                return $this->execute('/v2/feed/put', 'POST', $params);
         }
     
     
     /**
         * @param String $targetUrl 新鲜事标题和图片指向的链接
         * @return Long 发布新鲜事的ID
         */
         function listFeed($pageSize=null,$pageNumber=null,$feedType=null,$userId=null) 
         {
                $params = array();
                   
                if(isset($feedType))
                {
                    $params['feedType']=$feedType;
                }
                if(isset($userId))
                {
                    $params['userId']=$userId;
                }
                if(isset($pageSize))
                {
                    $params['pageSize']=$pageSize;
                }
                if(isset($pageNumber))
                {
                    $params['pageNumber']=$pageNumber;
                }
                
                return $this->execute('/v2/feed/list', 'GET', $params);
         }
        
        
        
        
        
        
    }
    
?>