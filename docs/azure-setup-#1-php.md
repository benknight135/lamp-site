# Setup new Azure PHP web app 

## Azure
*Run the following commands inside the Azure console.*

Create deployment user
```
az webapp deployment user set --user-name <username> --password <password>
```

Create resource group
```
az group create --name <resource-group> --location "West Europe"
```

Create an Azure App Service plan
```
az appservice plan create --name <app-service-plan> --resource-group <resource-group> --sku FREE --is-linux
```

Create web app
```
az webapp create --resource-group <resource-group> --plan <app-service-plan> --name <app-name> --runtime 'PHP|7.4' --deployment-local-git
```
This will be ready at: http://[app-name].azurewebsites.net  
Git available at: https://[username]@[app-name].scm.azurewebsites.net/[app-name].git

Setup deployment branch
```
az webapp config appsettings set --name <app-name> --resource-group <resource-group> --settings DEPLOYMENT_BRANCH='main'
```

Create azure credentials for github actions
```
az ad sp create-for-rbac --name "<app-name>" --role contributor --scopes /subscriptions/<subscription-id>/resourceGroups/<resource-group>/providers/Microsoft.Web/sites/<app-name> --sdk-auth
```

## Add remote
*Run the following in a local clone of this repository*

Push website to azure remote
```
git remote add azure https://<username>@<app-name>.scm.azurewebsites.net/<app-name>.git
git push azure main
```

Next step is to [setup MySQL database](docs/azure-setup-#2-mysql.md)