## Start in docker
```
git clone https://github.com/anydasa/php-rest-api.git
cd php-rest-api
docker-compose build
docker-compose up -d
```


## Start on php server
```
php -S localhost:80 public/index.php
```


#### Not Allowed Method
```
curl -u admin:admin -X POST http://localhost -v
```
#### Unauthorized
```
curl -u blabla:blabla http://localhost -v
```

#### Unauthorized
```
curl -u blabla:blabla http://localhost -v
```

