<!DOCTYPE html>
<?php
require('lib/parsedown/Parsedown.php');

$t = $_GET['t'];
$raw = isset($_GET['r']);
$title = (isset($_GET['c'])) ? $_GET['c'] : '';

function markdownInclude($f, $r)
{
    if (is_readable($f)) {
        $s = file_get_contents($f);
        if ($r) {
            echo nl2br(htmlspecialchars($s));
        } else {
            $Parsedown = new Parsedown();
            echo $Parsedown->text($s);
        }
    } else {
        echo "File Not Found ".htmlspecialchars($f);
    }
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
            <?php echo $title; ?>
        </title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/md.css">
    </head>
    <body>
        <header>
            <div class="topbar">
                <a class="icon back" href="/notes.php"></a>
                <a class="icon home" href="/"></a>
                <?php echo '<span>' . $title . '</span>' . basename($t); ?>
            </div>
        </header>
        <content>
            <div class="canvas">
                <?php echo markdownInclude($t, $raw) ?>
            </div>
        </content>
    </body>

</html>
