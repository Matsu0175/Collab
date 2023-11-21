



$(document).on("click", "#update", ()=>{

$.ajax({
    url:"api/update-post-details",
    type: "POST",
    dataType: "json",
    data: {
       id: $("#details-modal").data("id"),
       title: $("#epost-title").val(),
       address: $("#epost-address").val(),
       desc: $("#epost-desc").val(),
       hist: $("#epost-history").val(),
       transpo: $("#epost-transpo").val(),
       dist: $("#edistrict").val()
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

$(document).on("click", "#delete-post", (e)=>{
Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {

    $.ajax({
        url:"api/post-delete",
        type: "POST",
        dataType: "json",
        data: {
          id: e.target.dataset.id
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

        location.reload();
      }

     }); 

  }
});
})  

$(document).on("click", "#edit-post", (e)=>{

$.ajax({
    url:"api/view-post-details",
    type: "POST",
    dataType: "json",
    data: {
      id: e.target.dataset.id
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

    $("#details-modal").modal("show");
    $("#details-modal").data("id", e.target.dataset.id);
    $("#epost-title").val(data.posts[0].title);
    $("#epost-address").val(data.posts[0].address);
    $("#epost-transpo").val(data.posts[0].transpo);
    $("#epost-desc").val(data.posts[0].desc);
    $("#epost-history").val(data.posts[0].history);
    $("select option[value='"+data.posts[0].district+"']").attr("selected","selected");
  }

 }); 


});

$(document).on("keyup", "#placename", ()=>{

$.ajax({
    url:"api/search-place",
    type: "POST",
    dataType: "json",
    data: {
      name: $("#placename").val()
    },
    success: (data) => { 

    $("#post-container").empty();
    
    $.each(data.posts, (i, e)=>{

      $("#post-container").append(`
      <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
        <div class="chef-member">
          <div class="member-img">
            <img src="${e.images[0].dir}" class="img-fluid" alt="" style="height: 255px !important;">

          </div>
          <div class="member-info">
            <h4>${e.title}</h4>
            <span>Posted: ${e.date_posted}</span>
            <span>${e.address}</span>
            <div id="rater-${e.id}"></div>
            <p>${e.desc}</p>
            <a class="btn btn-danger" href="viewpost.php?id=${e.id}"><i class="bi bi-eye"></i> View more</a>
          </div>
        </div>
      </div>
      `)
    raterJs({
            max:5, 
            rating: Number(e.rating), 
            element:document.querySelector("#rater-"+e.id), 
            disableText:"Custom disable text!", 
            ratingText:"My custom rating text {rating}",
            showToolTip:true
        })
    });

  }

 }); 

});

$(document).on("click", "#sendfeedback", (e)=>{

if ($("#name").val() == "" || $("#email").val() == "" || $("#subject").val() == "" || $("#message").val() == "") {
    Swal.fire({
      icon: 'error',
      title: 'Empty Fields',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok'
    }).then((result) => {
      if (result.isConfirmed) {
        
      }
    })
}else{
$.ajax({
    url:"api/send-feedback",
    type: "POST",
    dataType: "json",
    data: {
      name: $("#name").val(),
      email: $("#email").val(),
      subject: $("#subject").val(),
      message: $("#message").val() 
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
      title: 'Sent succesfully.',
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
}



});



$(document).on("click", "#update-password", (e)=>{

$.ajax({
    url:"api/update-password",
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
    url:"api/update-profile",
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

$(document).on("change", "#sortcategory", ()=>{

$.ajax({
    url:"api/sort-category",
    type: "POST",
    dataType: "json",
    data: {
      category: $("#sortcategory").val()  
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

    $("#post-container").empty();
    
    $.each(data.posts, (i, e)=>{

      $("#post-container").append(`
      <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
        <div class="chef-member">
          <div class="member-img">
            <img src="${e.images[0].dir}" class="img-fluid" alt="" style="height: 255px !important;">

          </div>
          <div class="member-info">
            <h4>${e.title}</h4>
            <span>Posted: ${e.date_posted}</span>
            <span>${e.address}</span>
            <div id="rater-${e.id}"></div>
            <p>${e.desc}</p>
            <a class="btn btn-danger" href="viewpost.php?id=${e.id}"><i class="bi bi-eye"></i> View more</a>
          </div>
        </div>
      </div>
      `)
    raterJs({
            max:5, 
            rating: Number(e.rating), 
            element:document.querySelector("#rater-"+e.id), 
            disableText:"Custom disable text!", 
            ratingText:"My custom rating text {rating}",
            showToolTip:true
        })
    });

    }
   });

});


$(document).on("change", "#district", ()=>{

$.ajax({
    url:"api/sort-post",
    type: "POST",
    dataType: "json",
    data: {
      district: $("#district").val()  
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

    $("#post-container").empty();
    
    $.each(data.posts, (i, e)=>{

      $("#post-container").append(`
      <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
        <div class="chef-member">
          <div class="member-img">
            <img src="${e.images[0].dir}" class="img-fluid" alt="" style="height: 255px !important;">

          </div>
          <div class="member-info">
            <h4>${e.title}</h4>
            <span>Posted: ${e.date_posted}</span>
            <span>${e.address}</span>
            <div id="rater-${e.id}"></div>
            <p>${e.desc}</p>
            <a class="btn btn-danger" href="viewpost.php?id=${e.id}"><i class="bi bi-eye"></i> View more</a>
          </div>
        </div>
      </div>
      `)
    raterJs({
            max:5, 
            rating: Number(e.rating), 
            element:document.querySelector("#rater-"+e.id), 
            disableText:"Custom disable text!", 
            ratingText:"My custom rating text {rating}",
            showToolTip:true
        })
    });

    }
   });

});



$(document).on("click", "#post-comment", ()=>{

$.ajax({
    url:"api/publish-comment",
    type: "POST",
    dataType: "json",
    data: {
      rate: $("#rate-modal").data("rate"),
      comment: $("#usercomment").val(),
      postid: $("#postid").val()
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

    if (data.response == 1) {

    Swal.fire({
      icon: 'success',
      title: 'Posted succesfully.',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok'
    }).then((result) => {
      if (result.isConfirmed) {
        location.reload();
      }
    })

    }else if(data.response == 0){

    Swal.fire({
      icon: 'error',
      title: 'You have rated on this post.',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok'
    }).then((result) => {
      if (result.isConfirmed) {
       
      }
    })  
      
  }else if(data.response == 2){

  $("#login-modal").modal("show");
      
  }

    }
   });

});

$(document).on("click", "#postcomment", ()=>{

  $("#rate-modal").modal("show");

  raterJs({
      starSize:32,
      element:document.querySelector("#rater"),
      rateCallback:function rateCallback(rating, done) {
      $("#rate-modal").data("rate", rating);
      this.setRating(rating); 
      done(); 
          
      }
  })

});

$(document).on("click", "#published", (e)=>{

if (e.target.dataset.lat == 0) {
    Swal.fire({
      icon: 'error',
      title: 'No location selected in the map',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok'
    }).then((result) => {
      if (result.isConfirmed) {

      }
    })
}else{

  if (e.target.dataset.img == 1) {
  $.ajax({
      url:"api/publish-post",
      type: "POST",
      dataType: "json",
      data: {
         random: $("#post-modal").data("random"),
         title: $("#post-title").val(),
         address: $("#post-address").val(),
         desc: $("#post-desc").val(),
         hist: $("#post-history").val(),
         transpo: $("#post-transpo").val(),
         dist: $("#district").val(),
         lat: e.target.dataset.lat,
         long: e.target.dataset.long,
         cat: $("#category").val()
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
        title: 'Published succesfully, wait for admin approval.',
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
  }else{
    Swal.fire({
      icon: 'error',
      title: 'No image uploaded',
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

$(document).on("click", "#makepost", ()=>{

    $("#post-modal").modal("show");

    let random = Math.floor(Math.random() * 10000);

    FilePond.registerPlugin(
      // encodes the file as base64 data
      FilePondPluginFileEncode,
      
      // validates files based on input type
      FilePondPluginFileValidateType,
      
      // corrects mobile image orientation
      FilePondPluginImageExifOrientation,
      
      // previews the image
      
      // crops the image to a certain aspect ratio
      FilePondPluginImageCrop,
      
      // resizes the image to fit a certain size
      FilePondPluginImageResize,
      
      // applies crop and resize information on the client
      FilePondPluginImageTransform
    );

        // Select the file input and use create() to turn it into a pond
    var specupload = FilePond.create(
      document.querySelector('.filepond-233'),
      {
      labelIdle: `Drag & Drop your files or <span class="filepond--label-action">Browse</span>`
      }
    );

     FilePond.setOptions({
      server: {
      url: "",
      timeout: 60000,
      process: {
            url: 'api/upload-images/'+random,
            method: 'POST',
            withCredentials: false,
            onload: (response) => {

            // $("#send-request").attr("data-random", random);    
            $("#post-modal").data("random", random);
            },
        },
        
    },
    });

    document.addEventListener('FilePond:processfiles', (e) => {

    $("#published").attr("data-img", "1");

    });

});

$(document).on("click", "#logout", ()=>{

$.ajax({
    url:"api/user-logout",
    type: "POST",
    dataType: "json",
    data: {
       data: 1
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
      title: 'Logout succesfully',
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


$(document).on("click", "#signin", ()=>{

$.ajax({
    url:"api/user-login",
    type: "POST",
    dataType: "json",
    data: {
        email: $("#s-email").val(),
        password: $("#s-password").val()
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

    $("#login-modal").modal("hide");

    location.reload();

    }else{

    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: data.response
    });
    
    }


    }
   });

});


$(document).on("click", "#signup", ()=>{

$.ajax({
    url:"api/user-register",
    type: "POST",
    dataType: "json",
    data: {
        fullname: $("#r-fname").val(),
        email: $("#r-email").val(),
        password: $("#r-password").val()
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
      title: data.response,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok'
    }).then((result) => {
      if (result.isConfirmed) {
       
      }
    })
    }
   });

});

$(document).on("click", "#login-btn", ()=>{

 $("#login-modal").modal("show");

});


const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login')

registerBtn.addEventListener('click', () => {
  container.classList.add('active');
});

loginBtn.addEventListener('click', () => {
  container.classList.remove('active');
});