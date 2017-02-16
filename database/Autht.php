 <?php  
   /** 
    * Class Aksi untuk melakukan login dan registrasi user baru 
    */ 
   class Autht 
   { 
     protected $pdo; //Menyimpan Koneksi database 
     private $error; //Menyimpan Error Message 
     function __construct($pdo) 
     { 
       $this->pdo = $pdo; 
       // Mulai session  
       session_start(); 
     } 
     public function register($username, $email, $password) 
     { 
        $user = $parameters['username'];
        $statement = $this->pdo->prepare("select * from user where user='{$username}'");
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_CLASS);
        if (!empty($data)) {
          echo "<script> alert('email telah terdaftar!');      
              window.location.href='register.php';
      </script>";
        }else{
        $sql = sprintf('insert into user (%s) values (%s)',implode(', ', array_keys($parameters)),
              ':' . implode(', :', array_keys($parameters)));
          try {
              $statement = $this->pdo->prepare($sql);
              $statement->execute($parameters);
              header("location: login.php");
          } catch (\Exception $e) {
              return false;
          }
        }
     } 
     public function login($email, $password) 
     { 
         // Ambil data dari database 
         $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email='{$email}'");
         $stmt->execute(); 
         $data = $stmt->fetchAll(PDO::FETCH_CLASS); 
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
     } 
     public function logout($email)
    {
      session_unset($email);
    }
   public function getName($parameters)
    {
      $statement = $this->pdo->prepare("select * from user where id='{$parameters}'");
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_CLASS);
        return $data[0]->email;
    }
  }
 ?> 