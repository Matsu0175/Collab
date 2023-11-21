
<?php include 'css/login.css' ?>


<div class="modal fade" id="rate-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<center><div id="rater"></div>	</center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="post-comment">Post</button>
      </div>
    </div>
  </div>
</div>



<!--Login Modal -->
<div class="modal fade" id="login-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

		  <div class="container-form" id="container">
		    <div class="form-container sign-up">
		      <form>
		        <h1>Create Account</h1>
		        Use your email to register</span>
		        <input type="text" placeholder="Name" id="r-fname">
		        <input type="email" placeholder="Email" id="r-email">
		        <input type="password" placeholder="Password" id="r-password">
		        <button type="button" id="signup">Sign Up</button>
		      </form>
		    </div>
		    <div class="form-container sign-in">
		      <form>
		        <h1>Sign In</h1>
		        <div class="social-icons">
		        </div>
		        <span>Use your email/password</span>
		        <input type="email" placeholder="Email" id="s-email">
		        <input type="password" placeholder="Password" id="s-password">
		        <a href="#">Forget your Password?</a>
		        <button type="button" id="signin">Sign In</button>
		      </form>
		    </div>
		    <div class="toggle-container">
		      <div class="toggle">
		        <div class="toggle-panel toggle-left">
		          <h1>Welcome Back!</h1>
		          <p>Enter your Personal details to use all of site features</p>
		          <button class="hidden" id="login">Sign In</button>
		        </div>
		        <div class="toggle-panel toggle-right">
		          <h1>Hello, Friend!</h1>
		          <p>Register with your Personal details to use all of site features</p>
		          <button class="hidden" id="register">Sign Up</button>
		        </div>
		      </div>
		    </div>
		  </div>


      </div>
    </div>
  </div>
</div>