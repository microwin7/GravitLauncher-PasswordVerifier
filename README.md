# PasswordVerifier JSON

![PHP 7.4](https://img.shields.io/badge/PHP-7.4-blue)
![Gravit Launcher](https://img.shields.io/badge/Gravit%20Launcher-5.2.11+-brightgreen)

## JSON метод сверки пароля и хеша

✔ Bcrypt

✔ PHPass

✔ PBKDF2

### НАСТРОЙКА
**Размещение скрипта:**

`Создайте для его свою папку в корне сайта. Не забывайте что нужно будет эту папку вписать в запрос`

- **Настройка passwordVerifier**

```json
        "passwordVerifier": {
          "bearerToken": "aaa",
          "url": "http://127.0.0.1/folder/passwordVerifier.php?МЕТОД_ХЕШИРОВАНИЯ",
          "type": "json"
        },
```
- Придумайте пароль для Bearer Токена или сгенерируйте: [ССЫЛКА](http://www.onlinepasswordgenerator.ru/)
- Замените в `bearerToken` и в скрипте `BEARER` константу
- После `?` впишите метод проверки хеша, к примеру для Bcrypt будет: `passwordVerifier.php?Bcrypt`

`На основе скрипта можете сделать свой алгоритм проверки хеша`

### Пожертвования разработчику
- [QIWI MICROWIN7](https://qiwi.com/n/microwin7)
- [ЮMoney 4100117702839788](https://yoomoney.ru/to/4100117702839788)

### Примечания
- Для использования PBKDF2 для Django CMS, создайте папку Hashers, туда скачайте [PBKDF2PasswordHasher.php](https://github.com/rukzuk/rukzuk/blob/master/app/server/library/Cms/Access/Hashers/PBKDF2PasswordHasher.php)
Удалите 2 строку и из 11 удалите `implements IPasswordHasher`
