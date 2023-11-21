<br>
<br>
<br>
<br>
<div class="row">
	
		<div class="card">
			<div class="card-header">
				<h4>My Profile</h4>
			</div>
	        <div class="card-body ">

	        	<div class="row">
		          <div class="col-md-6">
		            <div class="mb-3">
		              <label for="exampleInputEmail1" class="form-label">Email address</label>
		              <input type="email" class="form-control" id="email" value="<?= $_SESSION['auth_email']; ?>">
		          
		            </div>
		            <div class="mb-3">
		              <label for="exampleInputEmail1" class="form-label">Username</label>
		              <input type="text" class="form-control" id="username" value="<?= $_SESSION['auth_username']; ?>">
		   
		            </div>
		            <button type="button" class="btn btn-primary" id="update-profile" data-id="<?= $_SESSION['auth_user_id']; ?>">Update</button>
		          </div>
		          <div class="col-md-6">
		            <div class="mb-3">
		              <label for="exampleInputEmail1" class="form-label">Old Password</label>
		              <input type="email" class="form-control" id="o-pass" aria-describedby="emailHelp">
		          
		            </div>
		            <div class="mb-3">
		              <label for="exampleInputEmail1" class="form-label">New Password</label>
		              <input type="text" class="form-control" id="n-pass" aria-describedby="emailHelp">
		   
		            </div>
		            <button type="button" class="btn btn-primary" id="update-password" data-id="<?= $_SESSION['auth_user_id']; ?>">Update Password</button>
		          </div>
	        	</div>

	        </div>
	      </div>

</div>