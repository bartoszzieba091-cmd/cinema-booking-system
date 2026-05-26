<?php
    $db = new mysqli('localhost', 'root', '', 'cinema');
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $db->query("UPDATE seats SET is_reserved = 1 WHERE id = $id");
        echo "<script>window.location.href = window.location.pathname;</script>";
        exit;
    }
    if (isset($_POST['reset'])) {
        $db->query("UPDATE seats SET is_reserved = 0");
        echo "<script>window.location.href = window.location.pathname;</script>";
        exit;
    }
    $miejsca = $db->query("SELECT * FROM seats ORDER BY row_num, seat_num");
?>