

    $.ajax({
        url:"../api/load-gallery",
        type: "GET",
        dataType: "json",
        success: (data) => { 
        	$("#gallery-row").empty();
        	$.each(data.gallery, (i, e)=>{

        		$("#gallery-row").append(`
                <div class="col-md-4" style="padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px;">
                  <a
                     data-fancybox="gallery"
                     data-src="../${e.dir}"
                     data-caption="Optional caption,&lt;br /&gt;that can contain &lt;em&gt;HTML&lt;/em&gt; code"
                     >
                    <img src="../${e.dir}" style="height: 100%; width: 100%;" />
                  </a>
                  <button class="btn btn-danger" id="delete-img" data-id="${e.id}" style="width: 100%;">Remove</button>
                </div>
        		`)

        	});

            Fancybox.bind('[data-fancybox]', {
              // Your custom options
            }); 
        }
      });


$(document).on("click", "#delete-img", (e)=>{

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
    url:"../api/delete-file",
    type: "POST",
    dataType: "json",
    data: {
      imgid: e.target.dataset.id,
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
      title: 'deleted succesfully.',
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

$(document).on("click", "#add-image", ()=>{

	$("#upload-modal").modal("show");

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
            url: '../api/upload-gallery',
            method: 'POST',
            withCredentials: false,
            onload: (response) => {

            // $("#send-request").attr("data-random", random);    
            
            },
        },
        
    },
    });

  document.addEventListener('FilePond:processfiles', (e) => {

  specupload.removeFiles();

  location.reload();

  });
});