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

<body>
    <div class="sala">
        <?php while($m = $miejsca->fetch_assoc()): ?>
            <?php if ($m['is_reserved'] == 1): ?>
                <div class="miejsce zajete"></div>
            <?php else: ?>
                <a href="?id=<?= $m['id'] ?>" class="miejsce wolne"></a>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
    <form method="POST">
        <button type="submit" name="reset">reset</button>
    </form>
</body>
</html>
<?php $db->close(); ?>