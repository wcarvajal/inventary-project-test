# Microservicios de Productos e Inventario

Sistema de microservicios independientes para gestión de productos e inventario, implementado con Laravel y Docker.

## Requisitos Previos
    -Docker 20.10+
    -Docker Compose 2.0+
    -PHP 8.2+
    -WAMP/LAMP instalado y corriendo
    -MySQL 8.0+ en el host local

## Instalación

1. Clonar repositorio
-git clone https://github.com/wcarvajal/inventary-project-test.git
-cd inventary-project-test
-Configurar bases de datos en MySQL local

SQL
-CREATE DATABASE products;
-CREATE DATABASE inventory;
-GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '';
-FLUSH PRIVILEGES;

2. Configurar variables de entorno

-cp products-service/.env.example products-service/.env
-cp inventory-service/.env.example inventory-service/.env

# Editar según tu configuración (valores predeterminados funcionan para desarrollo)

3. Construir contenedores

-docker-compose up --build -d
-Instalar dependencias

-docker-compose exec products composer install
-docker-compose exec inventory composer install

-docker-compose exec products php artisan key:generate
-docker-compose exec inventory php artisan key:generate

-docker-compose exec products php artisan migrate
-docker-compose exec inventory php artisan migrate

# Iniciar todos los servicios
-docker-compose up -d

# Detener servicios
-docker-compose down

4. Endpoints disponibles:
-Products Service: http://localhost:8001/api/products
-Inventory Service: http://localhost:8002/api/inventory

5. Pruebas

# Para Products Service
-docker-compose exec products php artisan test --coverage-html=coverage

# Para Inventory Service
-docker-compose exec inventory php artisan test --coverage-html=coverage

5. Verificar cobertura

-products-service/coverage/index.html
-inventory-service/coverage/index.html

6. Pruebas de integración

# Ejecutar pruebas con reporte JUnit
-docker-compose exec products php artisan test --log-junit junit.xml