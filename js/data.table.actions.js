/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
(function($){
    $.dataTableActions=function(options1){
        var defaults={
            responseData:'',
            currentTableData:'',
            rowPosition:''
        };
        var options=$.extend(defaults, options1);
        if(options.responseData.page=='customers'){
            pages.customers(options);
        }
        if(options.responseData.page=='items'){
            pages.items(options);
        }
    }
    var pages={
        customers:function(options){
            if(options.responseData.action=='add'){
                $('#myModal .close-reveal-modal').click();
                notify(options.responseData.message,'bottomRight',options.responseData.status);
                options.currentTableData.fnAddData( [
                    options.responseData.data.first_name,
                    options.responseData.data.last_name,
                    options.responseData.data.email,
                    options.responseData.data.phone_number,
                    options.responseData.dataLinks.replace(/replaceId/g,options.responseData.data.id) 
                    ] );
            }
            if(options.responseData.action=='edit'){
                $('#myModal .close-reveal-modal').click();
                notify(options.responseData.message,'bottomRight',options.responseData.status);
                options.currentTableData.fnUpdate( [
                    options.responseData.data.first_name ], parseInt(options.rowPosition),parseInt(0));
                options.currentTableData.fnUpdate( [
                    options.responseData.data.last_name ], parseInt(options.rowPosition),parseInt(1));
                options.currentTableData.fnUpdate( [
                    options.responseData.data.email ], parseInt(options.rowPosition),parseInt(2));
                options.currentTableData.fnUpdate( [
                    options.responseData.data.phone_number ], parseInt(options.rowPosition),parseInt(3));
            //            options.currentTableData.fnUpdate( [
            //                options.responseData.data.first_name, 
            //                options.responseData.data.last_name,
            //                options.responseData.data.email, 
            //                options.responseData.data.phone_number,
            //                '<a href="customers/edit" customer_id="'+options.responseData.data.id+'" class="editEnqBtn">Edit</a><a href="customers/delete" customer_id="'+options.responseData.data.id+'" class="delEnqBtn">Delete</a>'], parseInt(options.rowPosition) );
            }
        },
        items:function(options){
            if(options.responseData.action=='add'){
                $('#myModal .close-reveal-modal').click();
                notify(options.responseData.message,'bottomRight',options.responseData.status);
                options.currentTableData.fnAddData( [
                    options.responseData.data.item_name,
                    options.responseData.data.supplier,
                    options.responseData.data.quantity,
                    options.responseData.data.location,
                    options.responseData.dataLinks.replace(/replaceId/g,options.responseData.data.id) 
                    ] );
            }
            if(options.responseData.action=='edit'){
                $('#myModal .close-reveal-modal').click();
                notify(options.responseData.message,'bottomRight',options.responseData.status);
                options.currentTableData.fnUpdate( [
                    options.responseData.data.item_name ], parseInt(options.rowPosition),parseInt(0));
                options.currentTableData.fnUpdate( [
                    options.responseData.data.supplier ], parseInt(options.rowPosition),parseInt(1));
                options.currentTableData.fnUpdate( [
                    options.responseData.data.quantity ], parseInt(options.rowPosition),parseInt(2));
                options.currentTableData.fnUpdate( [
                    options.responseData.data.location ], parseInt(options.rowPosition),parseInt(3));
            //            options.currentTableData.fnUpdate( [
            //                options.responseData.data.first_name, 
            //                options.responseData.data.last_name,
            //                options.responseData.data.email, 
            //                options.responseData.data.phone_number,
            //                '<a href="customers/edit" customer_id="'+options.responseData.data.id+'" class="editEnqBtn">Edit</a><a href="customers/delete" customer_id="'+options.responseData.data.id+'" class="delEnqBtn">Delete</a>'], parseInt(options.rowPosition) );
            }
        }
    }
}(jQuery));


