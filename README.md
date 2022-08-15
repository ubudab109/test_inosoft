### REQUIREMENT
- Composer
- Laravel 8
- PHP 8
- MongoDB

### INSTALLATION
- Run `composer install`
- If You have trouble with platform, You can run `composer install --ignore-platform-reqs`
- Run `php artisan migrate`
- Run `php artisan db:seed`
- Run `php artisan jwt:secret` (For JWT Token Secret)
- Run `php artisan key:generate`
- Run `php artisan optimize:clear` && `php artisan optimize`

### CREDENTIAL
All API need authentication to make a request. You can use this credential from seeder database
``
email: test@mail.com
pass: 123123123
``
### MAKING REQUEST
You can import the Postman collection with json format. The file has been attached in the root of project. You can import this file to Your postman

### EXAMPLE REQUEST
You need to pass the JWT Token to Authorization headers. You can see the example at the figure below
![image](https://user-images.githubusercontent.com/62287144/184701020-e5efde80-e75a-485c-a15b-ca6bba8ea006.png)
