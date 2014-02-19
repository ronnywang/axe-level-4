<?php
$records = json_decode(file_get_contents(__DIR__ . '/answer.json'));
$page = max(1, intval($_GET['page']));
if ($page != 1) {
    if (
        !stripos($_SERVER["HTTP_USER_AGENT"], 'chrome')
        and !stripos($_SERVER['HTTP_USER_AGENT'], 'firefox')
        and !stripos($_SERVER['HTTP_USER_AGENT'], 'msie')
        and !stripos($_SERVER['HTTP_USER_AGENT'], 'opera')
        and !stripos($_SERVER['HTTP_USER_AGENT'], 'safari')
    ) {
        header('Location: /lv4');
        exit;
    }

    if (!strpos($_SERVER["HTTP_REFERER"], $_SERVER['HTTP_HOST'])) {
        header('Location: /lv4');
        exit;
    }
}
$per_page = 10;
$total_page = ceil(count($records) / $per_page);
$records = array_slice($records, ($page - 1) * $per_page, $per_page);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>宜蘭縣村里長名單</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<h1>宜蘭縣村里長名單</h1>
第 <?= $page ?> 頁
<table class="table">
    <tr>
        <td>鄉鎮</td>
        <td>村里</td>
        <td>姓名</td>
    </tr>
    <?php foreach($records as $record) {?>
    <tr>
        <td><?= htmlspecialchars($record->town) ?></td>
        <td><?= htmlspecialchars($record->village) ?></td>
        <td><?= htmlspecialchars($record->name) ?></td>
    </tr>
    <?php } ?>
</table>
<?php for ($i = 1; $i <= $total_page; $i ++) { ?>
[<a href="?page=<?= $i ?>"><?= $i ?></a>]
<?php } ?>
</body>
</html>
