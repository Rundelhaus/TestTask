Запуск проекта:
1. Клонировать в локальный репозиторий
2. Запустить composer update
3. Создать базу данных, или настроить доступ к уже имеющейся через .env файл
4. Для запуска на своей машине достаточно команды php artisan serve. Простейший в запуске хостинг - Heroku.

Диаграмма БД проекта - DB Diagram (https://github.com/Rundelhaus/TestTask/blob/master/DB%20Diagram.pdf)

Api
Атрибуты.

User:
name - string,
email - string,
password - string,
birth - date - дата рождения,
sex - string ,
school_id - integer

Student:
entry - date - дата поступления,
grade - integer -класс,
parallel - string -параллель,
user_id - integer - внешний ключ таблицы users

Teacher:
employment_date - date - дата трудоустройства,
layoff_date -  date - дата увольнения, может быть пустым,
user_id - integer - внешний ключ таблицы users

Mark:
1. student_id - integer - внешний ключ таблицы students
2. teacher_id - integer - внешний ключ таблицы teachers
3. subject_id - integer - внешний ключ таблицы subjects
4. mark - integer
5. get_date - date - лата получения оценки

School:
1. name - string
2. address - string
3. foundation_date - date - дата основания
4. closing_date - date - дата закрытия
5. students_number - integer - количество учеников

Subject:
1. name - string
2. teacher_id - integer - внешний ключ таблицы teachers
3. hours - integer - количество академ часов

Schedule Item:(пункт расписания)
1. subject_id - integer - внешний ключ таблицы subjects
2. schedule_id - integer - внешний ключ таблицы schedule
3. item start - dateTime - начало урока

Schedule:
1. grade - integer - класс
2. parallel - string - параллель

API:
Users
1. /api/users        -get, получить список всех пользователей
2. /api/users/        -post, добавить нового пользователя
3. /api/users/{user}/        -get, получить данные пользователя
4. /api/users/{user}/        -post, отредактировать данные пользователя
5. /api/users/{user}/        -delete, удалить пользователя

Teachers
1. /api/teachers        -get, получить список всех ученика
2. /api/teachers/{teacher}/        -get, получить данные ученика

Students
1. /api/students        -get, получить список всех ученика
2. /api/students/{student}/        -get, получить данные ученика

Marks
1. /api/marks        -get, получить список всех оценок
2. /api/marks/        -post, добавить новую оценку
3. /api/marks/{mark}/        -get, получить данные оценки
4. /api/marks/{mark}/        -post, отредактировать данные оценки
5. /api/marks/{mark}/        -delete, удалить оценку

Schedules
1. /api/schedule        -get, получить список всех расписаний
2. /api/schedule/        -post, добавить новое расписание
3. /api/schedule/{schedule}/        -get, получить данные расписания
4. /api/schedule/{schedule}/        -post, отредактировать данные расписания
5. /api/schedule/{schedule}/        -delete, удалить расписание

Schedule Items
1. /api/schedule-items        -get, получить список всех пунктов расписаний
2. /api/schedule-items/        -post, добавить новый пункт расписания
3. /api/schschedule-itemsedule/{schedule-item}/        -get, получить данные пункта расписания
4. /api/schedule-items/{schedule-item}/        -post, отредактировать данные пункта расписания
5. /api/schedule-items/{schedule-item}/        -delete, удалить пункт расписания

Schools
1. /api/schools        -get, получить список всех школ
2. /api/schools/        -post, добавить новую школу
3. /api/schools/{school}/        -get, получить данные школы
4. /api/schools/{school}/        -post, отредактировать данные школы
4. /api/schools/{school}/        -delete, удалить школу

Subjects
1. /api/subjects        -get, получить список всех предметов
2. /api/subjects/        -post, добавить новый предмет
3. /api/subjects/{subject}/        -get, получить данные предметы
4. /api/subjects/{subject}/        -post, отредактировать данные предмета
5. /api/subjects/{subject}/        -delete, удалить предмет
