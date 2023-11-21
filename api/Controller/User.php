<?php
namespace Controller\User;

use Hashids\Hashids;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


/**
 * 
 */
class User
{
	
	private $hash;
	private $db;
	private $auth;


	function __construct()
	{
        $this->mail = new PHPMailer(true);
		$this->hash = new Hashids('', 10);
		$this->db = new \MeekroDB();
        $this->spreadsheet = new Spreadsheet();
        $this->writer = new Xlsx($this->spreadsheet);
        $this->mkdb = new \PDO('mysql:dbname=batangas_db;host=localhost;charset=utf8mb4', 'root', '');
        $this->auth = new \Delight\Auth\Auth($this->mkdb);
	}
    
    public function delete_file()
    {

        extract($_POST);

        $this->db->query("DELETE FROM gallery WHERE id=%i", $imgid);

        echo json_encode(["response" => 1]);

    }

    public function post_delete()
    {
        extract($_POST);

        $this->db->query("DELETE FROM posts WHERE id=%i", $this->hash->decode($id)[0]);

        echo json_encode(["response" => 1]);
    }

    public function update_post_details()
    {

        extract($_POST);
        $pid = $this->hash->decode($id)[0];

        $this->db->query("UPDATE posts SET title=%s, description=%s, history=%s, address=%s, transpo_info=%s, district=%i WHERE id=%i", 
                          $title, $desc, $hist, $address, $transpo, $dist, $pid);

        echo json_encode(["response" => 1]);

    }

    public function search_place()
    {

        extract($_POST);

        $myposts = $this->db->query("SELECT * FROM posts WHERE status='1' and address LIKE '%$name%'");

        $post_array = [];

        foreach ($myposts as $row) {
            
           $randomid = $row['file_id'];
           $postid = $row['id']; 
           $images = $this->db->query("SELECT * FROM files WHERE randomid='$randomid'"); 

           $avg = $this->db->query("SELECT AVG(rate) as avg from reviews where post_id='$postid' ");

           $post_array[] = ["id" => $this->hash->encode($row['id']),
                            "title" => $row['title'],
                            "desc" => $row['description'],
                            "address" => $row['address'],
                            "transpo" => $row['transpo_info'],
                            "date_posted" => date("F j, Y, g:i a", strtotime($row['date_inserted'])),
                            "status" => $row['status'],
                            "rating" => $avg[0]['avg'],
                            "images" => $images ]; 

        }

        echo json_encode(["posts" => $post_array]);

    }

    public function remove_user()
    {

        extract($_POST);

        $this->db->query("DELETE FROM users WHERE id=%i", $id);


        echo json_encode(["response" => 1]);
    }

    public function load_user_admin()
    {

        $users = $this->db->query("SELECT * FROM users WHERE role='0'");

        $user_arr = [];

        foreach ($users as $row) {
            $user_arr[] = ["id" => $row['id'],
                           "username" => $row['username'],
                           "email" => $row['email'],
                           "status" => $row['verified'],
                           "register" => date("F j, Y, g:i a", $row['registered']),
                           "lastlogin" => date("F j, Y, g:i a", $row['last_login']) ]; 
        }

        echo json_encode(["users" => $user_arr]);
    }

    public function load_feed_admin()
    {

        $feed = $this->db->query("SELECT * FROM feedback ORDER BY id DESC");

        echo json_encode(["feed" => $feed]);

    }

    public function load_gallery()
    {

        $gallery = $this->db->query("SELECT * FROM gallery");

        echo json_encode(["gallery" => $gallery]);

    }

