# List management app

# Testing accounts:
 - Admin
    - username: admin
    - password: admin123


# How to test

The app is structured into 2 parts - frontend and backend (both in code/).

## Setup backend

Run xampp Apache and MySql server and go to localhost/phpmyadmin, there you should import the database "db.sql"


## Setup frontend

First go into code/frontend/src/main.js and in line 11 set correct port to your xampp apache server.

Next you have to have installed Node. After that you should move into code/frontend and run the next commands:
 - npm install
 - npm run serve

Now you should have installed all node modules and serve the website on some localhost:port

