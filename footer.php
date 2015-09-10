

            <div class="footer">
                <div class="logo">
                    <?php
                    $cut_descp=mb_strcut($wbprofile['description'],0,99,'utf-8');//截取utf-8字符串长度
                  
                    if(mb_strlen($wbprofile['description'],'utf-8')>=99)
                        $str_too_long="...";
                    else
                        $str_too_long="";
                     ?>
                     <div class="mylogo" id="zilogo">
                        <img id="logoimage" src="images/logo.png" alt="点击登录" title="点击登录"/>
                     </div>
                </div>
            </div>
        </div><!--main-wrapper-->
    </body>
</html>