    public function set_post()
    {

        extract($_POST);

        $postid = $this->hash->decode($id)[0];

        $userid = $this->db->query("SELECT b.email FROM posts as a inner join users as b on(a.user_id = b.id) WHERE a.id='$postid'");

        

        if ($status == 1) {
            $this->db->query("UPDATE posts SET status=%i WHERE id=%i", $status, $postid);
            $html = '<h1> Your Post has been approved by the admin. </h1>';
            $this->send_email($html, $userid[0]['email']);

        }else if ($status == 2) {
            $this->db->query("UPDATE posts SET status=%i WHERE id=%i", $status, $postid);
            $html = '<h1> Your Post has been rejected by the admin. </h1>';
            $this->send_email($html, $userid[0]['email']);
        }else{
            $this->db->query("DELETE FROM posts WHERE id=%i", $postid);
            $html = '<h1> Your Post has been remove in the system by the admin. </h1>';
            $this->send_email($html, $userid[0]['email']);
        }

        echo json_encode(["response" => 1]);
    }

    public function send_email($html, $email)
    {

    try {
        //Server settings
        $this->mail->CharSet  = 'UTF-8';
        $this->mail->Encoding = 'base64';
        $this->mail->SMTPDebug = false;                      //Enable verbose debug output
        $this->mail->isSMTP();                                            //Send using SMTP
        $this->mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->mail->Username   = 'conniebenetez@gmail.com';                     //SMTP username
        $this->mail->Password   = 'wdwfpioudaqphwiw';                               //SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $this->mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $this->mail->setFrom('conniebenetez@gmail.com', 'No-reply');

        $this->mail->addAddress($email); 

        //Content
        $this->mail->isHTML(true);                                  //Set email format to HTML
        $this->mail->Subject = 'Batangas System Notification';
        $this->mail->Body    = $html;

        $this->mail->send();
       
        
    } catch (Exception $e) {
        
    }

    }

    public function send_feedback()
    {

        extract($_POST);

        $this->db->insert('feedback', [
                          'email' => $email,
                          'name' => $name,
                          'subject' => $subject,
                          'message' => $message
                        ]);

        echo json_encode(["response" => 1]);
    }

    public function load_dashboard()
    {

        $id = $this->get_user_id();

        $checking = $this->db->query("SELECT * FROM users WHERE id='$id'");

        if ($checking[0]['role'] == 1) {
        $count_posts = $this->db->query("SELECT count(id) as count FROM posts");
        $count_users = $this->db->query("SELECT count(id) as count FROM users WHERE role='0'");
        $count_feedback = $this->db->query("SELECT count(id) as count FROM feedback");   

        $new_posts = $this->db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 5");

        echo json_encode(['posts' => $new_posts,
                          'status' => 1,  
                          'countposts' => $count_posts[0]['count'],
                          'countusers' => $count_users[0]['count'],
                          'countfeedbacks' => $count_feedback[0]['count']]);
        }else{
        echo json_encode(['status' => 0]);    
        }

    }   


    public function update_password()
    {

        extract($_POST);

        try {
            $this->auth->changePassword($oldpassword, $newpassword);

            echo json_encode(["status" => 1]);
        }
        catch (\Delight\Auth\NotLoggedInException $e) {
          
            echo json_encode(["response" => "Not logged in" ,"status" => 0]);
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
          
            echo json_encode(["response" => "Invalid password(s)" ,"status" => 0]);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
     
            echo json_encode(["response" => "Too many requests" ,"status" => 0]);
        }

    }

    public function update_profile()
    {

        extract($_POST);

        $this->db->query("UPDATE users SET username=%s, email=%s WHERE id=%i", $username, $email, $userid);

        $_SESSION['auth_email'] = $email;
        $_SESSION['auth_username'] = $username;

        echo json_encode(["response" => 1]);

    }

    public function publish_comment()
    {
        extract($_POST);

        if ($this->checking_auth()) {
            $userid =  $this->get_user_id();
            $postedid = $this->hash->decode($postid)[0];

            $checking = $this->db->query("SELECT * FROM reviews WHERE user_id='$userid' AND post_id='$postedid'");

            if (!$checking) {
            $this->db->insert('reviews', [
                              'post_id' => $this->hash->decode($postid)[0],
                              'comment' => $comment,
                              'rate' => $rate,
                              'user_id' => $userid
                            ]);

            echo json_encode(["response" => 1]);
            }else{
            echo json_encode(["response" => 0]);    
            }
        }else{
            echo json_encode(["response" => 2]); 
        }





    }

