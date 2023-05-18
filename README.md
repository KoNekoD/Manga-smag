# Начальные действия:

1. Скопировать .env файл и вставить под названием .env.local

# Подготовка к запуску:

bin/console doctrine:database:create
bin/console doctrine:migrations:migrate
bin/console doctrine:fixtures:load

# Как запустить:

Терминал 1:
> `symfony serve`

Терминал 2:
> `npm run dev-server`