function edit(id){
    dataId = {id:id}
    $.ajax({
        url:"retriveSingleRecord.php",
        type:'post',
        data: JSON.stringify(dataId),
        dataType:"json",
         success:function(data,status){
            // console.log(data);
             response ='';
             console.log(data);
             if(data){
                 count = data;
                 //console.log(count.length)
             }
             else{
                 count='';
             }
             for(i = 0; i < count.length; i++){
                if(count[i].status == 'approved'){
                    value1 = 'approved'
                    value2 = 'none'
                   // alert(value1)
                    }else if(count[i].status == 'rejected'){
                        value1 = 'none'
                        value2 = 'rejected'
                        //$("#inlineRadio2_edit").prop('checked', true)
                        //alert(value2)
                    }

               response+= "<div class='col-md-6'>"
               response+= "<label for='Name' class='form-label'>Name</label>"
               response+= "<input type='text' value="+count[i].name+" class='form-control' name='name_edit'>"
               response+= "</div>"
               response+= "<div class='col-md-6'>"
               response+= "<label for='Email' class='form-label'>Email</label>"
               response+= "<input type='text' value="+count[i].email+" class='form-control' name='email_edit'>"
               response+= "</div>"
               response+= "<div class='col-md-6'>"
               response+= "<label for='dob' class='form-label'>Age</label>"
               response+= "<input type='date' value="+count[i].date_of_birth+" class='form-control' name='dob_edit'>"
               response+= "</div>"
               response+= "<div class='col-md-6'>"
               response+= "<label for='Education' class='form-label'>Education</label>"
               response+= "<select name='education_edit' class='form-select'>"
               response+= "<option selected value="+count[i].education+">"+count[i].education+"</option>"
               response+= "<option value='Elementary Education'>Elementary Education</option>"
               response+= "<option value='Secondary & Higher Secondary Education'>Secondary & Higher Secondary Education</option>"
               response+= "<option value='Higher Education'>Higher Education</option>"
               response+= "</select>"
               response+= "</div>"
               response+= "<div class='col-12'>"
               response+= "<label for='Address' class='form-label'>Address</label>"
               response+= "<textarea class='form-control' name='address_edit' rows='3'>"+count[i].address+"</textarea>"
               response+= "</div>"
               response+= "<div class='col-md-6'>"
               response+= "<label for='inputState' class='form-label'>Country</label>"
               response+= "<select name='country_edit' class='form-select country-list' onChange='getState(this.value)'>"
               response+= "<option value=''>Select Country</option>"
               response+= "<option selected value="+count[i].country_id+">"+count[i].country+"</option>"
               response+= "</select>"
               response+= "</div>"
               response+= "<div class='col-md-6'>"
               response+= "<label for='inputState' class='form-label'>State</label>"
               response+= "<select name='state_edit' class='form-select state-list'  onChange='getCity(this.value)'>"
               response+= "<option value=''>Select State</option>"
               response+= "<option selected value="+count[i].state_id+">"+count[i].state+"</option>"
               response+= "</select>"
               response+= "</div>"
               response+= "<div class='col-md-6'>"
               response+= "<label for='inputState' class='form-label'>City</label>"
               response+= "<select name='city_edit' class='form-select city-list'>"
               response+= "<option value=''>Select City</option>"
               response+= "<option selected value="+count[i].city_id+">"+count[i].city+"</option>"
               response+= "</select>"
               response+= "</div>"
               response+= "<div class='col-md-6'>"
               response+= "<label for='inputZip' class='form-label'>Zip</label>"
               response+= "<input type='text' value="+count[i].pin_code+" class='form-control' name='pin_code_edit'>"
               response+= "</div>"
               response+= "<div class='col-md-6'>"
               response+= "<label for='formFile' class='form-label'>Profile Picture</label>"
               response+= "<input type='file' accept='image/*' name='image-edit' value="+count[i].profile_pic+" size='50'/>"
               response+= "</div>"
               response+= "<span>Status</span>"
               response+= "<div class='col-md-12'>"
               response+= "<div class='form-check form-check-inline'>"
               response+= "<input class='form-check-input' value="+value1+" type='radio' name='status_edit' id='inlineRadio1_edit' onClick=this.value='approved'>"
               response+= "<label class='form-check-label' for='inlineRadio1'>Approve</label>"
               response+= "</div>"
               response+= "<div class='form-check form-check-inline'>"
               response+= "<input class='form-check-input' value="+value2+" type='radio' name='status_edit' id='inlineRadio2_edit' onClick=this.value='rejected'>"
               response+= "<label class='form-check-label' for='inlineRadio2'>Reject</label>"
               response+= "</div>"
               response+= "<input type='hidden' value="+count[i].unique_id+" name='unique_id'>"
               response+= "</div>"
               response+= "</div>"
               

             }
             $('#update_record').html(response);
             countylist();
             //alert($("#inlineRadio2_edit").val())
             if($("#inlineRadio1_edit").val() == 'approved'){
                $("#inlineRadio1_edit").prop('checked', true)
            }else if($("#inlineRadio2_edit").val()=='rejected'){
                $("#inlineRadio2_edit").prop('checked', true)
            }
         }    
    })
}

