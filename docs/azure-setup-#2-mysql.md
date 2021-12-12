# Add mySQL database to Azure web app

## Azure
*Run the following commands inside the Azure console.*

Create mysql server
```
az mysql flexible-server create --name <mysql-server-name> --resource-group <resource-group> --admin-user <admin-user> --admin-password <admin-password>
```

Configure firewall for local machine  
*Public IP is required to locally setup the database, get your public ip [here](https://ipinfo.io/ip)*
```
az mysql flexible-server firewall-rule create --rule-name <local-machine-rule-name> --name <mysql-server-name> --resource-group <resource-group> --start-ip-address <IP-Address> --end-ip-address <IP-Address>
```

Configure firewall for azure app services
```
az mysql flexible-server firewall-rule create --rule-name allanyAzureIPs --name <mysql-server-name> --resource-group <resource-group> --start-ip-address 0.0.0.0 --end-ip-address 0.0.0.0
```

## Setup Database
*Run the following in a local clone of this repository*

Configure database
```
mysql --user="<admin-user>" --password="<admin-password>" -h <mysql-server-name>.mysql.database.azure.com -P 3306 --execute="CREATE DATABASE <database-name>;CREATE USER '<db-user>' IDENTIFIED BY '<db-password>';GRANT ALL PRIVILEGES ON <database-name>.* TO '<db-user>';"
```
*Note the [db-user] and [db-password] is a new user you are creating for modifying the database*

## Setup azure app database settings
Add database variables to setting to use azure database in production
```
az webapp config appsettings set --name <app-name> --resource-group <resource-group> --settings DB_HOST='<mysql-server-name>.mysql.database.azure.com'

az webapp config appsettings set --name <app-name> --resource-group <resource-group> --settings DB_USERNAME='<db-user>'

az webapp config appsettings set --name <app-name> --resource-group <resource-group> --settings DB_PASSWORD='<db-password>'
```
*Php can load these values using $_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']*