    public function load_single_post()
    {

        extract($_POST);

        $postid = $this->hash->decode($id)[0];

        $post = $this->db->query("SELECT * FROM posts WHERE id='$postid'");

        $post_array = [];

        foreach ($post as $row) {
            
           $randomid = $row['file_id'];
           
           $images = $this->db->query("SELECT * FROM files WHERE randomid='$randomid'"); 

           $post_array[] = ["id" => $this->hash->encode($row['id']),
                            "title" => $row['title'],
                            "desc" => $row['description'],
                            "address" => $row['address'],
                            "transpo" => $row['transpo_info'],
                            "lat" => $row['latitude'],
                            "long" => $row['longitude'],
                            "date_posted" => date("F j, Y, g:i a", strtotime($row['date_inserted'])),
                            "status" => $row['status'],
                            "history" => $row['history'],
                            "images" => $images ]; 

        }

        $comments = $this->db->query("SELECT a.*, b.email, b.username FROM reviews as a inner join users as b on(a.user_id = b.id) where post_id='$postid'");


        echo json_encode(["posts" => $post_array, "comments" => $comments]);

    }

    public function load_post_admin()
    {

        $id = $this->get_user_id();

        $checking = $this->db->query("SELECT * FROM users WHERE id='$id'");

        if ($checking[0]['role'] == 1) {

        $myposts = $this->db->query("SELECT * FROM posts");

        $post_array = [];

        foreach ($myposts as $row) {
            
           $randomid = $row['file_id'];
           $postid = $row['id']; 
           $images = $this->db->query("SELECT * FROM files WHERE randomid='$randomid'"); 

           $avg = $this->db->query("SELECT AVG(rate) as avg from reviews where post_id='$postid' ");

           $post_array[] = ["id" => $this->hash->encode($row['id']),
                            "title" => $row['title'],
                            "desc" => $row['description'],
                            "address" => $row['address'],
                            "transpo" => $row['transpo_info'],
                            "date_posted" => date("F j, Y, g:i a", strtotime($row['date_inserted'])),
                            "status" => $row['status'],
                            "rating" => $avg[0]['avg'],
                            "images" => $images ]; 

        }

        $districts = $this->db->query("SELECT * FROM district");

        echo json_encode(["posts" => $post_array, "district" => $districts, 'status' => 1]);
        }else{
        echo json_encode(['status' => 0]);    
        }


    }

    public function load_post_all()
    {


        $myposts = $this->db->query("SELECT * FROM posts WHERE status='1'");

        $post_array = [];

        foreach ($myposts as $row) {
            
           $randomid = $row['file_id'];
           
           $images = $this->db->query("SELECT * FROM files WHERE randomid='$randomid'"); 
           $postid = $row['id']; 
           $avg = $this->db->query("SELECT AVG(rate) as avg from reviews where post_id='$postid' ");

           $post_array[] = ["id" => $this->hash->encode($row['id']),
                            "title" => $row['title'],
                            "desc" => $row['description'],
                            "address" => $row['address'],
                            "transpo" => $row['transpo_info'],
                            "date_posted" => date("F j, Y, g:i a", strtotime($row['date_inserted'])),
                            "status" => $row['status'],
                            "rating" => $avg[0]['avg'],
                            "images" => $images ]; 

        }

        $districts = $this->db->query("SELECT * FROM district");

        echo json_encode(["posts" => $post_array, "district" => $districts]);

    }

