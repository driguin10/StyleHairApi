





SELECT 
	funcionarios.idFuncionario AS 'idFuncionario',
	saloes.idSalao AS 'idSalao'
FROM 
	usuarios
LEFT JOIN saloes ON usuarios.idUsuario = saloes.idUsuario
LEFT JOIN funcionarios ON usuarios.idUsuario = funcionarios.idUsuario
WHERE
	usuarios.idUsuario = 5
AND	usuarios.idUsuario IN(SELECT funcionarios.idUsuario FROM funcionarios)
AND usuarios.idUsuario IN(SELECT saloes.idUsuario FROM saloes)


SELECT 
	funcionarios.idFuncionario AS 'idFuncionario',
	saloes.idSalao AS 'idSalao'
FROM 
	usuarios
INNER JOIN saloes ON usuarios.idUsuario = saloes.idUsuario
INNER JOIN funcionarios ON usuarios.idUsuario = funcionarios.idUsuario
WHERE
	usuarios.idUsuario = 5

/----------------------------------------------

https://pt.stackoverflow.com/questions/9128/como-obter-dist%C3%A2ncia-dadas-as-coordenadas-usando-sql
https://www.sunearthtools.com/pt/tools/distance.php
https://developers.google.com/maps/documentation/javascript/mysql-to-maps?hl=pt-br
http://www.phpit.com.br/artigos/como-procurar-locais-proximos-usando-sql.phpit