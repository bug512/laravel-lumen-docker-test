# Laravel/Lumen Docker тестирование

### **Окружение**

-  **app**, PHP контейнер

        Nginx, PHP7.2 PHP7.2-fpm, Composer, NPM, Node.js v8.x
    
-  **mysql**, MySQL контейнер

#### **Структура проекта**
```
+-- src <project root>
+-- resources
|   +-- default
|   +-- nginx.conf
|   +-- supervisord.conf
|   +-- www.conf
+-- .gitignore
+-- Dockerfile
+-- docker-compose.yml
+-- readme.md <this file>
```

### **Установка**

- Установка контейнеров.
 ```
$ docker-compose up -d
 ```
 
- Переходим в контейнер.

 ```
 $ docker-compose exec myapp bash
 ```

- Установка зависимостей проекта

```
$ composer install 
```

- Установка миграций и сидов

```
$ php artisan migrate --seed
```

- Генерация документации

```
$ php artisan apidoc:generate
```

- Запуск воркера очереди

```
$ php artisan queue:work

```

- Запуск phpunit

```
$ vendor/phpunit/phpunit/phpunit 

```
### **Проект**

http://localhost/

### **API**
http://localhost/api/

Доступ к API открыт только по ключу X_API_KEY=5ebe2294ecd0e0f08eab7690d2a6ee69
меняется в файле .env


### **Документация**

Сгенерированная документация находится по адресу http://localhost/docs/