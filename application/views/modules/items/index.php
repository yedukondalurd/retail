<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="container">
    <div id="heading">
        <h3>Items</h3>
    </div>
    <div id="items">
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
                        <th>Item Name</th>
                        <th>Supplier Name</th>
                        <th>Quantity</th>
                        <th>Location</th>
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
    <div id="new-item">
        <form action="" method="post" row_position="">
            <div>
                <label>UPC/EAN/ISBN</label>
                <input type="text" name="upc_ean_isbn" class="required" placeholder="required" id="focus_in"/>
            </div>
            <div>
                <label>Item Name:</label>
                <input type="text" name="item_name" class="required" placeholder="required"/>
            </div>
            <div>
                <label>Category:</label>
                <input type="text" name="category" placeholder="optional"/>
            </div>
            <div>
                <label>Supplier:</label>
                <input type="text" name="supplier" class="digits" placeholder="optional"/>
            </div>
            <div>
                <label>Cost Price:</label>
                <input type="text" name="cost_price" placeholder="optional"/>
            </div>
            <div>
                <label>Unit Price:</label>
                <input type="text" name="unit_price" placeholder="optional"/>
            </div>
            <div>
                <label>Promo Price:</label>
                <input type="text" name="promo_price" placeholder="optional"/>
            </div>
            <div>
                <label>Start Date:</label>
                <input type="text" name="start_date" placeholder="optional"/>
            </div>
            <div>
                <label>End Date:</label>
                <input type="text" name="end_date" placeholder="optional"/>
            </div>
            <div>
                <label>Tax 1:</label>
                <input type="text" name="tax1" placeholder="optional"/>
            </div>
            <div>
                <label>Quantity:</label>
                <input type="text" name="quantity" placeholder="optional"/>
            </div>
            <div>
                <label>Location:</label>
                <input type="text" name="location" placeholder="optional"/>
            </div>
            <div>
                <label>Description:</label>
                <textarea name="description" placeholder="optional"></textarea>
            </div>
            <div>
                <input type="submit" value="Send"/>
            </div>
        </form>
    </div>
    <a class="close-reveal-modal">&#215;</a>
</div>