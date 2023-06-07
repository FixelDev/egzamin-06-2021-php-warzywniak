<?php
    if(empty($_POST['submit']) == false)
    {
        if(!empty($_POST['name']) && !empty($_POST['price']))
        {
            $conn = mysqli_connect('localhost', 'root', '', 'dane2');
            
            $name = $_POST['name'];
            $price = $_POST['price'];
            $query = "INSERT INTO produkty VALUES(null, 1, 4, '$name', 10, '', '$price', 'owoce.jpg')";
            mysqli_query($conn, $query);
            mysqli_close($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="styl2.css">
    <title>Warzywniak</title>
</head>
<body>
    <header>
        <section id="header-left">
            <h1>Internetowy sklep z eko-warzywami</h1>
        </section>

        <section id="header-right">
            <ol>
                <li>warzywa</li>
                <li>owoce</li>
                <li><a href="https://terapiasokami.pl/" target="_blank">soki</a></li>
            </ol>
        </section>
    </header>

    <main>
        <?php
            $conn = mysqli_connect('localhost', 'root', '', 'dane2');

            $query = "SELECT nazwa, ilosc, opis, cena, zdjecie FROM produkty WHERE Rodzaje_id IN (1, 2)";
            $result = mysqli_query($conn, $query);

            while($row = mysqli_fetch_assoc($result))
            {
                $code =<<< CODE
                    <div class="item">
                        <img src=$row[zdjecie] alt="warzywniak"/>
                        <h5>$row[nazwa]</h5>
                        <p>opis: $row[opis]</p>
                        <p>na stanie: $row[ilosc] </p>
                        <h2>$row[cena] zł</h2>
                    </div>
                CODE;

                echo $code;
            }

            mysqli_close($conn);
        ?>
    </main>

    <footer>
        <form action="sklep.php" method="POST">
            Nazwa: <input type="text" name="name">
            Cena: <input type="text" name="price">

            <input type="submit" value="Dodaj produkt" name="submit"> <br>
            Stronę wykonał: Franciszek Pawłowski
        </form>
    </footer>
</body>
</html>