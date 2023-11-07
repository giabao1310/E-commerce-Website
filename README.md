# E-commerce-Website
## Installation instructions:
1. Download the compressed file from the group and unzip it.
2. Start the Docker Engine.
3. Open a command prompt window (Terminal, Command Prompt, or PowerShell).
4. Move the working directory of the command prompt window to the E-commerce-Website directory (using the cd command).
5. Type the command `docker-compose up -d` and wait for it to finish running.


## Web application usage instructions:

1. First, go to the page http://localhost:8080 to access the web application's homepage. You can also go to http://localhost:8888 to view the database creation.
2. To use the web application's functions, you must log in by hovering over the person icon in the top right corner. You can use the provided accounts or create a new account to log in.
3. After logging in, you can use the functions by hovering over the sections in the footer. There will be complete links to the functions that we have created, such as withdrawal, transfer, and phone card purchase. 

## Quotation
> To use the admin function, you must log in with the admin account, and the admin account can use all of the current functions.


## Instructions for using the main functions:

- ***Phone card purchase function***: Select the items such as card type, face value, and quantity, and then select "Pay". The system will provide the necessary information and the card code.
- ***Money transfer function***: To transfer money, you need to enter the phone number of the recipient and the necessary information such as the amount of money and the person who bears the fee. Then, an OTP code will be sent to the email of the account and you need to enter the correct OTP to complete the transfer.
- ***Money withdrawal function***: Similar to the above, you need to enter the beneficiary bank account number to transfer (but since we do not have data, it will accept any account number). Next, select "Confirm" to deduct money from your account.
- ***Password change function***: You need to enter the correct old password and confirmation password to successfully change the password.
- ***Account confirmation/lock/unlock function***: You need to use the admin account to perform this function. After entering the admin user information page, there will be buttons to perform the above functions.


## Some pre-created accounts (in the format username/password):

- **Admin**: 
+       admin/123456
- **Normal user**:
+       user1/123456
+       user2/123456

### ...


## Additional notes:

1. The web application uses Docker to run. You must have Docker installed on your computer to use the application.
2. The web application uses a MySQL database. You must have MySQL installed on your computer to use the application.
3. The web application is still under development. There may be bugs or missing features.