function retriveRecord(){

    $.ajax({
        url:"retriveRecord.php",
        type:'get',
        dataType:"json",
         success:function(data,status){
             response ='';
             //console.log(data);
             if(data){
                 count = data;
                 //console.log(count.length)
             }
             else{
                 count='';
             }if(data){
                for(i = 0; i < count.length; i++){
                    //console.log(i+'  '+count[i].unique_id)
                    if(count[i].profile_pic != ''){
                       img = "<img class='profile' src="+location.protocol+'//'+window.location.host+'/DCKAP/'+count[i].profile_pic+"></img>"
                    }else{
                       img = "<img class='profile' src='img/no-image-icon-23485.png'>"
                    }
                    response += "<tr><th scope='row'>"+count[i].unique_id+"</th>"
                    response += "<td>"+img+"</td>"
                    response += "<td>"+count[i].name+"</td>"
                    response += "<td>"+count[i].email+"</td>"
                    response += "<td>"+count[i].date_of_birth+"</td>"
                    response += "<td>"+count[i].education+"</td>"
                    response += "<td>"+count[i].status +"</td>"
                    response += "<td>"+count[i].address+"</td>"
                    response += "<td>"+count[i].country+"</td>"
                    response += "<td>"+count[i].state+"</td>"
                    response += "<td>"+count[i].city+"</td>"
                    response += "<td>"+count[i].pin_code+"</td>"
                    response += "<td>"
                    response += "<button data-bs-toggle='modal' data-bs-target='#staticBackdrop2' value="+count[i].unique_id+" onclick='edit("+count[i].unique_id+")'><i class='fa fa-pencil' aria-hidden='true'></i></button>"
                    response += " <button type='button' value="+count[i].unique_id+" onclick='removeRecord("+count[i].unique_id+")'><i class='fa fa-trash' aria-hidden='true'></button>"
                    response += "</td>"
                    response +="</tr>"  
                }
                $('.response-data').html(response);
             }else{
                $('.response-data').html();
             }
            
         }    
    })
    //var name = $("#inputZip").val();
}

function countylist(){
    $.ajax({
        url:"countryList.php",
        type:'get',
        dataType:"json",
         success:function(data,status){
             response ='';
             //console.log(data);
             if(data){
                 list = data;
                 //console.log(count.length)
             }
             else{
                 list='';
             }if(data){
                for(i = 0; i < list.length; i++){
                    response+= "<option value="+list[i].id+">"+list[i].country_name+"</option>" 
                }
                //alert(response);
               $('.country-list').append(response);
             }else{
               // $('.response-data').html();
             }
            
         }    
    })
}

function getState(id){
    $.ajax({
        url:"stateList.php",
        type:'POST',
        data:{id:id},
        dataType:"json",
         success:function(data,status){
             response ='';
             //alert(data);
             if(data){
                 list = data;
                 //console.log(count.length)
             }
             else{
                 list='';
             }if(data){
                for(i = 0; i < list.length; i++){
                    response+= "<option value="+list[i].id+">"+list[i].name+"</option>" 
                }
                //alert(response);
               $('.state-list').html(response);
             }else{
               // $('.response-data').html();
             }
            
         }    
    })
}

function getCity(id){
    $.ajax({
        url:"cityList.php",
        type:'POST',
        data:{id:id},
        dataType:"json",
         success:function(data,status){
             response ='';
             //alert(data);
             if(data){
                 list = data;
                 //console.log(count.length)
             }
             else{
                 list='';
             }if(data){
                for(i = 0; i < list.length; i++){
                    response+= "<option value="+list[i].id+">"+list[i].name+"</option>" 
                }
                //alert(response);
               $('.city-list').html(response);
             }else{
               // $('.response-data').html();
             }
            
         }    
    })
}

$("#add_record").on('submit',(function(e) {
    e.preventDefault();
    e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                if(data == 1){
                    msg =  "<div class='alert alert-success alert-dismissible fade show' role='alert'>Record submitted successfully <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                  $('.response-msg').html(msg); 
                 }else if(data == 'already exist'){
                    msg =  "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Oops! Record already exist for this email <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                    $('.response-msg').html(msg);
                 }else{
                    msg =  "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Oops! Something went wrong <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                    $('.response-msg').html(msg);
                 }
                 
                 retriveRecord(); 
            },
        });
   }));


 //update record 
 
 $("#update_record").on('submit',(function(e) {
    e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                if(data == 'updated'){
                    msg =  "<div class='alert alert-success alert-dismissible fade show' role='alert'>Record updated successfully <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                  $('.response-msg').html(msg); 
                 }else{
                    msg =  "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Oops! Something went wrong <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                    $('.response-msg').html(msg);
                 }
                 retriveRecord(); 
            },
        });
   }));
 
    function removeRecord(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type:'POST',
                    url:'deleteRecord.php',
                    data:{id:id},
                    success:function(data){
                        if(data == 'deleted'){
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                              )
                         }else{
                            msg =  "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Oops! Something went wrong <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                            $('.response-msg').html(msg);
                         }
                         //console.log('hgjhgjg');
                         retriveRecord(); 
                    },
                });
            }
          })
        
    }


$('document').ready(function(){
    retriveRecord(); 
    countylist();
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
})