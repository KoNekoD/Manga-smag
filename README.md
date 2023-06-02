# Начальные действия:

1. Скопировать .env файл и вставить под названием .env.local

# Подготовка к запуску:

php bin/console doctrine:database:create
### при изменении бд тыкать это
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

# Как запустить:

Терминал 1:
> `.\symfony serve![img.png](img.png)`

Терминал 2:
> `npm run dev-server`

# Описание 

entityManager->persist - Подготавливает объект для сохранения в базу через entityManager->flush в базу.
Если он был получен из репозитория, то entityManager->persist НЕ НУЖЕН
entityManager->flush - Сохраняет все изменения и подготовленные объекты

SerializerServiceInterface - Сериализация/Де-сериализация данных
Entity - Сущность, обозначает строку в базе
Repository - Получение сущности
Controller - Endpoint(Конечная точка, с неё всё начинается)
DTO - Хранит ТОЛЬКО данны

# *

Exception - Ошибки, исключения, можно выбросить и отловить и обработать
Factory - Фабрика, для создания сущностей с доп. логикой при создании