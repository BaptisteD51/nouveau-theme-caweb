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
        1. Introduction
        2. Textdomain
        3. Internationalization functions
        4. Generate translation files
        5. Update translation files

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

## Theme features

### Internationalization

#### Introduction
As the CAWEB website has a french and an english version on the same installation, we need a multilingual WordPress plugin : **WPML**. It's a premium plugin : if you need to refresh the licence, don't hesitate to contact Mr.Nightingale. 

But in order to be translatable, the theme must be internationalized. To put the things simple, it consist in : 
1. Create a **textdomain** for the Theme.
2. Encapsulate the hardcoded strings in the theme files with WordPress internationalization functions such as **__()**.
3. Generate a **.pot** file which contains all the translatable strings, and generate **.po** and **.mo** files for each language you want to add (in our case english).

More information on [how to internationalize a theme](https://developer.wordpress.org/themes/functionality/internationalization/#how-to-internationalize-your-theme) is available in the WP documentation.

#### Textdomain
To internationalize the theme, the first step is to create a textdomain. As it is already done, you won't need to do it another time, but who knows ?

Follow the following steps if you need to register a textdomain for a WordPress theme :
1. Register the textdomain in *functions.php* with the function 
        load_theme_textdomain( 'the_textdomain_name', 'absolute_path_where_you_want_to_save_translation_files' );
This function must be hooked with *after_setup_theme* like this :
        my_function(){
            load_theme_textdomain([...])
        }
        add_action('after_setup_theme', 'my_function');
2. Specify the text domain and the path in the comments at the top of *style.css*
    /*
    [...]
    Text Domain: the_textdomain_name
    Domain Path: /relative_path_where_you_want_to_save_translation_files
    */
3. Don't forget to create the repository you indicated in your path. A repository called *languages* is well suited for that.

#### Internationalization functions
Now you need to encapsulate each hardcoded string of the theme in internationalization functions like this :
    <?php __('the_string', 'the_textdomain_name') ?>

#### Generate translation files
To generate translation files, you have to use a third party application such as [Poedit](https://poedit.net/) or the free WordPress plugin [Loco Translate](https://fr.wordpress.org/plugins/loco-translate/). As the Poedit software was all but intuitive to me, I used the WordPress plugin **LocoTranslate**.
That plugin is more intuitive in my opinion and you can work from the WordPress back-office.

Normally, you won't have to do it another time for the Caweb theme, but just in case : 
1. To genarate the **.pot** template file, intall and activate the plugin Loco Translate. Go to *Locotranslate -> Themes -> Your_Theme -> Generate template*. A .pot should be genrated in the path you specified.
2. To create **.po** and **.mo** containing the translations for a language, go to *Locotranslate -> Themes -> Your_Theme -> New language*. Then choose the language in which you want to translate. From here you will be able to translate each indivudual strings and generate the files.

#### Update translation files
This is somtehing you are very likely to do. Whenever you add code to the theme files and put new strings (always in internationalization functions) in the code base, you will have to update the .pot, and the .po and .mo files for each languages. 

To do this, you have to : 
1. Update the .pot template. Proceed as such : *Locotranslate -> Themes -> Your_Theme -> Edit template*. Click on the *sync* button.
2. Then, you can go to *Locotranslate -> Themes -> Your_Theme* and update each language by tranlating the new string and saving. This will update your .po and .mo files. 


