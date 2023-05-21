# Начальные действия:

1. Скопировать .env файл и вставить под названием .env.local

# Подготовка к запуску:

bin/console doctrine:database:create
### при изменении бд тыкать это
bin/console doctrine:migrations:migrate
bin/console doctrine:fixtures:load

# Как запустить:

Терминал 1:
> `symfony serve`

Терминал 2:
> `npm run dev-server`

# Описание

SerializerServiceInterface - Сериализация/Де-сериализация данных
Entity - Сущность, обозначает строку в базе
Repository - Получение сущности
Controller - Endpoint(Конечная точка, с неё всё начинается)
DTO - Хранит ТОЛЬКО данны

# *

Exception - Ошибки, исключения, можно выбросить и отловить и обработать
Factory - Фабрика, для создания сущностей с доп. логикой при создании