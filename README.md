## A Local Home Page for MacOS Web Development

Simple page that automatically lists, and provide links to, my local sites and their companion notes.

### Install

Follow cmalls setup [tutorial](https://mallinson.ca/posts/5/the-perfect-web-development-environment-for-your-new-mac) if you need to get a local server going on your mac.

After you have a webserver setup:

1. Drop this project in the web root
2. Open terminal and cd into the LocalHomePage directory (whatever you named it)
3. Run the install.sh file by typing `./install.sh`
4. Make whatever config changes are required in the **config.php** file.
5. Open it up in your browser and rock & roll.

Alternatively you can do the install.sh stuff manually by:

3a. Copy **config.sample.php** to **config.php** `cp config.sample.php config.php`
3b. Make the parsedown directory `mkdir -p lib/parsedown`
3c. Go get the [latest Parsedown](https://github.com/erusev/parsedown/releases/latest)
3d. Untar it into lib/parsedown `tar --strip-components=1 -xzf parsedown-1.7.1.tar.gz -C lib/parsedown/`

### Markdown Notes

I added a markdown parser to handle the additions noted (groan) below.

```php
/** notes config */
$notesdir = $homedir."Documents/Notes/";
$hiddennotes = array( '20xx-xx-xx.md' );
$projnotefile = 'odd_notes.md';
$projtodofile = 'odd_todo.md';
```

- **$notesdir** is the directory where it will search for your markdown files.
- **$hiddennotes** is a list of files to ignore. As an example, 20xx-xx-xx.md is my primer template for my daily notes so I ignore that file in the list.
- **$projnotefile** is the name of the notes file that will be searched for in the project root directory.
- **$projtodofile** is the name of the to do file that will be searched for in the project root directory.

#### Personal Notes

The Dev Tools now has a **notes.php** file that displays a list of all the notes that are in the notes directory as defined in your **config.php** (shown above).

The list itself is currently setup to try and parse filenames as dates and separate dated notes from any others. It then sorts the daily ones in reverse order to make an effective list of daily journals. All the other markdown files from the **$notesdir** are displayed in a list after.

#### Per Project Notes

I added project notes and todo markdown files to help me keep track of the projects. As shown above, the **$projnotefile** and **$projtodofile** define the filenames that the listing will look in the project root directory for.  If it finds either, a link to it is placed to the right on the project listing.

### Open Project in Editor

On the far right of the project listing, I included a really dirty button to open a new [atom](https://atom.io) window to the project folder. This does a [php exec call](http://php.net/manual/en/function.exec.php), combining the **$editorpath** and the project path.

```php
/**
* Opens the Project directory in whatever editor you provide.
* exec($editorpath . ' ' . $projectpath)
*/
$editorpath = '/usr/local/bin/atom';
```

The editor path is included as a template, or in case you have another editor that you prefer that might be able to be setup to open from the terminal ([ie Sublime Text](https://ashleynolan.co.uk/blog/launching-sublime-from-the-terminal))

Removing **$editorpath** or setting it to '' will remove the link on the list.

### Reference Materials

I am always going back to certian sites to find syntax or the like. Below the projects list, I have added a new list of links so I can refer back to them. It's a little redundant but I can't stand browser bookmarks. An empty array will remove this section too.

```php
$reference = array(
    array( 'name' => 'Can I Use', 'url' => 'https://caniuse.com' ),
    array( 'name' => 'Should I Prefix', 'url' => 'http://shouldiprefix.com' ),
    );
```


### Credit where it's due

- Based upon [LocalHomePage](https://github.com/cmall/LocalHomePage) and his setup tutorial can be found [here](http://mallinson.ca/post/osx-web-development).
- Icons made by [Pixel perfect](https://www.flaticon.com/authors/pixel-perfect).
- Parsedown is made by [erusev](https://github.com/erusev/parsedown/)
