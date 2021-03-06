[![Build Status](https://travis-ci.org/ArmiT/transactions.svg?branch=master)](https://travis-ci.org/ArmiT/transactions)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/1cb32202339948deafeb95772c230859)](https://www.codacy.com/app/artem-rar/transactions?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=ArmiT/transactions&amp;utm_campaign=Badge_Grade)

Требуется реализовать библиотеку для безопасного (целостного) применения миграций к данным либо структурам данных проекта.
Библиотека должна обеспечивать возможность последовательного выполнения доступных миграций с учетом хронологии их создания,
обеспечивать транзакционность при выполнениии миграций, учитывать историю выполнения миграций с целью предотвращения повторного
выполнения ранее примененных миграций. Обеспечивать контроль возникновения ошибок с целью обеспечения транзакционности выполняемых 
действий.
Реализация механизмов работы с данными и моделями данных не требуется.
Предлагаемый внешний интерфейс см. в тестах.
Внутренняя архитектура на усмотрение разработчика. 

- [Миграция](https://en.wikipedia.org/wiki/Schema_migration) 
- [Транзакция](https://en.wikipedia.org/wiki/Database_transaction)

Функциональные требования
-------------------------

- Возможность *полного* последовательного применения миграций к проекту. 
- Возможность *частичного* последовательного применения миграций к проекту.
- Возможность *полной* последовательной отмены (отката) примененных миграций.
- Возможность *частичной* последовательной отмены примененных миграций.
- Возможность получения *полного* списка примененных миграций в *хронологическом* порядке.
- Возможность получения *части* списка примененных миграций в *хронологическом* порядке.
- Обработка возможных исключительных ситуаций во время применения миграций с откатом до предыдущего стабильного состояния.
- Обработка возможных *no-fatal* ошибок во время применения миграций с откатом до предыдущего стабильного состояния.
- Контроль попыток повторного запуска примененных миграций.
- Контроль race condition.

Используемые технологии
-----------------------

- PHP 7.0+

Порядок выполнения
-----------------------

- Сделать форк [репозитория с заданием](https://github.com/ArmiT/transactions).
- В корневую директорию проекта добавить файл CONTRIBUTORS.md с именем исполнителя
- Реализовать задание с учетом функциональных требований и пожеланий
- По готовности, сформировать pull request с форка на репозиторий с заданием.
