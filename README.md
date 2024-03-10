# Caweb Theme Development Guidelines

**Summary**
1. Introduction
2. Workflow
    1. The right development environnement
        1. Local server
        2. IDE
        3. Git
    2. Get the theme files
3. Theme features
    1. Internationalization

## Introduction
In 2023, from a development point of view, the CAWEB master website suffer from several flaws : 
* The website is very slow to load. 
* The WordPress theme isn't easily maintainable, as it uses technologies that aren't studied in the Master. The files are messy and no one knows what are their purposes as some of them aren't documented.
* The theme uses ACF Pro blocks for basic WP features such as navigation menus or pages layout, making the website difficult to administrate for a webmaster.
* The Webdesign is a bit outdated.

It was decided to make a rework of the website.

So I wanted to keep the thinks simple and the website easy to administrate for a Webmaster :
* The less possible harcoded strings and layouts.
* Less technologies that aren't studied in the Master.
* Using as much as possible the WordPress development function, instead of plugins such as ACF PRO

## Workflow

### The right development environnement

#### Local server
As the students don't have acces to the live server FTP, they must work on a local server.

The purpose of a local server is to "emulate" a server on your computer, so that you can execute PHP code, have access to a database, or install WordPress on your computer. There is several packages that are easy to install and give you acces to a local server :
* [WAMP](https://www.wampserver.com/) for Windows.
* [MAMP](https://www.mamp.info/en/downloads/) for Mac.
* [XAMPP](https://www.apachefriends.org/fr/index.html) for Linux.

#### IDE
I advice you to use [Visual Studio Code](https://code.visualstudio.com/) to work on the code. As WordPress Themes are mainly coded in PHP, I strongly advice you to install the VSCode plugin **PHP Intelephense**. It helps to find syntax errors in your code. It gives you access to documentation of functions on hover. By *ctr + right click* on a function, you have easy acces to its declaration.

When you work on WordPress code with you IDE, be sure to **open all the WP files in Visual Studio Code**. To do that, you can go to *File -> Open Folder* in VS Code.

#### Git
Git is a versioning software useful to :
* keep tracks of changes on code
* share code 
* work in group on a dev project.
You need to install Git on your computer, and greate a GitHub account before starting working on the CAWEB Theme. I strongly advice to learn how git works : this [OpenClassRooms course about Git](https://openclassrooms.com/en/courses/7162856-gerez-du-code-avec-git-et-github) is a great help !

Don't hesitate to take advice from Mr.Baguet.

### Get the theme files
As you have now the right environement to start working, you can get the files from [my Github Repository](https://github.com/BaptisteD51/nouveau-theme-caweb). Follow the following steps to get it right :
1. Install WordPress on your local server.
2. Open Git Bash and navigate to the *themes* folder using *cd* commands.
3. Type this command in git Bash : *git clone https://github.com/BaptisteD51/nouveau-theme-caweb.git*

Now you can start working on the code !