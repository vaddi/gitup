# gitUp #

A small PHP Applikation which compares the remote origin and the local repository (inside a few folder) and highlight if there are pull request necsessary. 


### About ###

*  just a private project
*  Version 0.1

The main function is based on a Teminal oneliner, found on [Stackoverflow][].


### Dependencies ###

*  [git][]
*  [PHP][]
*  [sed][]
*  [cut][]


## Installation ##

Get last version from github.com by following command:

    git clone git://github.com/vaddi/gitUp.git

Clone it in the Folder where you have some git Projects or change the $verzeichnis_raw var at the Top of the Document to fit your needs. 


### How do I set it up? ###

*  Open in Browser


### Issues ###

Not very performant for a lot of Files, because we need to wait for each Server response.


### Credits ###

1. [PHP][] php 
2. [git][] git
3. [sed][] sed
4. [cut][] cut

[PHP]: http://php.net/
[git]: https://git-scm.com/
[sed]: http://manpages.debian.org/cgi-bin/man.cgi?apropos=0&format=html&query=sed&sektion=1&locale=de
[cut]: http://manpages.debian.org/cgi-bin/man.cgi?apropos=0&format=html&query=cut&sektion=1&locale=de
[Stackoverflow]: http://stackoverflow.com/a/25109122/5208166



