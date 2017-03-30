# PHP Apns sender

A just a test simple apns sender

# Install 

* Install composer 
* Run composer install 
* Create a cert folder 
* Put a certificate and a private key in a **.pem** file 

# Send a push 

* Be sure to have a device token and to have already accept to receive the notification 
* A device token

# Run 

* Use the command php -S localhost:<port>
* Using postman and target the following route (I use Slim for handling the request) : http://localhost:<port>/sendpush

