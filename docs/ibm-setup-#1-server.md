# Create IBM Cloud virtual server
1. Login to **IBM Cloud**, search for **Virtual Server for Classic** service.
2. Choose **Public** as server **Type of virtual server**.
3. Set the Operating System to **Ubuntu** version **18.04 LAMP LTS**. This will come with pre-installed with Apache, MySQL, and PHP but we will reinstall PHP and MySQL with the latest version.
4. Under **Network Interface** select the **Public and Private Network Uplink** option.
5. Review the other configuration options, then click **Create**.
6. Once the server is ready, find login credentials under **Passwords**. You will need to password for the 'root' user. If there is not root user, create credentials. 
7. Connect to the server using SSH
   ```sh
   sudo ssh root@<Public-IP-Address>
   ```
## Re-install Apache, MySQL, and PHP
Run the following command to update Ubuntu package sources and reinstall Apache, MySQL, and PHP with latest versions.  

```sh
sudo apt update && sudo apt install lamp-server^
```
**Note** the caret (^) at the end of the command.

## Verify installation and configuration
Verify Apache, MySQL, and PHP running on Ubuntu image.

1. Verify **Ubuntu** by opening in the **Public IP** address in the browser. You should see the Ubuntu welcome page.
2. Check **Apache** version installed using the following command:
   ```
   apache2 -v
   ```
3. Verify port 80 for web traffic, run the following command:
   ```
   sudo netstat -ntlp | grep LISTEN
   ```
4. Check the **version** of MySQL using the following command:
   ```sh
   mysql -V
   ```
5. Run the following script to help secure MySQL database:
   ```sh
   mysql_secure_installation
   ```
6. Enter MySQL root **password**, and configure the security settings for your environment.
   To create a MySQL database, add users, or change configuration settings, login to MySQL
   ```sh
   mysql -u root -p
   ```
   **Note:** MySQL default username and password is root and root.  
   When done, exit the mysql prompt by typing `\q`.
7. Check the version of PHP using the following command:
   ```sh
   php -v
   ```
