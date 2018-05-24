## Тестирование[24.05.2018][pre-middle, PHP]

## Окружение

LAMP

## Инструкции для запуска

### 1. Сессии, кеши, сложные формы

- Папка /1_sessions_cache_and_forms/cache должна быть доступна для записи.

### 2. Трай, кетч, простые классы 

- Папка /2_try_catch_classes/cache должна быть доступна для записи.
- Папка /2_try_catch_classes/tests/cache должна быть доступна для записи.
- В файле /2_try_catch_classes/config.php необходимо прописать свои доступы к БД MySql. Соединение с БД исползуется в качестве тестового объекта для кеширования.

Запуск PHPUnit:
- Находясь в папке проекта выполнить /path/to/php7/php composer.phar install
- /path/to/php7/php vendor/phpunit/phpunit/phpunit tests/CacheTest.php

### 3. Трейты, интерфейсы, наследование классов

Никаких особых условий нет.

### 4. Code review

Никаких особых условий нет.