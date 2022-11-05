#         proyecto12

          Se necesita docker/docker-compose en tu (preferiblemente linux) S.O. un IDE con lo ultimo de php
          y una carpeta de laradock.io
 
  Step-1: Clona laradock => git submodule add https://github.com/Laradock/laradock.git
          La carpeta laradock y la de proyecto12 han de estar al mismo nivel. (seguir leyendo)
 
  Step-2: Dentro de la carpeta laradock, localiza el archivo (oculto) de las variables de entorno .env.example y copialo
          o renombra el mismo a .env, cambiando las siguientes lineas:
          -linea 42: PHP_VERSION=8.1
          -A partir de la linea 534: PHP MY ADMIN => Configurar el acceso a phpmyadmin con el user/password que desees. 
 
  Step-3: Instala/Prueba tus containers: en consola, dentro de la carpeta laradock ejecuta: 
          => sudo docker-compose up -d nginx mysql phpmyadmin workspace 
          (Paciencia la primera vez ya que se esta descargando lo necesario y creando los containers)
          Si todo ha ido bien, para detenerlos, ejecuta:
          => sudo docker-compose stop 
 
  Step-4: Configurando el server
          En ~/laradock/nginx/sites localiza el archivo laravel.conf.example y hazle una copia o renombra el mismo a
          proyecto12.local, cambiando las siguientes lineas:
          -linea 18: server_name proyecto12.local;
          -linea 19: root /var/www/proyecto12/public;
          -linea 47: error_log /var/log/nginx/proyecto12_error.log;
          -linea 48: access_log /var/log/nginx/proyecto12_access.log;
          
  Step-5: En tu S.O. edita el archivo /etc/hosts y añade:
          127.0.0.1            proyecto12.local
 
  Step-6: Clona mi vaina: proyecto12 => git submodule add https://github.com/jayyam/proyecto12.git
          La carpeta laradock y la de proyecto12 han de estar al mismo nivel. (lee mas arriba)
 
  Step-7 Agregando al container de phpmyadmin la base de datos
          En consola levanta otra vez los containers: sudo docker-compose up -d nginx mysql phpmyadmin workspace
          o levanta solo el container de phpmyadmin
          En tu navegador, ve a http://localhost:8081 donde deberia salir la ventana de acceso de phpmyadmin.  
          Accede a phpmyadmin con tus modificaciones realizadas en Step-2
          Crea una nueva base de datos llamada proyecto12 e IMPORTa en ella el contenido de proyecto12.sql que se
          encuentra en mi vaina clonada (proyecto12). Guarda.
          Reinicia los containers: sudo docker-compose stop 
 
  Step-8 Reiniciando los containers: sudo docker-compose up -d nginx mysql phpmyadmin workspace
          En tu navegador ejecuta exactamente http://proyecto12.local (Con https:// secure conection no funciona)
          
          FIN
