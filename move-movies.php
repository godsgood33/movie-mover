<?php

$cmd = getopt('s:d:', ['dryrun::']);

if(!isset($cmd['s']) || !isset($cmd['d'])) {
    die("Need a source and destination directories".PHP_EOL);
}

// glob all the files
$files = glob($cmd['s'].'/*');
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$dryrun = isset($cmd['dryrun']);

foreach ($files as $f) {
    if (preg_match("/Plex Versions/", $f)) {
        continue;
    }

    $fi = finfo_file($finfo, $f);
    $bn = basename($f);

    // start with normal extension size (e.g. '.mp4' or '.mkv')
    $ext_len = 4;
    // if file is a resolving to a text file probably a subtitle file
    // assume file is '.{lang}.{ext}' (e.g. .eng.srt)
    if ($fi == 'text/plain') : $ext_len = 8;
    endif;
    // this was something that I used 
    if (preg_match("/\.4k\./", $f)) : $ext_len += 3;
    endif;

    // get the title of the movie from the basename (minus the extension)
    $title = substr($bn, 0, -($ext_len));

    // create a folder from the title
    if (!file_exists("{$cmd['d']}/{$title}")) {
        print "making $title directory".PHP_EOL;
        mkdir("{$cmd['d']}/{$title}");
    }

    // if not a dryrun, move the file into the new folder
    if (!$dryrun) {
        rename($f, "{$cmd['d']}/{$title}/{$bn}");
    }
}
finfo_close($finfo);
