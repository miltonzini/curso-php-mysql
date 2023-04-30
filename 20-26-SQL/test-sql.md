Pasos:
1) Crear base de datos
2) Crear las siguentes tablas
3) Cargar los datos de cada una
4) Hacer la consulta con Inner Join



TABLA 1: usuarios
-----------------------------------------
ID	nombre		apellido	pais        |
1	Lucas		Gómez		Argentina	|	            [admin]
2	Marcos		Pérez		Colombia	|	            [invitado]
3	Luís		Díaz		Uruguay		|	            [cliente]
4	Germán		Blanco		Brasil		|	            [cliente]
5	Ana		    Díaz		Argentina	|               [admin]



TABLA 2: roles
ID	rol
------------
1	admin
2	invitado
3	cliente



TABLA 3: asignacion_roles
ID	    usuarios_id 	roles_id
----------------------------------
1	    1   		    1
2	    2   		    2
3	    3   		    3
4	    4   		    3
5	    5   		    1





# Paso 1
```sql
CREATE DATABASE test_roles_2;
```

# Paso 2
```sql
CREATE TABLE usuarios(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    nombre varchar(20),
    apellido varchar(20),
    pais varchar(15)
);

CREATE TABLE roles(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    rol varchar(20)
);

CREATE TABLE asignacion_roles (
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    usuario_id INT(10) NOT NULL,
    rol_id INT(10) NOT NULL,

    
    FOREIGN KEY fk_usuario_id(usuario_id)
    REFERENCES usuarios(id),
    
    FOREIGN KEY fk_roles_id(rol_id)
    REFERENCES roles(id)
);

```


# Paso 3
```sql
INSERT INTO usuarios (nombre, apellido, pais) VALUES ('Lucas', 'Gómez', 'Argentina');
INSERT INTO usuarios (nombre, apellido, pais) VALUES ('Marcos', 'Pérez', 'Colombia');
INSERT INTO usuarios (nombre, apellido, pais) VALUES ('Luís', 'Díaz', 'Uruguay');
INSERT INTO usuarios (nombre, apellido, pais) VALUES ('Germán', 'Blanco', 'Brasil');
INSERT INTO usuarios (nombre, apellido, pais) VALUES ('Ana', 'Díaz', 'Argentina');

INSERT INTO roles (rol) VALUES ('admin');
INSERT INTO roles (rol) VALUES ('invitado');
INSERT INTO roles (rol) VALUES ('cliente');

INSERT INTO asignacion_roles (usuario_id, rol_id) VALUES (1, 1);
INSERT INTO asignacion_roles (usuario_id, rol_id) VALUES (2, 2);
INSERT INTO asignacion_roles (usuario_id, rol_id) VALUES (3, 3);
INSERT INTO asignacion_roles (usuario_id, rol_id) VALUES (4, 3);
INSERT INTO asignacion_roles (usuario_id, rol_id) VALUES (5, 1);
```


# Paso 4

Consulta (Inner Join):
```sql
SELECT asignacion_roles.id, usuarios.nombre, usuarios.apellido, usuarios.pais, roles.rol FROM asignacion_roles
INNER JOIN usuarios ON asignacion_roles.usuario_id = usuarios.id
INNER JOIN roles ON asignacion_roles.rol_id = roles.id;
```


Esa consulta devuelve

ID  nombre      apellido    pais            rol
---------------------------------------------------
1   Lucas       Gómez       Argentina       admin
5   Ana         Díaz        Argentina       admin
2   Marcos      Pérez       Colombia        invitado
3   Luís        Díaz        Uruguay         cliente
4   Germán      Blanco      Brasil          cliente


[testeado en phpMyAdmin: OK].