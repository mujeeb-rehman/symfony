# symfony----------------------------------------------------------------------------------------------------------------

Following are the project instructions given by sir Waqas Mahmood 


Assignment:
I need you to implement ACL.. expected functionalities would be to have a blog backend admin panel
- Login
- Roles Implementation (Super Admin, Admin, Editor, Viewer.. )
- Posts CRUD
- Authors CRUD
- Comments

I need only admin panel super admin can create and assign roles to different users and user can log in and do their stuff like
if an admin logs in -> he can create/update/delete list posts, authors, and everything related to the blog
if the editor log in -> he can update posts related to stuff
if viewer logs in -> he can view all the listing etc
Don't want design and stuff to be complicated.. keep it simple in design

I will review your progress on daily basis. Meanwhile, you can contact me anytime if you face any issues. 


# Basic setup --------------------------------------------------------------------------------------------------------------

please run the following commands after cloning this project

1> $ composer update

2> $ php bin/console doctrine:database:create
3> $ php bin/console make:migration
4> $ php bin/console doctrine:migrations:migrate
5> $ php bin/console doctrine:fixtures:load

# Credentials--------------------------------------------------------------------------------------------------------------------

Super admin:
    username: coeus
    password: password123
admin:
    username: admin
    password: password123
Editor:
    username: editor
    password: password234
Visitor:
    username: visitor
    password password123
