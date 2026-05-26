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
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kino</title>
        <style>
        body {
            background: #00160e;
            color: #000000;
            font-family: sans-serif;
            text-align: center;
            padding-top: 50px;
        }
        .sala {
            display: grid;
            grid-template-columns: repeat(5, 39px);
            gap: 10px;
            justify-content: center;
            margin-bottom: 40px;
        }
        .miejsce {
            width: 40px;
            height: 40px;
            border-radius: 4px;
            display: block;
        }
        .wolne { background: #2ecc71; cursor: pointer; }
        .wolne:hover { background: #27ae60; border-radius: 14px;}
        .zajete { background: #e74c3c; pointer-events: none; }
    </style>
</head>
<body>
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