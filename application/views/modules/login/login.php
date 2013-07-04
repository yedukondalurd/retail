<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <title>Login</title>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.2.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/login/main.css"/>
        <style>
                        /* General Styles */
                        center > h4 { color: #c5c5c5; margin-top: 50px; }
                        body { margin: 0; font-family: Arial; background: rgb(197, 197, 197); }
                        ul#login-widget-freebie { display: table; list-style: none; margin: 0 auto; padding: 0; }
                        ul#login-widget-freebie > li { float: left; margin-right: 20px; margin-bottom: 20px; padding: 10px 10px; }
                        ul#login-widget-freebie > li:last-child { margin-right: 0; }
                        ul#login-widget-freebie > li > span { margin-bottom: 10px; }
                        
                        .button.pink {
                            box-shadow: 1px 0 1px #DB6363, 
                                0 1px 1px #DB6363, 
                                2px 1px 1px #B27C7D , 
                                1px 2px 1px #DB6363, 
                                3px 2px 1px #B27C7D , 
                                2px 3px 1px #DB6363, 
                                4px 3px 1px #B27C7D , 
                                3px 4px 1px #DB6363, 
                                5px 4px 1px #B27C7D , 
                                4px 5px 1px #DB6363, 
                                6px 5px 1px #B27C7D ;

                        }
                        .button.pink:active {
                            box-shadow: 1px 0 1px #B27C7D, 
                                0 1px 1px #DB6363, 
                                2px 1px 1px #B27C7D, 
                                1px 2px 1px #DB6363, 
                                3px 2px 1px #DB6363;
                            transform: translate(3px, 3px);
                        }
                        ul#login-widget-freebie{
                            margin-top: 60px;
                        }
        </style>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.button').click(function() {
                    $(this).toggleClass('button1').toggleClass('active');
                });   
            });
        </script>  
    </head>
    <body>
        <ul id="login-widget-freebie">
            <li>
                <div id="login" class="login-widget">
                    <div id="login-widget-content" class="loginForm">
                <?php
                if (isset($login_error)) {
                    echo '<p class="errors">' . $login_error . '</p>';
                }
                ?>
                <form action="" method="post">
                    <div>
                        <input type="text" class="icon custom-input username" placeholder="<?php echo lang('login_username'); ?>" name="retail_store_username" value="<?php if (isset($return_username)) {
                    echo $return_username;
                } ?>" class="required"/>
                    </div>
                    <div>
                        <input type="password" class="icon custom-input password" placeholder="<?php echo lang('login_password'); ?>" name="retail_store_password" value="<?php if (isset($return_password)) {
                    echo $return_password;
                } ?>" class="required"/>
                    </div>
                    <div>
                        <input type="submit" class="full big button pink" value="Login" />
                    </div>
                </form>
                    </div>

                </div>
            </li>
        </ul>
    </body>
</html>