$(document).on("click", "#update-password", (e)=>{

$.ajax({
    url:"../api/update-password",
    type: "POST",
    dataType: "json",
    data: {
      userid: e.target.dataset.id,
      oldpassword: $("#o-pass").val(),
      newpassword: $("#n-pass").val() 
    },
    beforeSend: (e) => {
    Swal.fire({
      html: 'Loading...',
      didOpen: () => {
        Swal.showLoading()
      }
    })
    },
    success: (data) => { 

    Swal.close(); 

    if (data.status == 1) {
    Swal.fire({
      icon: 'success',
      title: 'Updated succesfully.',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok'
    }).then((result) => {
      if (result.isConfirmed) {
        location.reload();
      }
    })
    }else{
    Swal.fire({
      icon: 'error',
      title: data.response,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok'
    }).then((result) => {
      if (result.isConfirmed) {
       
       
      }
    }) 
    }


  }

 }); 

});


$(document).on("click", "#update-profile", (e)=>{

$.ajax({
    url:"../api/update-profile",
    type: "POST",
    dataType: "json",
    data: {
      userid: e.target.dataset.id,
      username: $("#username").val(),
      email: $("#email").val() 
    },
    beforeSend: (e) => {
    Swal.fire({
      html: 'Loading...',
      didOpen: () => {
        Swal.showLoading()
      }
    })
    },
    success: (data) => { 

    Swal.close(); 
    Swal.fire({
      icon: 'success',
      title: 'Updated succesfully.',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok'
    }).then((result) => {
      if (result.isConfirmed) {
        location.reload();
      }
    })
  }

 }); 

});