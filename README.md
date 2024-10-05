## Запуск

Пирложение работает через Docker с помощью Sail.

```bash
git clone https://github.com/George-Karpenko/test-focus-on-results.git
cd test-focus-on-results
composer install
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
```

## парсер

Парсер запускется командой:

```bash
./vendor/bin/sail artisan app:parser-from-hh-website
```
