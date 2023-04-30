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


# 23 - SQL: DELETE
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