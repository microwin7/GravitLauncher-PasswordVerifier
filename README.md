# PasswordVerifier JSON

![PHP ^8.3](https://img.shields.io/badge/PHP-^8.3-blue)
![Gravit Launcher](https://img.shields.io/badge/Gravit%20Launcher-^5.2.11-brightgreen)

## JSON метод сверки пароля и хеша

✔ Bcrypt

✔ WordPress Bcrypt (Версия WordPress 6.8 и выше)

✔ PHPass

✔ PBKDF2

### Установка
**Размещение скрипта:**

- Установите **`Composer`** [ССЫЛКА](https://getcomposer.org/download/)

- Развёртывание проекта:
  - Перейдите в папку сайта, командой:
    - Пример:
    ```bash
    cd /var/www/
    ```
  - Вызвать установку:
  ```bash
  composer create-project microwin7/password-verifier
  ```
  - Создаст папку **password-verifier** в месте вызова команды и развернёт проект

## Настройка NGINX
```nginx
server {
    listen       29301;

    root /var/www/password-verifier/public;
    charset utf-8;

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    location / {
        index index.php;
        location ~ \.php$ {
            fastcgi_pass unix:/run/php/php8.3-fpm.sock;
            fastcgi_index index.php;
            fastcgi_buffering off;
            fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
            include         /etc/nginx/fastcgi_params;
        }
    }
}
```

## Настройка passwordVerifier

```json
        "passwordVerifier": {
          "bearerToken": "aaa",
          "url": "http://127.0.0.1:29301/",
          "type": "json"
        },
```
- Придумайте пароль для Bearer Токена или сгенерируйте: [ССЫЛКА](http://www.onlinepasswordgenerator.ru/)
- Замените значение **`bearerToken`** в `passwordVerifier`
- Замените значение **`BEARER_TOKEN`** в `.env`

`На основе скрипта можете сделать свой алгоритм проверки хеша`

### На кофе
- [ЮMoney 4100117702839788](https://yoomoney.ru/to/4100117702839788)
