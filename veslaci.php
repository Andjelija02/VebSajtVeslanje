<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="stilizovanje.css">
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
</head>
<body>
    <div class="container"> <!--kontejner, sadrzi sve-->
        <div class=meni>
            <div class="row">
                <div class="col-sm-6" >
                    <p style="font-size: 50px; text-align: left;">Веслање</p>
                </div>
                <div class="col-sm-6"style="margin-top: 15px; margin-bottom: 15px;">
                    <a href="index.html">Почетна</a>
                    <a href="OVeslanju.html">О веслању</a>
                    <a href="veslaci.php">Веслачи</a>
                    <a href="klubovi.html">Клубови</a>
                    <a href="Kontakt.html">Контакт</a>
                </div>
            </div>
        </div>
        <div class="jumbotron text-center">
            <h1>Веслачи</h1>
            <img src=reprezentacija.jpeg alt="Сениори репрезентативци Србије"/>
        </div>
        <div class=sadrzaj>
            <div class="row">
                <div class="col-sm-6" >
                    <h2 for="kategorije">Изаберите старосну категорију:</h2>
                    <!--<br>-->
                    <form action = "veslaci.php" method = "get">
                        <select name="kategorije" class="btn btn-info" id="kategorije">
                            <option value="pioniri">Пионири</option>
                            <option value="kadeti">Кадети</option>
                            <option value="juniori">Јуниори</option>
                            <option value="seniori">Сениори</option>
                        </select>
                        <input class="btn btn-info" type = "submit" value = "Прикажи" />
                    </form>
                    <br>
                    <?php
                        $mysqli = new mysqli('localhost', 'root', '');
                        if ($mysqli->connect_error) {
                            die("Greska: " . $mysqli->connect_error);
                        }
                                
                        $mysqli->select_db('veslanje');
                        $query="SELECT ime_i_prezime, naziv, grad, adresa FROM veslaci JOIN klubovi USING(id_kluba)";
                        if(isset($_GET["kategorije"])){
                            if($_GET["kategorije"] == "pioniri")
                                $query = "SELECT ime_i_prezime, naziv, grad, adresa FROM veslaci JOIN klubovi USING(id_kluba) WHERE YEAR(datum_rodjenja) > YEAR(CURDATE())-15";
                            if($_GET["kategorije"] == "kadeti")
                                $query = "SELECT ime_i_prezime, naziv, grad, adresa FROM veslaci JOIN klubovi USING(id_kluba) WHERE YEAR(datum_rodjenja) > YEAR(CURDATE())-17 AND YEAR(datum_rodjenja) <= YEAR(CURDATE())-15";
                            if($_GET["kategorije"] == "juniori")
                                $query = "SELECT ime_i_prezime, naziv, grad, adresa FROM veslaci JOIN klubovi USING(id_kluba) WHERE YEAR(datum_rodjenja) > YEAR(CURDATE())-19 AND YEAR(datum_rodjenja) <= YEAR(CURDATE())-17";
                            if($_GET["kategorije"] == "seniori")
                                $query = "SELECT ime_i_prezime, naziv, grad, adresa FROM veslaci JOIN klubovi USING(id_kluba) WHERE YEAR(datum_rodjenja) <= YEAR(CURDATE())-19";
                        }
                
                        $query = $mysqli->real_escape_string($query);
                        $result = $mysqli->query($query);
                        if (!$result)
                            die("Greska u izvrsavanju upita: " . $mysqli->error);
                        if ($result->num_rows == 0)
                            echo "<h2>Нема веслача у овој категорији</h2>";
                        else {
                            echo "<table border='1' style='margin-left: auto; margin-right: auto;'>\n";
                            while (($row = $result->fetch_assoc())) {
                                echo "<tr>";
                                echo "<td>" . $row["ime_i_prezime"] . "</td>" . 
                                "<td>" . $row["naziv"] . "</td>" .
                                "<td>" . $row["grad"] . "</td>" .
                                "<td>" . $row["adresa"] . "</td>";
                                echo "</tr>\n";
                            }
                            echo "</table>";
                        }
                    ?>
                </div>
                <div class="col-sm-6">
                    <h2>Репрезентативци Србије ове године</h2>
                    <br>
                    <?php
                        $query2="SELECT ime_i_prezime, datum_rodjenja, naziv, grad FROM veslaci JOIN reprezentativci USING(id_veslaca) JOIN klubovi USING(id_kluba) WHERE godina = YEAR(CURDATE())";
                        $query2 = $mysqli->real_escape_string($query2);
                        $result2 = $mysqli->query($query2);
                        if (!$result2)
                            die("Greska u izvrsavanju upita: " . $mysqli->error);
                        if ($result2->num_rows == 0)
                            echo "<h2>Нема веслача у овој категорији</h2>";
                        else {
                            echo "<table border='1' style='margin-left: auto; margin-right: auto;'>\n";
                            while (($row = $result2->fetch_assoc())) {
                                echo "<tr>";
                                echo "<td>" . $row["ime_i_prezime"] . "</td>" . 
                                "<td>" . $row["datum_rodjenja"] . "</td>" .
                                "<td>" . $row["naziv"] . "</td>" .
                                "<td>" . $row["grad"] . "</td>";
                                echo "</tr>\n";
                            }
                            echo "</table>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>