 <?php  
   /** 
    * Class Aksi untuk melakukan login dan registrasi user baru 
    */ 
   class Auth 
   { 
     protected $pdo; //Menyimpan Koneksi database 
     private $error; //Menyimpan Error Message 
     /*## Contructor untuk class Auth, membutuhkan satu parameter yaitu koneksi ke database ## */
     function __construct($pdo) 
     { 
       $this->pdo = $pdo; 
       // Mulai session  
       session_start(); 
     } 

     /* Start : Registrasi User baru  */ 
     public function register($nama, $email, $password) 
     { 
        $user = $parameters['email'];
        $statement = $this->pdo->prepare("select * from login where email='{$email}'");
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_CLASS);
        if (!empty($data)) {
          // var_dump($data);exit;
          echo "<script> alert('email telah terdaftar!');      
              window.location.href='register.php';
      </script>";
        }else{
        $sql = printf('insert into login (%s) values (%s)',implode(', ', array_keys($parameters)),
              ':' . implode(', :', array_keys($parameters)));
          try {
              $statement = $this->pdo->prepare($sql);
              $statement->execute($parameters);
              //return true;
              header("location: login.php");
          } catch (\Exception $e) {
              return false;
          }
        }
     } /* 

     ### Start : fungsi login user ###  */
     public function login($email, $password) 
     { 
         // Ambil data dari database 
         $stmt = $this->pdo->prepare("SELECT * FROM login WHERE email = :email"); 
         $stmt->bindParam(":email", $email); 
         $stmt->execute(); 
         $data = $stmt->fetch(); 
         // Jika jumlah baris > 0 
         if (!empty($data[0]->email)) {
        if (password_verify($_POST['password'], $data[0]->password)) {
          session_start();
          $_SESSION['login'] = $data[0]->id;
        echo "<script> alert('Login sukses!');      
                window.location.href='index.php';
              </script>";
        }else{
          echo "<script> alert('email atau password salah!');      
                window.location.href='login.php';
                </script>";
        }
      }else{
        header("location: login.php");
      }
     } /*
     ### End : fungsi login user ### 

     ### Start : fungsi cek login user ###  */
     public function isLoggedIn(){ 
       // Apakah user_session sudah ada di session 
       if(isset($_SESSION['user_session'])) 
       { 
         return true; 
       } 
     } /*
     ### End : fungsi cek login user ###  

     ### Start : fungsi ambil data user yang sudah login ###   */
     public function getUser($email)
    {
        $statement = $this->pdo->prepare("select * from login where email='{$email}'");
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_CLASS);
        return $data[0]->email;
    } /*
     ### End : fungsi ambil data user yang sudah login ###  

     ### Start : fungsi Logout user ###  */
     public function logout($email)
    {
      session_unset($email);
    }
     /*
     ### End : fungsi Logout user ###  
     ### Start : fungsi ambil error terakhir yg disimpan di variable error ###  */
     public function getLastError(){ 
       return $this->error; 
     } 
   } 
 ?> 