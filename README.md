# PasswordVerifier JSON

![PHP ^7.4.27|^8.0](https://img.shields.io/badge/PHP-^7.4.27|^8.0-blue)
![Gravit Launcher](https://img.shields.io/badge/Gravit%20Launcher-^5.2.11-brightgreen)

## JSON метод сверки пароля и хеша

✔ Bcrypt

✔ PHPass

✔ PBKDF2

### Установка
**Размещение скрипта:**

- Установите **`Composer`** [ССЫЛКА](https://getcomposer.org/download/)

- Развёртывание проекта:
  - Перейдите в папку сайта, командой:
    - Пример:
    ```bash
    cd /var/www/html
    ```
  - Вызвать установку:
  ```bash
  composer create-project microwin7/password-verifier PasswordVerifier
  ```
  - Создаст папку **PasswordVerifier** в месте вызова команды и развернёт проект

## Настройка passwordVerifier

```json
        "passwordVerifier": {
          "bearerToken": "aaa",
          "url": "http://127.0.0.1/PasswordVerifier/passwordVerifier.php?МЕТОД_ХЕШИРОВАНИЯ",
          "type": "json"
        },
```
- Придумайте пароль для Bearer Токена или сгенерируйте: [ССЫЛКА](http://www.onlinepasswordgenerator.ru/)
- Замените значение **`bearerToken`** в `passwordVerifier`
- Замените значение **`BEARER_TOKEN`** в PasswordVerifier/config/MainConfig.php
- После `?` впишите метод проверки хеша, к примеру для Bcrypt будет: `passwordVerifier.php?Bcrypt`

`На основе скрипта можете сделать свой алгоритм проверки хеша`

### На кофе
- [QIWI MICROWIN7](https://qiwi.com/n/microwin7)
- [ЮMoney 4100117702839788](https://yoomoney.ru/to/4100117702839788)
