/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$.customers=function(options){
    var defaults={
        responseData:'',
        currentTableData:'',
        rowPosition:''
    }
    var options=$.extend(options, defaults);
    if(options.responseData.action=='add'){
        this.add(options);
        return;
    }
    if(options.responseData.action=='edit'){
        this.edit(options);
        return;
    }
        
        add:function(options){
            $('#myModal .close-reveal-modal').click();
            notify(options.responseData.message,'bottomRight',options.responseData.status);
            options.currentTableData.fnAddData( [
                options.responseData.data.first_name,
                options.responseData.data.last_name,
                options.responseData.data.email,
                options.responseData.data.phone_number,
                '<a href="customers/editCustomer" customer_id="'+options.responseData.data.id+'" class="editEnqBtn">Edit</a><a href="#" customer_id="'+options.responseData.data.id+'" class="delEnqBtn">Delete</a>' 
                ] );
        }
        edit:function(){
            $('#myModal .close-reveal-modal').click();
            notify(options.responseData.message,'bottomRight',options.responseData.status);
            options.currentTableData.fnUpdate( [
                options.responseData.data.first_name, 
                options.responseData.data.last_name,
                options.responseData.data.email, 
                options.responseData.data.phone_number,
                '<a href="customers/editCustomer" customer_id="'+options.responseData.data.id+'" class="editEnqBtn">Edit</a><a href="#" customer_id="'+options.responseData.data.id+'" class="delEnqBtn">Delete</a>'], parseInt(options.rowPosition) );
        
        }
        delet:function(){
        
        }
}
