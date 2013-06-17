<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="container">
    <div id="heading">
        <h3>Customers</h3>
    </div>
    <div id="customers">
        <div id="left_menu">
            <ul>
                <li><?php echo $addLink; ?></li>
                <!--                <li><a href="">Bulk Edit</a></li>
                                <li><a href="">Delete</a></li>-->
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
<div id="myModal" class="reveal-modal">
    <h2>New Item</h2>
    <div id="new-customer">
        <form action="" method="post" row_position="">
            <div>
                <label>First Name</label>
                <input type="text" name="first_name" class="required" placeholder="required" id="focus_in"/>
            </div>
            <div>
                <label>Last Name:</label>
                <input type="text" name="last_name" class="required" placeholder="required"/>
            </div>
            <div>
                <label>email:</label>
                <input type="text" name="email" class="email" placeholder="optional"/>
            </div>
            <div>
                <label>Phone Number:</label>
                <input type="text" name="phone_number" class="digits" placeholder="optional"/>
            </div>
            <div>
                <label>Address 1:</label>
                <input type="text" name="address1" placeholder="optional"/>
            </div>
            <div>
                <label>Address 2:</label>
                <input type="text" name="address2" placeholder="optional"/>
            </div>
            <div>
                <label>City:</label>
                <input type="text" name="city" placeholder="optional"/>
            </div>
            <div>
                <label>State:</label>
                <input type="text" name="state" placeholder="optional"/>
            </div>
            <div>
                <label>Zip:</label>
                <input type="text" name="zip" placeholder="optional"/>
            </div>
            <div>
                <label>Country:</label>
                <input type="text" name="country" placeholder="optional"/>
            </div>
            <div>
                <label>Comments:</label>
                <textarea name="comments" placeholder="optional"></textarea>
            </div>
            <div>
                <input type="submit" value="Send"/>
            </div>
        </form>
    </div>
    <a class="close-reveal-modal">&#215;</a>
</div>