    public function sort_category()
    {

        extract($_POST);

        if ($category == 0) {
        $myposts = $this->db->query("SELECT * FROM posts WHERE status='1'");

        $post_array = [];

        foreach ($myposts as $row) {
            
           $randomid = $row['file_id'];
           $postid = $row['id']; 
           $images = $this->db->query("SELECT * FROM files WHERE randomid='$randomid'"); 

           $avg = $this->db->query("SELECT AVG(rate) as avg from reviews where post_id='$postid' ");

           $post_array[] = ["id" => $this->hash->encode($row['id']),
                            "title" => $row['title'],
                            "desc" => $row['description'],
                            "address" => $row['address'],
                            "transpo" => $row['transpo_info'],
                            "date_posted" => date("F j, Y, g:i a", strtotime($row['date_inserted'])),
                            "status" => $row['status'],
                            "rating" => $avg[0]['avg'],
                            "images" => $images ]; 

        }

        $districts = $this->db->query("SELECT * FROM district");

        echo json_encode(["posts" => $post_array, "district" => $districts]);
        }else{

        $myposts = $this->db->query("SELECT * FROM posts WHERE category='$category' and status='1'");

        $post_array = [];

        foreach ($myposts as $row) {
            
           $randomid = $row['file_id'];
           
           $images = $this->db->query("SELECT * FROM files WHERE randomid='$randomid'"); 

           $post_array[] = ["id" => $this->hash->encode($row['id']),
                            "title" => $row['title'],
                            "desc" => $row['description'],
                            "address" => $row['address'],
                            "transpo" => $row['transpo_info'],
                            "date_posted" => date("F j, Y, g:i a", strtotime($row['date_inserted'])),
                            "status" => $row['status'],
                            "images" => $images ]; 

        }

        $districts = $this->db->query("SELECT * FROM district");

        echo json_encode(["posts" => $post_array, "district" => $districts]);

        }

    }

    public function sort_post()
    {   
        extract($_POST);

        if ($district == 0) {
        $myposts = $this->db->query("SELECT * FROM posts WHERE status='1'");

        $post_array = [];

        foreach ($myposts as $row) {
            
           $randomid = $row['file_id'];
           $postid = $row['id']; 
           $images = $this->db->query("SELECT * FROM files WHERE randomid='$randomid'"); 

           $avg = $this->db->query("SELECT AVG(rate) as avg from reviews where post_id='$postid' ");

           $post_array[] = ["id" => $this->hash->encode($row['id']),
                            "title" => $row['title'],
                            "desc" => $row['description'],
                            "address" => $row['address'],
                            "transpo" => $row['transpo_info'],
                            "date_posted" => date("F j, Y, g:i a", strtotime($row['date_inserted'])),
                            "status" => $row['status'],
                            "rating" => $avg[0]['avg'],
                            "images" => $images ]; 

        }

        $districts = $this->db->query("SELECT * FROM district");

        echo json_encode(["posts" => $post_array, "district" => $districts]);
        }else{

        $myposts = $this->db->query("SELECT * FROM posts WHERE district='$district' AND status='1'");

        $post_array = [];

        foreach ($myposts as $row) {
            
           $randomid = $row['file_id'];
           
           $images = $this->db->query("SELECT * FROM files WHERE randomid='$randomid'"); 

           $post_array[] = ["id" => $this->hash->encode($row['id']),
                            "title" => $row['title'],
                            "desc" => $row['description'],
                            "address" => $row['address'],
                            "transpo" => $row['transpo_info'],
                            "date_posted" => date("F j, Y, g:i a", strtotime($row['date_inserted'])),
                            "status" => $row['status'],
                            "images" => $images ]; 

        }

        $districts = $this->db->query("SELECT * FROM district");

        echo json_encode(["posts" => $post_array, "district" => $districts]);

        }

    }

    public function view_post_details()
    {

        extract($_POST);

        $pid = $this->hash->decode($id)[0];

        $myposts = $this->db->query("SELECT * FROM posts WHERE id='$pid'");

        $post_array = [];

        foreach ($myposts as $row) {
            
           $randomid = $row['file_id'];
           $postid = $row['id'];  
           $images = $this->db->query("SELECT * FROM files WHERE randomid='$randomid'"); 

           $avg = $this->db->query("SELECT AVG(rate) as avg from reviews where post_id='$postid' ");

           $post_array[] = ["id" => $this->hash->encode($row['id']),
                            "title" => $row['title'],
                            "desc" => $row['description'],
                            "district" => $row['district'],
                            "address" => $row['address'],
                            "transpo" => $row['transpo_info'],
                            "date_posted" => date("F j, Y, g:i a", strtotime($row['date_inserted'])),
                            "status" => $row['status'],
                            "rating" => $avg[0]['avg'],
                            "history" => $row['history'],
                            "images" => $images ]; 

        }

        $districts = $this->db->query("SELECT * FROM district");

        echo json_encode(["posts" => $post_array, "district" => $districts]);

    }

