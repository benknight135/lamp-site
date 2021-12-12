# Add mySQL database to Azure web app

## Azure
*Run the following commands inside the Azure console.*

Create mysql server
```
az mysql flexible-server create --name <mysql-server-name> --resource-group <resource-group> --public-access <IP-Address> --admin-user <admin-user> --admin-password <admin-password>
```
*Public IP is required to locally setup the database, get your public ip [here](https://ipinfo.io/ip)*

Configure firewall
```
az mysql flexible-server firewall-rule create --name allanyAzureIPs --server <mysql-server-name> --resource-group <resource-group> --start-ip-address 0.0.0.0 --end-ip-address 0.0.0.0
```

## Setup Database
*Run the following on your local machine*

Connect to azure mysql database
```
mysql -u <admin-user> -h <mysql-server-name>.mysql.database.azure.com -P 3306 -p
```

Inside the mysql console enter the following commands
```
CREATE DATABASE sampledb;
CREATE USER '<admin-user>' IDENTIFIED BY '<admin-password>';
GRANT ALL PRIVILEGES ON sampledb.* TO '<admin-user>';
quit
```