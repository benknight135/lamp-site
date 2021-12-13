# Setup new Heroku PHP web app
Visit the [Heroku website](heroku.com) and create a new app.

Go to [Heroku dashboard](dashboard.heroku.com) and connect the newly created app to your Github repository.

For mysql go to resources tab and add ClearDB MySQL.

Get your database URL by going to settings tab and finding Config Vars section. Click to revel to variables and look for CLEARDB_DATABASE_URL. Make a note of this URL. 

While you are at the Config Vars section add a variable named APP_DEBUG and set the value to 'false'. This will be used to configure the web app and allow different configurations for develpment and production.

Find your API key in Heroku account settings and create GitHub sercret HEROKU_API_KEY as well as HEROKU_APP_NAME and HEROKU_EMAIL. These secrets will be used in deployment github action.