    public function load_post()
    {

        $userid =  $this->get_user_id();

        $myposts = $this->db->query("SELECT * FROM posts WHERE user_id='$userid'");

        $post_array = [];

        foreach ($myposts as $row) {
            
           $randomid = $row['file_id'];
           
           $images = $this->db->query("SELECT * FROM files WHERE randomid='$randomid'"); 
           $postid = $row['id']; 
           $avg = $this->db->query("SELECT AVG(rate) as avg from reviews where post_id='$postid' ");
           $post_array[] = ["id" => $this->hash->encode($row['id']),
                            "title" => $row['title'],
                            "desc" => $row['description'],
                            "address" => $row['address'],
                            "transpo" => $row['transpo_info'],
                            "rating" => $avg[0]['avg'],
                            "date_posted" => date("F j, Y, g:i a", strtotime($row['date_inserted'])),
                            "status" => $row['status'],
                            "images" => $images ]; 

        }

        $districts = $this->db->query("SELECT * FROM district");

        if ($this->checking_auth()) {
           echo json_encode(["posts" => $post_array, "district" => $districts, "online" => 1]);
        }else{
           echo json_encode(["posts" => $post_array, "district" => $districts,  "online" => 0]); 
        }

        

    }

    public function publish_post()
    {
        extract($_POST);

        $this->db->insert('posts', [
                          'title' => $title,
                          'description' => $desc,
                          'address' => $address,
                          'transpo_info' => $transpo,
                          'history' => $hist,
                          'user_id' => $this->get_user_id(),
                          'file_id' => $random,
                          'district' => $dist,
                          'latitude' => $lat,
                          'longitude' => $long,
                          'category' => $cat
                        ]);

        echo json_encode(["response" => 1]);

    }

    public function upload_gallery()
    {

    $files = $_FILES['image233'];
    $file_path = $files['tmp_name'];
    $file_name = $files['name'];
    $file_size = $files['size'];
    $file_type = $files['type'];
    $directory = "./../files";
    $path = $directory."/".$file_name;

    $newdir = "./files/".$file_name;

    if (!is_dir($directory)) {
    //Create our fam_monitor_directory(fam, dirname).
    mkdir($directory, 755, true);
    move_uploaded_file($file_path, $path);

    } else {

    move_uploaded_file($file_path, $path);

    }

    $this->db->insert('gallery', [ 
        "dir" => $newdir 
    ]);

    $id = $this->db->insertId();

    echo json_encode(["random" => $random]);


    }

    public function upload_images($random)
    {

    $files = $_FILES['image233'];
    $file_path = $files['tmp_name'];
    $file_name = $files['name'];
    $file_size = $files['size'];
    $file_type = $files['type'];
    $directory = "./../files";
    $path = $directory."/".$file_name;

    $newdir = "./files/".$file_name;

    if (!is_dir($directory)) {
    //Create our fam_monitor_directory(fam, dirname).
    mkdir($directory, 755, true);
    move_uploaded_file($file_path, $path);

    } else {

    move_uploaded_file($file_path, $path);

    }

    $this->db->insert('files', [ 
        "randomid" => $random,
        "dir" => $newdir 
    ]);

    $id = $this->db->insertId();

    echo json_encode(["random" => $random]);
   


    }   

