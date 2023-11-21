

    $.ajax({
        url:"../api/load-dashboard",
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
                    <td>
                        ${e.title}
                       
                    </td>
                    <td>${e.address}</td>
                    <td>${e.date_inserted}</td>
                    <td>${e.status == 1 ? '<span class="badge bg-secondary rounded-3 fw-semibold">Approve</span>' : '<span class="badge bg-success rounded-3 fw-semibold">Pending</span>' }</td>
                </tr>
            `)

        });
        }else{
            alert('Not and admin account!');
            window.location.href = "http://localhost/batangas/index.php";
        } 

        }
      });