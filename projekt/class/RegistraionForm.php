<?php
    class RegistrationForm {
        protected $user;
        function __construct()
        {
        ?>
            <h3>Formularz rejestracji</h3>
            <p>
                <form action="index.php" method="post">
                    Nazwa użytkownika: <br/><input name="userName" /><br/>
                    <!-- Imię i nazwisko: <br/><input name="fullName" /><br/> -->
                    Email: <br/><input name="email" /><br/>
                    Hasło: <br/><input name="passwd" type="password" /><br/>
                    <input type="submit" name="wyslij" value="Wyślij" />
                </form>
            </p>
        <?php
        }
        function checkUser(){ // podobnie jak metoda validate z lab4
            $args = [
                'userName' => [
                    'filter' => FILTER_VALIDATE_REGEXP,
                    'options' => ['regexp' => '/^[0-9A_Za-ząęłńśćźżó_-]{2,25}$/']
                ],
                'email' => [
                    'filter' => FILTER_VALIDATE_REGEXP,
                    'options' => ['regexp' => '"/^[a-zA-Z0-9_]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/']
                ],
                'passwd' => FILTER_DEFAULT
            ];

            $dane = filter_input_array(INPUT_POST, $args);
            //sprawdz czy są błędy walidacji $errors – jak w lab4
            if ($errors === "") {
                //Dane poprawne – utwórz obiekt user
                $this->user=new User($dane['userName'], $dane['fullName'], $dane['email'],$dane['passwd']);
            } else {
                echo "<p>Błędne dane:$errors</p>";
                $this->user = NULL;
            }
            return $this->user;
        }
    }
?>
