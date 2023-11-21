    
    $.ajax({
        url:"../api/load-post-admin",
        type: "GET",
        dataType: "json",
        success: (data) => { 

        if (data.status == 1) {
        $("#totalusers").text(data.countusers); 
        $("#totalpost").text(data.countposts);  
        $("#totalfeed").text(data.countfeedbacks);  

        $("#table-dash").empty();

        $.each(data.posts, (i, e)=>{

          $("#table-dash").append(`
            <tr>
              <td>${e.title} <br>  <div id="rater-${e.id}"></div> </td>
              <td>${e.address}</td>
                    <td><button class="btn btn-primary" id="view-details" data-id="${e.id}">View</button></td>
              <td>${e.date_posted}</td>
              <td>${e.status == 1 ? '<span class="badge bg-secondary rounded-3 fw-semibold">Approve</span>' : e.status == 2 ? '<span class="badge bg-danger rounded-3 fw-semibold">Rejected</span>' : '<span class="badge bg-success rounded-3 fw-semibold">Pending</span>' }</td>
                <td>${e.status == 1 ? '<button data-id="'+e.id+'" class="btn btn-danger" id="remove-post"> Remove </button>' : e.status == 2 ? '' : '<button data-id="'+e.id+'" class="btn btn-primary" id="approve-post"> Approve </button> <button class="btn btn-danger" data-id="'+e.id+'" id="reject-post"> Reject </button>' }</td>   
                </tr>
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
        }else{
            alert('Not and admin account!');
            window.location.href = "http://localhost/batangas/index.php";
        } 

        }
      });

    $(document).on("click", "#view-details", (e)=>{

        $.ajax({
            url:"../api/view-post-details",
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
            $("#desc").text(data.posts[0].desc);
            $("#transpo").text(data.posts[0].transpo);
            $("#history").text(data.posts[0].history);
            $("#img").empty();
            $.each(data.posts[0].images, (i, e)=>{

              $("#img").append(`
                <div class="col-md-4" style="  padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px;">
                  <a
                     data-fancybox="gallery"
                     data-src="../${e.dir}"
                     data-caption="Optional caption,&lt;br /&gt;that can contain &lt;em&gt;HTML&lt;/em&gt; code"
                     >
                    <img src="../${e.dir}" style="height: 100px; width: 100px;" />
                  </a>
                </div>
              `)

            });
            Fancybox.bind('[data-fancybox]', {
              // Your custom options
            }); 
          }

         }); 

    });


    $(document).on("click", "#approve-post", (e)=>{

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, approve it!"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
            url:"../api/set-post",
            type: "POST",
            dataType: "json",
            data: {
              id: e.target.dataset.id,
              status: 1 
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
              title: 'Approved succesfully.',
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

    });


    $(document).on("click", "#remove-post", (e)=>{

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, remove it!"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
            url:"../api/set-post",
            type: "POST",
            dataType: "json",
            data: {
              id: e.target.dataset.id,
              status: 3 
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
              title: 'Removed succesfully.',
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

    });    


    $(document).on("click", "#reject-post", (e)=>{

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, reject it!"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
            url:"../api/set-post",
            type: "POST",
            dataType: "json",
            data: {
              id: e.target.dataset.id,
              status: 2 
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
              title: 'Rejected succesfully.',
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

    });    