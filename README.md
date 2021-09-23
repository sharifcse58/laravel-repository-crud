# Laravel Job 

## Follow step by step:


### copy .env.example file to .env

```
cp .env.example .env
```

### install vendor files

```
composer install
```

### install nodemodules files

```
npm install
```

### minify css or js

```
npm run dev
```

### migrate databse

```
php artisan migrate
```

### genrate app key

```
php artisan key:generate
```
### link storage folder to public folder

```
php artisan storage:link
```

### for postman test set header options as like below

```
'headers' => [

    'Accept' => 'application/json',

    'Authorization' => 'Bearer '.$accessToken,

]
```

### for register by sanctum user below url and give name, email, password and c_password

```
http://localhost:8000/api/register
name:''
email:''
password:''
c_password:''
```
### for login by sanctum user below url and give the email and password

```
http://localhost:8000/api/login
email:''
password:''
```
### For expose a rest api endpoints to display all the job lists having basic authentication using laravel sanctum

```
http://localhost:8000/api/job-list
```


### For Create an artisan command to create a user 

```
php artisan create:user
```