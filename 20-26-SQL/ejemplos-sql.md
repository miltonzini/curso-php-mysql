# SQL: INSERT
INSERT INTO <nombre_tabla> (col1, col2, ... col n)
VALUES (valor1, valor2, ... value n);

Ejemplo: 
```sql
INSERT INTO nombre_tabla (nombre, apellidos, fecha) VALUES ('Juan', 'Pérez', '2023-04-25');
```



# SQL: SELECT
SELECT (col1, col2, ... col n) FROM <nombre_tabla>
Ejemplos: 
```sql
SELECT nombre FROM invitados;
SELECT nombre, apellido FROM invitados;
SELECT * FROM invitados;
SELECT nombre FROM invitados WHERE edad > 18 ORDER BY edad;
SELECT nombre, apellido, fecha_alta FROM invitados WHERE apellido = 'Dominguez' BY edad;
```



# SQL: UPDATE
[en este caso la sentencia WHERE es obligatoria]

UPDATE <nombre_tabla>
SET col1 = valor1, col2 = valor2, ... col n = valor n, 
WHERE condición;

Ejemplos: 
```sql
--cambiar todoas las 'Giulia' o 'Shulia' por 'Julia'
UPDATE invitados SET nombre = 'Julia' WHERE nombre = 'Giulia' OR 'Shulia'; 
--cambiar según ID
UPDATE invitados SET nombre = 'Julia' WHERE ID = 2; 
```



# SQL: DELETE
## Para eliminar filas:
DELETE FROM <nombre_table> WHERE condición.
[Atención que tiene que estar la palabra reservada WHERE, si no se borrarán todos los datos de la tabla (todas las filas, similar a TRUNCATE)]

## Para eliminar Tablas:
DROP TABLE <nombre_table>

## Intermediario
Borrar solo los datos de una tabla, sin borrar asociaciones, triggers, etc.
(vaciar table)
TRUNCATE TABLE <nombre_table>

Ejemplos: 
```sql
-- borrar una fila:
DELETE FROM invitados WHERE ID = 6;

-- evitar esto ("MySQL Workbench", si no me equivoco, lo bloquea por seguridad):
DELETE FROM invitados;

-- vaciar tabla
TRUNCATE TABLE invitados;

-- eliminar tabla
DROP TABLE invitados;

```



# SQL: PRIMARY KEYS
-Es la forma de identificar una columna como exclusiva en sus valores. No pueden tener valores duplicados cuando se ingresan datos. Se usa, por ejemplo, para IDs de usuario o nombres de usuario.

Solo puede existir un Primary Key por tabla y suele ser ID.



# SQL: FOREIGN KEYS
La clave foránea es la que hace referencia a una clave primaria de otra tabla. Ejemplo [alumno_id] en la tabla "alumnos_deporte".

Al crear una nueva tabla puedo agregar la foreign key de la siguiente forma:
CREATE TABLE <nombre_tabla>(
    campo1 TIPO,
    campo2 TIPO,
    FOREIGN KEY nombre_fk(campo2)
    REFERENCES nombre_tabla(columna)
);

Ejemplo: 
(teniendo una tabla de 'usuarios' y otra 'eventos', creo una tercera tabla llamada 'reservas' que las enlaza)
```sql
CREATE TABLE reservas (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    usuario_id INT NOT NULL,
    evento_id INT NOT NULL,

    
    FOREIGN KEY fk_usuario_id(usuario_id)
    REFERENCES usuarios(id),
    
    FOREIGN KEY fk_evento_id(eventos_id)
    REFERENCES eventos(id)
);

```



# SQL: INNER JOIN
[se usa para combinar datos de 2 ó más tablas relacionadas que tienen datos coincidentes en una columna clave. El resultado que devuelve son las filas que tienen coincidencias en amba tablas].

SELECT (col1, col2, ... col n)
FROM <tabla1>
INNER join <tabla 2>
ON tabla1.columna = tabla2.columna.

Ejemplo

tabla USUARIOS
|ID  Nombre      Password
-----------
1   "Carlos"    12345
2   "Lucas"     56789
3   "Pedro"     01234

tabla EVENTOS
ID nombre
------------
1   "CCK Brahms"
2   "Colón Schubert"
3   "CCK Beethoven"

tabla RESERVAS
ID      usuarios_id  eventos_id
--------------------------------
1       1              3
2       2              1
3       3              2   


```sql
SELECT * FROM reservas
INNER JOIN usuarios
ON reservas.usuario_id = usuarios.id;
```

Eso debería devolver:
ID  usuario_id  evento_id   id  nombre      password
--------------------------------------------------------
1   1           3           1   "Carlos"    12345
2   2           1           2   "Lucas"     56789
3   3           2           3   "Pedro"     01234


Otra consulta más específica (usando doble inner join y obteniendo 
sólo ciertos datos combinando una tabla más):

```sql
SELECT reservas.id, usuarios.nombre, eventos.nombre FROM reservas
INNER JOIN usuarios ON reservas.usuario_id = usuarios.id
INNER JOIN eventos ON reservas.evento_id = evento.id;

```

Eso me tiene que devolver algo como:
ID      nombre      nombre
-----------------------------------
1       Carlos      CCK Beethoven
2       Lucas       CCK Brahms
3       Pedro       Colón Schubert