    public function login_admin()
    {   

        extract($_POST);

        try {

            $this->auth->login($email, $password);

            $id = $this->get_user_id();

            $info = $this->db->query("SELECT * FROM users WHERE id='$id'");    

            // $_SESSION["system"] = $info;

            if ($info[0]['role'] == 1) {
                echo json_encode(["response"=>'Successfuly login', "status"=>1]);
            }else{
                echo json_encode(["response"=>'Not an admin account', "status"=>0]);    
            }

            

        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            echo json_encode(["response"=>'Wrong email address', "status"=>0]);
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            echo json_encode(["response"=>'Wrong password', "status"=>0]);
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            echo json_encode(["response"=>'Email not verified', "status"=>0]);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            echo json_encode(["response"=>'Too many requests', "status"=>0]);
        }

    }

    public function login_user()
    {   

        extract($_POST);

        try {

            $this->auth->login($email, $password);

            $id = $this->get_user_id();

            $info = $this->db->query("SELECT * FROM users WHERE id='$id'");    

            // $_SESSION["system"] = $info;
            if ($info[0]['role'] == 0) {
              echo json_encode(["response"=>'Successfuly login', "status"=>1]);
            }else{
              echo json_encode(["response"=>'Admin account', "status"=>0]);  
            }
            

        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            echo json_encode(["response"=>'Wrong email address', "status"=>0]);
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            echo json_encode(["response"=>'Wrong password', "status"=>0]);
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            echo json_encode(["response"=>'Email not verified', "status"=>0]);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            echo json_encode(["response"=>'Too many requests', "status"=>0]);
        }

    }

    public function register_user()
    {

        extract($_POST);
        try {

            $userId = $this->auth->register($email, $password, $fullname, function ($selector, $token) {

            });

            $this->verification($email, $this->hash->encode($userId));

            echo json_encode(["response"=>'Verification email has been sent!', "status"=>1]);
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            echo json_encode(["response"=>'Invalid email address', "status"=>0]);
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            echo json_encode(["response"=>'Invalid password', "status"=>0]);
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            echo json_encode(["response"=>'User already exists', "status"=>0]);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            echo json_encode(["response"=>'Too many requests', "status"=>0]);
        }

    }

    public function verify_user($userid)
    {

        $this->db->query("UPDATE users SET verified=%i WHERE id=%i", 1, $this->hash->decode($userid)[0]);

        header("location: http://localhost/batangas/index.php");

    }


    public function verification($email, $userid)
    {

        try {
            //Server settings
            // $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $this->mail->SMTPDebug = false; //Enable verbose debug output
            $this->mail->isSMTP(); //Send using SMTP
            $this->mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
            $this->mail->SMTPAuth = true; //Enable SMTP authentication
            $this->mail->Username = 'conniebenetez@gmail.com'; //SMTP username
            $this->mail->Password = 'wdwfpioudaqphwiw'; //SMTP password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $this->mail->Port = 587; //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above            
            //Recipients
            $this->mail->setFrom('conniebenetez@gmail.com', 'verification');
            $this->mail->addAddress($email); //Add a recipient

            //Content
            $this->mail->isHTML(true); //Set email format to HTML
            $this->mail->Subject = 'Verification Email';
            // $this->mail->Body = "<span style="width:50%; height:50%;"> <img src="img/logo2.png" style="width:50%; height:50%;"> </span> <h1>Click the link to verify account: <a href='http://localhost/batangas/api/user-verify/".$userid."' >Verify account</a></h1>";
            $this->mail->Body = "<h1>Click the link to verify account: <a href='http://localhost/batangas/api/user-verify/".$userid."' >Verify account</a></h1>";
            // $this->mail->Body = '<a href="api.sc.io/email-verification?token=' . $token . '&selector=' . $selector . '">active</a>';
            // $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mail->send();
            // echo 'Message has been sent';
         
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
      


    }

    public function logout()
    {
        $this->auth->logOut();   

        echo json_encode(["response" => "logout"]);
    }

    public function checking_auth()
    {

        $LoggedIn = false;

        if ($this->auth->isLoggedIn()) {
            $LoggedIn = true;
        }

        return $LoggedIn;
    }

    public function get_user_id()
    {
    $id = $this->auth->getUserId();
    return $id;
    }

}


?>