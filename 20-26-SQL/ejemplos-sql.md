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
