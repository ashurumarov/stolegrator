# Задание

Перед разработчиками стоит задача разработать приложение для сбора заявок на доставку обедов в офис для сотрудников компании (обеды спонсируются компанией). Краткое описание смотрите в README.md репозитория.

Приложение в стадии разработки. Бизнес-логика вынесена в отдельный репозиторий. В последствии он будет интегрирован с каким-то PHP фреймворком (http, routing, controllers, DI, DB, API и т.д.). То есть детали реализации вынесены за рамки текущей задачи.

На данный момент в приложении уже реализовано получение сотрудником списка активных опросов, а также конкретного опроса. Структура папок и архитектура классов следует принципам чистой архитектуры, чистого кода и DDD.

Следующим этапом необходимо научить приложение фиксировать выбор блюда сотрудником в активном опросе. Функциональность должна быть доступна каждый понедельник с 06:00 утра и до 22:00 вечера (по серверному времени). Под фиксацией мы понимаем создание сущности PollResult с помощью провайдера.

## Задача:
1. Скачать архив репозитория https://drive.google.com/drive/folders/1rPEft21bzIAxxC5fGFhq9BsnILIUYLKa?usp=sharing , распаковать и опубликовать в публичный GIT-репозиторий.
2. В отдельной ветке добавить функциональность приложения по фиксации выбора блюда сотрудником в активном опросе.
3. Придерживаться текущей структуры папок и классов.
4. Покрыть новые классы с логикой модульными тестами (для примера один тест уже написан).
5. Покрыть новый интерактор функциональным тестом (для примера один тест уже написан).
6. Оформить Merge Request (Pull Request) и в описании указать комментарии по принятым решениям.