# movie-mover
This is a script that I used to move a group of movie files from one directory to a different structure.

If you provide a source directory '-s' and destination '-d' directory it will look in the source directory for all files and move them to the destination directory using the standard file naming conventions used in Plex.  Previously, I had sorted my movies into letters of the alphabet and just had the movie files in those instead of having movie name directories.

So this script would look in a folder like...

`/Movies/A/Aliens (1979).mp4` -> `/Movies/Aliens (1979)/Aliens (1979).mp4`

As long as the movie is uniquely named it uses the file name to create a folder of that in the destination, then move the file into that subfolder.

There is a `--dryrun` parameter that you can pass in that will create the folders, but not move the files if you want to test it out before running it completely.
