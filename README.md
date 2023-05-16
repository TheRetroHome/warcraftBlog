# warcraftBlog
## Описание
warcraftBlog - это блог, созданный на основе популярного PHP-фреймворка Laravel. В проекте реализована возможность создания, редактирования и удаления постов и категорий через админ-панель, а также регистрация, авторизация и выход пользователей на пользовательской части сайта. Посты могут быть просмотрены без регистрации. Реализована возможность зарегестрированным пользователям ставить лайки и оставлять комментарии. Посты собравшие большее колличество лайков отображаются самыми первыми.
Если комментарий оставляет администратор, у него появляется префикс перед его именем (уведомляющий о том, что комментарий оставил именно администратор, а не обычный пользователь), пользователь оставивший комментарий может его удалить, администратор может удалять все комментарии, даже если они были написаны не им (у пользователей такой возможности нет). Реализован поиск по постам. Реализован счётчик просмотров отдельного поста.
У администратора также есть возможность удалять или изменять пост не заходя в админ панели. Реализовано с помощью middleware admin (кастомный middleware) который отображает кнопки удаления и изменения только у пользователей, у которых в базе данных is_admin = 1
При посещении single страницы поста и нажав на категорию к которой этот пост прикреплён, пользователя перекинет на страничку со всеми постами, той категории на которую он нажал

## Основные функции:

1.Админ-панель для управления постами и категориями

2.Регистрация, авторизация и выход пользователей

3.Отображение постов на главной странице

4.Одиночные странички для каждого поста

5.Поиск постов по названию

6.Отображение количества просмотров у каждого поста

7.Отображение даты создания каждого поста

8.Отображение лайков и возможность их ставить авторизованным пользователям

9.Добавление комментариев, и возможность их удаления

10.Возможность просматривать все посты принадлежащей какой-либо отдельной категории

11. Добавлены основные Feature тесты (для регистрации, авторизации, middleware, создание постов и категорий)

## Установка:

1. Клонируйте репозиторий с проектом:

    git clone https://github.com/TheRetroHome/warcraftBlog.git

2. Установите все зависимости:

    composer install

3. Запустите миграции и сидеры:

    php artisan migrate:fresh --seed

4. Прописать

    php artisan storage:link


5. Настройте проект в программе-сервере (XAMPP или OpenServer) для корректного вывода
    

6. При желании можете убедиться в корректности основных функций, произведя запуск тестов командой:

    php artisan test

## Использование

В проекте разработана специальная фабрика и сидер, которые ответственны за создание 50 постов. Для пользователей таких сидеров нет, регистрацию нужно будет произвести вручную.
На основной странице "/" располагаются все посты спагинированные по 6 штук на страницу, тут же можно увидеть поиск всех постов, а чуть выше шапку, где расположены переходы на регистрацию и авторизацию. При последующей авторизации, будет выведено имя пользователя (если он админ, будет надпись "Вы администратор!", нажав на которую можно попасть на admin панель. Чтобы стать администратором, достаточно в таблице users изменить is_admin с нуля на единицу)
Рядом с каждым постом мы видим просмотры и лайки, сортировка происходит именно по лайкам, пост с самым большим колличество отображается первым. Также реализована дата создания поста. Чтобы перейти к single страничке поста достаточно нажать на кнопку "View" или на название. Пользователь являющийся is_admin = 1 может обнаружить 2 дополнительные кнопки у каждого поста (Edit и Delete) позволяющие удалять или изменять. Тем самым администратору не придётся переходить к admin панели и искать нужный пост для его изменения или удаления, что упрощает модерацию контента.

При посещении single странички поста, количество его просмотров увеличивается на 1. Здесь выполнен вывод все данных (картинка, название, цитата, основной контент, категория, просмотры, лайки, комментарии). Ставить лайки и оставлять комментарии может только авторизованный пользователь (1 лайк = 1 пользователь) При нажатии на название категории, нас перекинет на страничку этой категории, где будут выведены все посты к которой она закреплена.
Возможность пользователя оставлять комментарии неограничена, но удалять он может лишь свои комментарии. У администратора существует возможность удалять как свои, так и чужие комментарии. Также рядом с ником админа есть надпись "Администратор". На single страничке разработана пагинация комментариев.

В admin панели представлена возможность добавления и удаления как постов так и категорий. Также реализован их вывод в укороченном виде. Был использован шаблон AdminLTE
## Лицензия

Проект распространяется под лицензией MIT.    
