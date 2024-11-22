<?php
session_start();

$conn = new PDO ("mysql:dbname=dbmat;host=localhost", "root", "@160l0nc3t");

    if (isset($_POST['administrador'])) {

        $uid = $_POST["uid"];
        $adm = "administrador";

        $sql = "UPDATE usuario SET adm=:ADM  WHERE uid = :ID";

        $stmt = $conn->prepare ($sql);

        $stmt -> bindParam(":ADM", $adm);

        $stmt -> bindParam(":ID", $uid);

        $stmt->execute();

        header ("location: /banco/app/adm/adm.php");

    }
    if (isset($_POST['gerente'])) {

        $uid = $_POST["uid"];
        $adm = "gerente";

        $sql = "UPDATE usuario SET adm=:ADM  WHERE uid = :ID";

        $stmt = $conn->prepare ($sql);

        $stmt -> bindParam(":ADM", $adm);

        $stmt -> bindParam(":ID", $uid);

        $stmt->execute();

        header ("location: /banco/app/adm/adm.php");

    }
    if (isset($_POST['on'])) {

        $uid = $_POST["uid"];
        $adm = "";

        $sql = "UPDATE usuario SET adm=:ADM  WHERE uid = :ID";

        $stmt = $conn->prepare ($sql);

        $stmt -> bindParam(":ADM", $adm);

        $stmt -> bindParam(":ID", $uid);

        $stmt->execute();

        header ("location: /banco/app/adm/adm.php");

    }

?>