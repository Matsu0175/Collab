
    
    $.ajax({
        url:"../api/load-users-admin",
        type: "GET",
        dataType: "json",
        success: (data) => { 

        $("#table-user").empty();

        $.each(data.users, (i, e)=>{

        	$("#table-user").append(`
        		<tr>
        			<td>${e.email}</td>
        			<td>${e.username}</td>
                    <td>${e.status == 1 ? '<span class="badge bg-secondary rounded-3 fw-semibold">Verified</span>' : '<span class="badge bg-danger rounded-3 fw-semibold">Pending</span>'}</td>
        			<td>${e.register}</td>
        			<td>${e.lastlogin}</td>
                    <td><button class="btn btn-danger" id="remove-user" data-id="${e.id}">Remove</button></td>
        		</tr>
        	`)

        });

        }
      });


    $(document).on("click", "#remove-user", ()=>{

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
            url:"../api/remove-user",
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