/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    /*Binding data Tbles*/
    var oTable = $('#generate_list').dataTable({
        "sDom": "<'row'<'span7'l><'span5'f>r>t<'row'<'span7'i><'span5'p>>",
        "sPaginationType": "bootstrap"
    });
    /*add button click event*/
    $("#left_menu .addEnqBtn").live('click', function(){
        $('#edit-password').attr('placeholder','required');
        $('#edit-confirm-password').attr('placeholder','required');
        $('#edit-password').addClass('required');
        $('#edit-confirm-password').addClass('required');
        var getUrl=$(this).attr('href');//Get add button href
        $('#myModal form').attr('action',getUrl);//add to form action 
        $('#myModal form')[0].reset();//Resetting the form data
        $('#myModal form label[class=error]').hide();//Hiding the validation messages
        $('#myModal').reveal();//Modal box show
        $('#focus_in').focus();
        return false;
    });
    /*add and edit customer form validations*/
    $('#myModal form').validate({
        submitHandler:function(){
            var uRL=$('#myModal form').attr('action');//Get form Url.
            var row_position=$('#myModal form').attr('row_position');//Get the row id to edit
            $.ajax({
                type:'post',
                url:uRL,
                dataType:'json',
                data:$('#myModal form').serialize(),
                before:function(){},
                success:function(response){
                    $.dataTableActions({
                        responseData:response,
                        currentTableData:oTable,
                        rowPosition:row_position
                    });      
                }
            });
        }
    });
    
    /*delete button click event*/
    $("#generate_list tbody tr td .delEnqBtn").live('click', function(){ 
        var aPos = oTable.fnGetPosition(this.parentNode);//Tr position to delete
        //var aData = oTable.fnGetData(aPos[0]);
        var uRL=$(this).attr('href');//Get delete button href
        var row_id=$(this).attr('row_id');//Get row id
        //notify('Are you sure you want to delete','bottomRight','confirm');
        if(confirm('Are you sure you want to perform this action')){
            $.ajax({
                type: "post",
                url: uRL,
                dataType:'json',
                data: {
                    'row_id':row_id
                },
                success: function(response){
                    notify(response.message,'bottomRight',response.status);
                    setTimeout(function(){
                        oTable.fnDeleteRow(aPos[0]);
                    },1000);
                }
            });
        }
        return false;
    });
    /*edit button click event*/
    $("#generate_list tbody tr td .editEnqBtn").live('click', function(){
        $('#edit-password').attr('placeholder','optional');
        $('#edit-confirm-password').attr('placeholder','optional');
        $('#edit-password').removeClass('required');
        $('#edit-confirm-password').removeClass('required');
        var getUrl=$(this).attr('href');//Get edit button href
        $('#myModal form label[class=error]').hide();//Hide validation error messages
        $('#myModal form').attr('action',getUrl);//add to fom action 
        var aPos = oTable.fnGetPosition(this.parentNode);//Get position of row to edit
        //var aData = oTable.fnGetData(aPos[0]);
        var row_id=$(this).attr('row_id');//Row id
        $.ajax({
            type: "post",
            url: getUrl,
            dataType:'json',
            data: {
                'row_id':row_id,
                'status':'getdata'
            },
            success: function(response){
                formTpl(response.data);
                $('#myModal form').attr('row_position',aPos[0]);
                $('#myModal').reveal();
                $('#focus_in').focus();
            }
        });
        return false;
    });
    /*Checking the permissions check boxes*/
    $('.check-all-permissions').live("click",function(){
        var module_name=$(this).attr('module-name');
        $("input[has-module-name="+module_name+"]").attr('checked',this.checked);
        
    });
    $('.check-single-permissions').live("click",function(){
        $(this).change(function(){
            var module_name=$(this).attr('has-module-name');
            if($("input[has-module-name="+module_name+"]").length==$("input[has-module-name="+module_name+"]:checked").length){ 
                $("input[module-name="+module_name+"]").attr('checked',true);
            }
            else{
                $("input[module-name="+module_name+"]").attr('checked',false);
            } 
        });
    });
});
/*tpl for edit data*/
function formTpl(data){
    //var htmlInputData=[];
    //Generating the form data htmls to edit
    $.each(data,function(i,value){
        if(i=='module_id'){
            var permissions = value.split(',');
            $.each(permissions,function(j,permissions_id){
                $("#myModal form input[value='"+parseInt(permissions_id)+"']").click();
            });
        }
        $("#myModal form input[name='"+i+"']").val(value);
        $("#myModal form textarea[name='"+i+"']").val(value); 
    });
}
/*noty for notifications*/
function notify(text,layout,type) {
    var n = noty({
        text: text,
        type: type,
        dismissQueue: true,
        layout: layout,
        theme: 'defaultTheme'
    });
    setTimeout(function(){
        n.close();
    },3000);
}

