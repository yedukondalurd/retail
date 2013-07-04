<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="container">
    <div id="heading">
        <h3>Sales</h3>
    </div>
    <div id="employees">
        <div id="left_menu">
            <ul>
                <li><?php echo $addLink; ?></li>
            </ul>
        </div>
        <div id="list_container">
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="generate_list">
                <thead>
                    <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $tableBody; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<div style="clear: both;"></div>