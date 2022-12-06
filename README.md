# Project_03

### This project is the third cornerstone in my development as Full Stack developer while attending the Brainster programming academy and they attest for the commitment and knowledge that was needed to achieve the goal of becoming Full Stack developer.

## Description
### The project is about creating webpage for a user to participate in lottery game provided by Jegermaister. The condition to enter the game is for the user to have purchased a Jegermaister product and that product should be on a fiscal receipt. The webpage consist of two main sides, user side and admin side. 

The user side is made of a button where a modal appears and the user has to put in a valid email address and a picture of the receipt. Depending on if the receipt is really a receipt/or with high certainty  or not, the responses are "Good luck" -meaning it has past or "The recipt is not valid" - the receipt hasn't past. The user has 3 times to try afterward the webisite is blocked for 24 hours (in this case 8 seconds).

### If you want to go to the admin side in the url address space just add to the url the following: "/login"
The admin is seeded that it is hardwriten with username "admin@example.com" and password "admin123". The admin has the job to approve or decline the receipts that are fiscal receipt depnding on two conditions:
### 1.If the receipt is 100% fiscal receipt
### 2.There is a Jegermaister product on the receipt.
For the the site work properly you have to go through receipts from left to right one by one NOT skipping.
On the approved tab he can see all the approved fiscal receipts and a button - "Award someone" which if pressed it will choose some one randomly from the database in which time a modal will open for the admin to choose which award to give(if the award is depleted it will not be shown in the modal) and when the confirm button is pressed it will send automaticly email to the winner and write him in the awarded section and remove the fiscal receipt from the approved. When the declined tab is pressed all the declined receipts are shown whith the option to be approved again(if by some mistake they are declined in the first time or some rules of the game have been changed).

## Tools
The project was created using LARAVEL 9, JAVASCRIPT, MySQL.

## Opening the project
If you want to see the project online you can visit the following page: .
If you want to open the project you should do the following steps:
### 1.Download the project and unzipped it.
### 2.Open it and VS or other code editor, the open a terminal and write "composer update"
### 3.In the .env enter the following code:
    3.1 DB_DATABASE=project_03 (or somethig else if you like it)
    3.2 For the mailer function to work you need to enter:
        MAIL_MAILER=smtp
        MAIL_HOST=smtp.mailtrap.io
        MAIL_PORT=2525
        MAIL_USERNAME=(your user name from your profile)
        MAIL_PASSWORD=(your password from your profile)
        MAIL_ENCRYPTION=tls
        MAIL_FROM_ADDRESS="admin@jegermaister.com"
        MAIL_FROM_NAME="Jegermaister"

### 4.After the update is finished write in the terminal "npm install" and "npm run dev".
### 5.On the terminal launch a new profile - PowerShell and in it write php artisan storage:link just in case.
### 6.In the terminal - PowerShell write php artisan migrate & php artisan db:seed to write down the tables and populate some of the tables (admin and rewards) which you can change them if you want in the database folder in the Laravel project.
### 7. In the terminal write php artisan serve - to open the project.


Thanks and I hope you'll like it.# jeger-brainster
# jeger-brainster
