<!DOCTYPE html>
<?php require('config.php'); ?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $title ?></title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/main.css">
    </head>

    <body>
        <div class="canvas">
            <h1><?php echo $title ?></h1>
            <nav class="tools">
                <ul>
                    <?php
                        foreach ($devtools as $tool) {
                            printf('<li><a target="_blank" href="%1$s">%2$s</a></li>', $tool['url'], $tool['name']);
                        }
                    ?>
                </ul>
            </nav>
            <content class="sites">
            <?php
            foreach ($dir as $d) {
                $dirsplit = explode('/', $d);
                $dirname = $dirsplit[count($dirsplit)-2];

                echo '<ul>';

                foreach (glob($d, GLOB_ONLYDIR) as $file) {
                    $project = basename($file);

                    // skip any projects in the $hiddensites
                    if (in_array($project, $hiddensites)) {
                        continue;
                    }

                    echo '<li>';

                    $siteroot = sprintf('http://%1$s.%2$s', $project, $tld);

                    // Display a link to the site with name and icon overrides from $siteoptions
                    $displayname = $project;
                    $displayicon = '<span class="icon left website leftcap"></span>';
                    if (array_key_exists($project, $siteoptions)) {
                        if (is_array($siteoptions[$project])) {
                            if (array_key_exists('displayname', $siteoptions[$project])) {
                                $displayname = $siteoptions[$project]['displayname'];
                            }
                            if (array_key_exists('icon', $siteoptions[$project]) && file_exists($file . '/' . $siteoptions[$project]['icon'])) {
                                $displayicon = sprintf('<img class="icon left leftcap" src="%1$s/%2$s">', $siteroot, $siteoptions[$project]['icon']);
                            }
                        } else {
                            $displayname = $siteoptions[$project];
                        }
                    }
                    printf('<a class="site" target="_blank" href="%1$s"> %2$s %3$s</a>', $siteroot, $displayicon, $displayname);

                    // Display an icon with a link to the notes file
                    $notesurl = '';
                    if (file_exists($file . '/' . $projnotefile)) {
                        $notesurl = sprintf('md.php?t=' . $file . '/' . 'odd_notes.md&c=' . $displayname, $siteroot);
                    }
                    if (! empty($notesurl)) {
                        printf('<a class="icon right %2$s" target="_blank" href="%1$s"></a>', $notesurl, 'notes');
                    }

                    // Display an icon with a link to the todo file
                    $todourl = '';
                    if (file_exists($file . '/' . $projtodofile)) {
                        $todourl = sprintf('md.php?t=' . $file . '/' . 'odd_todo.md&c=' . $displayname, $siteroot);
                    }
                    if (! empty($todourl)) {
                        printf('<a class="icon right %2$s" target="_blank" href="%1$s"></a>', $todourl, 'todo');
                    }

                    // Display an icon with a link to the admin area
                    $adminurl = '';
                    // We'll start by checking if the site looks like it's a WordPress site
                    if (is_dir($file . '/wp-admin')) {
                        $adminurl = sprintf('%1$s/wp-admin', $siteroot);
                    }

                    // If the user has defined an adminurl for the project we'll use that instead
                    if (isset($siteoptions[$project]) &&  is_array($siteoptions[$project]) && array_key_exists('adminurl', $siteoptions[$project])) {
                        $adminurl = $siteoptions[$project]['adminurl'];
                    }

                    // If there's an admin url then we'll show it - the icon will depend on whether it looks like WP or not
                    if (! empty($adminurl)) {
                        printf('<a class="icon right %2$s%3$s" target="_blank" href="%1$s"></a>', $adminurl, is_dir($file . '/wp-admin') ? 'wp' : 'admin', (isset($editorpath) && $editorpath != '') ? ' rightcap' : '');
                    }

                    // Display a link to open the directory as a project
                    if (isset($editorpath) && $editorpath != '') {
                        printf('<a class="icon right disk rightcap" target="_blank" href="openeditor.php?t=%1$s"></a>', $file);
                    }

                    echo '</li>';
                } // foreach( glob( $d ) as $file )

                echo '</ul>';
            } // foreach ( $dir as $d )
            ?>
            </content>
        </div>
        <?php
            if ($reference && count($reference) > 0) {
                echo '<div class="canvas"><h3>Reference Materials</h3>';
                foreach ($reference as $r) {
                    printf('<a class="links" target="_blank" href="%1$s">%2$s</a>', $r['url'], $r['name']);
                }
                echo '</div>';
            }
        ?>
    </body>
</html>
