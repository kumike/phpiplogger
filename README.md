# PHP IP Logger

A lightweight PHP logger that stores visitor data into a database.
Installation is done via `install.php`, after which the logger can be added to any page of your website.

---

## 📌 Features

* Logs visitor IP address
* Stores User-Agent (browser / device)
* Saves visit date and time
* Automatically creates database and tables via `install.php`
* Easy integration into any PHP page (one line)

---

## ⚠️ Disclaimer

Use this tool only on your own projects or with user consent.
You are responsible for complying with privacy laws (GDPR, etc.).

---

## 🚀 Installation

1. Clone the repository:

```bash id="x1y2z3"
git clone https://github.com/kumike/phpiplogger.git
cd phpiplogger
```

2. Upload files to your server (PHP + database required)

3. Open in browser:

```id="a9b8c7"
http://your-domain/install.php
```

4. Enter your database credentials

5. The installer will:

   * create the database (if needed)
   * create required tables
   * configure the logger

---

## ⚙️ Usage

After installation, include the logger in any page where you want to track visitors.

Add this line to your PHP file (e.g. `index.php`, `header.php`, or any other page):

```php id="m4n5o6"
<?php require_once('phpiplogger/ip.php'); ?>
```

📍 Recommended placement:

* at the top of the file (right after `<?php`)
* or inside a global template file (like `header.php`) to track all pages

Once added, every visitor will be automatically logged into the database.

---

## 🗄️ Stored Data

* IP address
* User-Agent (browser / device)
* Visit timestamp

---

## 🔒 Security Notes

* **Delete `install.php` after setup**
* Restrict database access
* Do not expose internal files publicly
* Use HTTPS

---

## 📜 License

Provided as-is, without warranty.

---

## 👤 Author

https://github.com/kumike

---

## ⭐ Support

If you find this project useful, consider giving it a ⭐

[![Buy Me a Coffee](https://img.buymeacoffee.com/button-api/?text=Buy+me+a+coffee&emoji=&slug=yourname&button_colour=FFDD00&font_colour=000000&font_family=Arial&outline_colour=000000&coffee_colour=ffffff)](https://donatello.to/MichailKubrak?g=coffee)

[![Donate](https://img.shields.io/badge/Support%20Project-2ea44f?style=for-the-badge&logo=githubsponsors&logoColor=white)](https://donatello.to/MichailKubrak?g=coffee)

[![Donate](https://img.shields.io/badge/☕%20Donate%20Me-FF813F?style=for-the-badge&logo=buymeacoffee&logoColor=white)](https://donatello.to/MichailKubrak?g=coffee)


################## RU ######################
# PHP IP Logger

Лёгкий PHP-логгер, который сохраняет данные о посетителях в базу данных.
Установка выполняется через `install.php`, после чего логгер можно добавить на любую страницу сайта.

---

## 📌 Возможности

* Логирование IP-адреса посетителя
* Сохранение User-Agent (браузер / устройство)
* Фиксация даты и времени визита
* Автоматическое создание базы данных и таблиц через `install.php`
* Простая интеграция в любую PHP-страницу (одна строка)

---

## ⚠️ Отказ от ответственности

Используйте этот инструмент только на своих проектах или с согласия пользователей.
Вы несёте ответственность за соблюдение законов о защите персональных данных (GDPR и др.).

---

## 🚀 Установка

1. Клонируйте репозиторий:

```bash id="r1s2t3"
git clone https://github.com/kumike/phpiplogger.git
cd phpiplogger
```

2. Загрузите файлы на сервер (требуется PHP и база данных)

3. Откройте в браузере:

```id="u4v5w6"
http://your-domain/install.php
```

4. Введите данные для подключения к базе данных

5. Установщик автоматически:

   * создаст базу данных (если необходимо)
   * создаст нужные таблицы
   * настроит логгер

---

## ⚙️ Использование

После установки подключите логгер в любую страницу, где нужно отслеживать посетителей.

Добавьте эту строку в PHP-файл (например `index.php`, `header.php` или любую другую страницу):

```php id="x7y8z9"
<?php require_once('phpiplogger/ip.php'); ?>
```

📍 Рекомендуется размещать:

* в начале файла (сразу после `<?php`)
* или в общем шаблоне (например `header.php`), чтобы логировались все страницы

После этого каждый посетитель будет автоматически записываться в базу данных.

---

## 🗄️ Сохраняемые данные

* IP-адрес
* User-Agent (браузер / устройство)
* Дата и время визита

---

## 🔒 Безопасность

* **Удалите `install.php` после установки**
* Ограничьте доступ к базе данных
* Не открывайте служебные файлы публично
* Используйте HTTPS

---

## 📜 Лицензия

Предоставляется «как есть», без каких-либо гарантий.

---

## 👤 Автор

https://github.com/kumike

---

## ⭐ Поддержка

Если проект оказался полезным — поставьте ⭐

################################################

[![Buy Me a Coffee](https://img.buymeacoffee.com/button-api/?text=Buy+me+a+coffee&emoji=&slug=yourname&button_colour=FFDD00&font_colour=000000&font_family=Arial&outline_colour=000000&coffee_colour=ffffff)](https://donatello.to/MichailKubrak?g=coffee)

[![Donate](https://img.shields.io/badge/Support%20Project-2ea44f?style=for-the-badge&logo=githubsponsors&logoColor=white)](https://donatello.to/MichailKubrak?g=coffee)

[![Donate](https://img.shields.io/badge/☕%20Donate%20Me-FF813F?style=for-the-badge&logo=buymeacoffee&logoColor=white)](https://donatello.to/MichailKubrak?g=coffee)

