# LingoNet

## About The Project

As avid language learners, we have noticed that it is difficult to find language partners to practice with, especially due to the pandemic. As a result, we have decided to create an application, LingoNet, that will allow language learners to find other language learners who speak or also want to practice the same target languages. The app opens with the login/signup page. There will be a user feed where they can view other learners’ profiles and send friend requests. There will be a user profile page where users can edit their profiles and add/edit/delete an introductory post. There will be a friends page where users can view pending, incoming, and accepted friend requests. Users can view their friends’ profiles and contact information.

### Built With

- [PHP](https://www.php.net/)
- [Angular](https://angular.io/)
- [Bootstrap](https://getbootstrap.com/)
- [MySQL](https://www.mysql.com/)

## Getting Started with Local Deployment

1. Start up your local PHP server.

   - To start up the PHP server using XAMPP:
     - Clone the repo into your htdocs folder.
     - Start up the localhost server.

2. Start up your local Angular server.

   - Go to the angular/lingoNet-angular folder. Run the following commands:
     - npm install - Installs the node modules
     - ng serve - Starts the localhost angular server

3. Start up your local MySQL server.

   - Set up your environment variables to connect to the database by doing the following:
     - Within the db folder, create a file named "environment.php" and copy the contents of "environment-example.php" into that new file.
     - Correctly set your credentials inside "environment.php".

4. After all three components have been started, head to your lingoNet/auth/welcome.php localhost url.
