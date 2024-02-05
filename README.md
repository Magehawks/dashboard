# Score Dashboard System

### Docker Setup is from
https://www.twilio.com/en-us/blog/get-started-docker-symfony
- Php 8.0
- Mysql 8.0

### for local working

- install docker on your enviroment
- execute `$ git clone git@github.com:Magehawks/dashboard.git` to clone the repo
- execute `$ docker-compose build` build
- execute `$ docker-compose up -d` to start
- execute `$ docker-compose exec php sh` to login in the php container
- in the container execute `$ composer install` to install all the needed stuff
- now call in your browser http://localhost:8080/ and you see the dashboard

#### other optional commands
- execute `$ docker-compose stop` to stop

### this Board can following Features

1. Admin Interface
   - the Admin Interface is callabel over /admin
   - with following FeatureSet:
      1. Create Games
      2. Create Categorys
      3. Create Rules
      4. Create Tournament System
         1. KO- System
         2. KO- System with Loser Bracket
     5. Add Content for Index/News Page
     6. Add Content for Feedback Page
     7. Add Content DataPrivacy and Impress Page
2. User Interface
   - the Userinterface contains a Account with following FeatureSet
     1. Add SteamUsername
     2. Update EmailAddress
     3. See History of Score Dashboard Results
3. Score Dashboard
   - See Games for Challenges
   - See Categorys and the Rules for that
   - See a Scoreboard for the Category
   - User can set a Record for the Category 
     - if the User loggedin its update the Histroy of his Account
   - See Discord Server and Invite
   - See Q/A Site 
   - See a Feedback page with the possibilty to add requests