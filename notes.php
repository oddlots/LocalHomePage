<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/md.css">
    </head>
    <body>
        <header>
            <div class="topbar">
                <a class="icon left home" href="/"></a>
            </div>
        </header>
        <content>
            <div class="canvas">
            <?php
                require('config.php');
                $daily = [];
                $other = [];

                foreach (glob($notesdir . "*.md") as $path) {
                    $full_file = basename($path);
                    $file = basename($path, '.md');
                    if (in_array($file.'.md', $hiddennotes)) {
                        continue;
                    }
                    $time = strtotime($file);
                    $p = '../md.php?t=' . $path;
                    if (date('Y-m-d', $time) == $file) {
                        $daily[$time]="<a href=$p>".date('F jS, Y', $time)."</a> <a class='raw' href=$p&r=1>(raw)</a>";
                    } else {
                        $other[$file]="<a href=$p>".$file."</a> <a class='raw' href=$p&r=1>(raw)</a>";
                    }
                }
                echo "<H1>Daily Journals</H1><ul>";
                foreach (array_reverse($daily) as $l) {
                    echo "<li>" . $l . "</li>";
                }
                echo "</ul><br />";
                if (sizeof($other)) {
                    echo "<hr /><H2>Other Notes</H2><ul>";
                    foreach ($other as $l) {
                        echo "<li>" . $l . "</li>";
                    }
                    echo "</ul><br />";
                }
            ?>
            </div>
        </content>
    </body>
</html>
