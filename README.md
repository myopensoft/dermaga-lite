# Dermaga CMS (Lite Version)

A CMS for system starter kit. **Dermaga** means wharf in English, and so this CMS aims to become the wharf for data and information.

## Features
* User management
* Multi-role user
* RBAC
* i18n URL (change ```ms``` or ```en``` in URL to change language)
* Minimal default tables in database (auth_assignment, auth_item, auth_item_child, auth_rule, migration, profile, social_account, token, user)
* Automatic Model & CRUD generation - Just create all your tables & relations in database, then run the "autobot" script to automatically generate all related models and CRUD files.

## Installation
1. Clone this repo into a web accessible folder, example: C:\xampp\htdocs
2. Run ```composer update``` in your project root directory to get all vendor files
3. Create a database and change ```dbname``` part in ```config/db.php``` to one you created just now
4. Run ```yii init``` in your project root directory to set up the database
5. Access the CMS at, example: ```http://localhost/dermaga-lite/web```

Super User username/password: root/1qaz2wsx

## Autobot Code Generator
Console command for generating all models & CRUDs from connected database tables, excluding the CMS default tables.

Usage:
* Go to command line in project root ex. c:\xampp\htdocs\dermaga-lite
* To generate all models & CRUDs for your tables, run ```yii autobot/rollout```


*Project sponsored by Opensoft Technologies Sdn Bhd*
