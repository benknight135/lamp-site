# Add mySQL database to Azure web app

Create mysql server
```
az mysql server create --resource-group <resource-group> --name <mysql-server-name> --location "UK South" --admin-user <admin-user> --admin-password <admin-password> --sku-name B_Gen5_1
```

Configure firewall
```
az mysql server firewall-rule create --name allAzureIPs --server <mysql-server-name> --resource-group <resource-group> --start-ip-address 0.0.0.0 --end-ip-address 0.0.0.0
```

Configure database settings in web app
```
az webapp config appsettings set --name <app-name> --resource-group <resource-group> --settings DB_HOST="<mysql-server-name>.mysql.database.azure.com" DB_DATABASE="sampledb" DB_USERNAME="phpappuser@<mysql-server-name>" DB_PASSWORD="MySQLAzure2017" MYSQL_SSL="true"
```