<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <title>Login</title>
        <style type="text/css">
            body{
                margin: 0px;
                padding: 0px;
                background:url('http://localhost/Retail/images/login_bg.png');
            }
            #login .loginForm{
                margin: 100px auto 0px;
                width: 300px;
                height: 200px;
                background: url('http://localhost/Retail/images/login_bg.png');
            }
        </style>
    </head>
    <body>
        <div id="login">
            <div class="loginForm">
                <?php
                echo lang('login_title');
                if (isset($login_error)) {
                    echo '<p>' . $login_error . '</p>';
                }
                ?>
                <form action="" method="post">
                    <div>
                        <label><?php echo lang('login_username'); ?></label>
                        <input type="text" name="retail_store_username" value="<?php if (isset($return_username)) {
                    echo $return_username;
                } ?>" class="required"/>
                    </div>
                    <div>
                        <label><?php echo lang('login_password'); ?></label>
                        <input type="password" name="retail_store_password" value="<?php if (isset($return_password)) {
                    echo $return_password;
                } ?>" class="required"/>
                    </div>
                    <div>
                        <input type="submit" value="Login" />
                    </div>
                </form>
            </div>

        </div>
    </body>
</html>