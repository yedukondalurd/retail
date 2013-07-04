<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="container">
    <div id="heading">
        <h3>Employees</h3>
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
<div id="new-employee">
    <div id="myModal" class="reveal-modal">
        <h2>New Employee</h2>

        <form action="" method="post" row_position="">
            <fieldset class="employee-general-information">
                <legend>Employee Information</legend>
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
            </fieldset>
            <fieldset class="employee-login-information">
                <legend>Employee Login Information</legend>
                <div>
                    <label>Username</label>
                    <input type="text" name="username" class="required" placeholder="required"/>
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" class="required" placeholder="required" id="edit-password"/>
                </div>
                <div>
                    <label>Confirm Password</label>
                    <input type="password" equalto="#edit-password" name="confirm_password" class="required" placeholder="required" id="edit-confirm-password"/>
                </div>
            </fieldset>
            <fieldset class="employee-permissions">
                <legend>Employee Permissions</legend>
                <ul>
                    <li>
                        <div>
                            <label>Customers</label>
                            <input type="checkbox" module-name="customers" class="check-all-permissions"/>
                        </div>
                        <ul>
                            <li><label>Add</label><input type="checkbox" value="3" has-module-name="customers" name="permissions[]" class="check-single-permissions"/></li>
                            <li><label>Edit</label><input type="checkbox" value="4" has-module-name="customers" name="permissions[]" class="check-single-permissions"/></li>
                            <li><label>View</label><input type="checkbox" value="2" has-module-name="customers" name="permissions[]" class="check-single-permissions"/></li>
                            <li><label>Delete</label><input type="checkbox" value="5" has-module-name="customers" name="permissions[]" class="check-single-permissions"/></li>
                        </ul>
                    </li>
                    <li>
                        <div>
                            <label>Items</label>
                            <input type="checkbox" module-name="items" class="check-all-permissions"/>
                        </div>
                        <ul>
                            <li><label>Add</label><input type="checkbox" value="7" has-module-name="items" name="permissions[]" class="check-single-permissions"/></li>
                            <li><label>Edit</label><input type="checkbox" value="8" has-module-name="items" name="permissions[]" class="check-single-permissions"/></li>
                            <li><label>View</label><input type="checkbox" value="6" has-module-name="items" name="permissions[]" class="check-single-permissions"/></li>
                            <li><label>Delete</label><input type="checkbox" value="9" has-module-name="items" name="permissions[]" class="check-single-permissions"/></li>
                        </ul>
                    </li>
                    <li>
                        <div>
                            <label>Employees</label>
                            <input type="checkbox" module-name="employees" class="check-all-permissions"/>
                        </div>
                        <ul>
                            <li><label>Add</label><input type="checkbox" value="14" has-module-name="employees" name="permissions[]" class="check-single-permissions"/></li>
                            <li><label>Edit</label><input type="checkbox" value="15" has-module-name="employees" name="permissions[]" class="check-single-permissions"/></li>
                            <li><label>View</label><input type="checkbox" value="13" has-module-name="employees" name="permissions[]" class="check-single-permissions"/></li>
                            <li><label>Delete</label><input type="checkbox" value="16" has-module-name="employees" name="permissions[]" class="check-single-permissions"/></li>
                        </ul>
                    </li>
                </ul>
            </fieldset>
            <div>
                <input type="submit" value="Send"/>
            </div>
        </form>

        <a class="close-reveal-modal">&#215;</a>
    </div>
    <div style="clear: both;"></div>
</div>