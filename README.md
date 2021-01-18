"# Resume_API" 
Инструкция по сборке:
1) Создать папку под проект и скачать в нее репозиторий: git cone https://github.com/twi9gy/Resume_API
2) Восстановить резервную копию базы данных (resume_db.dump): psql имя_базы < resume_db.dump
3) Создать файл для подключения к базе данных '/config/parameters.ini'. Пример конфигурации представлен в файле '/config/parameters.ini.dist'
4) Создать домен в OpenServer для папки 'api'.
5) Изменить парамент $imageFullName в файле '/api/resume/uploadFile.php'.
