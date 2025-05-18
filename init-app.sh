#!/bin/bash
# init-app.sh

# Ждем готовности базы данных
/usr/local/bin/wait-for-sql.sh db 3306

# Запускаем Apache в фоновом режиме
echo "Запуск веб-сервера..."
apache2-foreground