
    
    $.ajax({
        url:"../api/load-feed-admin",
        type: "GET",
        dataType: "json",
        success: (data) => { 

        $("#table-feed").empty();

        $.each(data.feed, (i, e)=>{

        	$("#table-feed").append(`
        		<tr>
        			<td>${e.email}</td>
        			<td>${e.name}</td>
                    <td>${e.subject}</td>
        			<td>${e.message}</td>
        			<td>${e.date_inserted}</td>
        		</tr>
        	`)

        });

        }
      });