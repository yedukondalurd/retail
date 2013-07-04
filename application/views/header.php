<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <title><?php echo $pageTitle; ?></title>
    <head>
        <!--Loading Jquery Library-->
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.2.js"></script>
        <!--Loading Datatable Library
        http://www.datatables.net/
        -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.dataTables.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.dataTables.custom.css"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/datatable_bootstrap.js"></script>
        <!--Loading Bootstrap Library
        http://twitter.github.io/bootstrap/
        --> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
         
        <!--Loading Popup Library
        http://zurb.com/playground/reveal-modal-plugin
        -->
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.reveal.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/reveal.css"/>
        <!--Loading validation Library
        http://jqueryvalidation.org/
        -->
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
        <!--Loading Notification Library
        http://needim.github.io/noty/
        -->
        <script type="text/javascript" src="<?php echo base_url(); ?>js/noty/jquery.noty.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/noty/layouts/bottomRight.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/noty/themes/default.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/data.table.actions.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css"/>

    </head>
    <body>
        <div id="retail">
            <div id="header">
                <div id="store_logo">
                    <img src="<?php echo base_url(); ?>" alt="Store Logo"/>
                </div>
                <div id="main_nav">
                    <ul>
                        <?php echo $menuLinks; ?>
                    </ul>
                </div>
                <div style="clear: both;"></div>
            </div>