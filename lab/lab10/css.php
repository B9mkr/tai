<form action="css.php" method="post">
 <textarea name="tekst"></textarea><br />
 <input type="submit" name="wyslij" value="Wyślij" />
</form>
<div>
<?php
    if (filter_input(INPUT_POST,'wyslij'))
    echo htmlspecialchars($_POST['tekst']);
?>
</div>
