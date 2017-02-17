 <?php  
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
        $parameters = [
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];          

        $statement = $this->pdo->prepare("select * from user where username='{$username}'");
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_OBJ);
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

              // var_dump($statement);
              // exit();
              header("location: login.php");
          } catch (\Exception $e) {
              return false;
          }
        }
     } 
     public function login($user, $email, $password) 
     { 
         // Ambil data dari database 
         $stmt = $this->pdo->prepare("SELECT * FROM user WHERE username='{$user}'");
         $stmt->execute(); 
         $data = $stmt->fetchAll(PDO::FETCH_CLASS);
         if (!empty($data)) {
        if (password_verify($password, $data[0]->password)) {
          // session_start();
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
     public function logout($user)
    {
      session_unset($user);
    }
   public function getName($parameters)
    {
      $statement = $this->pdo->prepare("select * from user where id='{$parameters}'");
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_CLASS);
        return $data[0]->username;
    }
  }
 ?> 