<?php

/**
*
*  This is just a simple config file to store your web root and a few other items
*
*  Change "/www/sites/*" to the directory where you keep your sites.
*  Add multiple directories like this:
*
*  $dir = array("/www/sites1/*","/www/sites2/*");
*
*/

/** LocalHomePage root **/
$projroot = './';

/** LocalHomePage Title **/
$title = 'My Local Sites';

$homedir = "/Users/username/";

/** directory name(s) */
$dir = array($homedir."Sites/*");

/** notes config */
$notesdir = $homedir."Documents/Notes/";
$hiddennotes = array( '20xx-xx-xx.md' );
$projnotefile = 'odd_notes.md';
$projtodofile = 'odd_todo.md';

/** Your local top level domain */
$tld = 'dev';

/**
* Opens the Project directory in whatever editor you provide.
* exec($editorpath . ' ' . $projectpath)
*/
$editorpath = '/usr/local/bin/atom';

/*
*
*  Development tools you want displayed in the top navigation bar. Each item should be
*  an array containing keys 'name' and 'url'. An example is included (commented out) below.
*
*/
$devtools = array(
//  array( 'name' => 'Tool', 'url' => 'http://example.com/' ),
    array( 'name' => 'Notes', 'url' => 'notes.php' ),
    array( 'name' => 'Web Host Admin', 'url' => 'http://example.com/' ),
    array( 'name' => 'Github', 'url' => 'http://github.com/' ),
    );

/*
*
*  Bookmarks you want displayed under the rest of the stuff. Each item should be
*  an array containing keys 'name' and 'url'. An example is included (commented out) below.
*
*/
$reference = array(
    array( 'name' => 'Can I Use', 'url' => 'https://caniuse.com' ),
    array( 'name' => 'Should I Prefix', 'url' => 'http://shouldiprefix.com' ),
    );

/*
*
*  Options for sites being displayed. These are completely optional, if you don't set
*  anything there are default options which will take over.
*
*  If you only want to specify a display name for a site you can use the format:
*
*  'dirname' => 'Display Name',
*
*  Otherwise, if you want to set additional options you'll use an array for the options.
*
*  'sitedir' => array(
*       'dirname' => 'Display Name',
*       'icon' => 'icon_image/file/name.png',
*       'adminurl' => 'http://example.sites.dev/admin'
*       )
*
*/
$siteoptions = array(
//  'dirname' => 'Display Name',
//  'dirname' => array( 'displayname' => 'DisplayName', 'icon' => 'apple-touch-icon.png', 'adminurl' => 'http://something/admin' )
    );

/*
*
*  Directory names of sites you want to hide from the page. If you're using multiple directories
*  in $dir be aware that any directory names in the array below that show up in any of
*  your directories will be hidden.
*
*/
$hiddensites = array( 'local' );
