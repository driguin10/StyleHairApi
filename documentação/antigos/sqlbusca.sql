

sql busca


//--------------------principal----------------------------------------------------


SELECT 
	saloes.idSalao AS 'idSalao', saloes.topicoNotificacao AS 'topicoNotificacao',
	saloes.nome AS 'nome', saloes.endereco AS 'endereco', saloes.numero AS 'numero',
	saloes.complemento AS 'complemento', saloes.cep AS 'cep',saloes.bairro AS 'bairro',
	saloes.cidade AS 'cidade', saloes.estado AS 'estado', saloes.telefone1 AS 'telefone1',
	saloes.telefone2 AS 'telefone2', saloes.cnpj AS 'cnpj', saloes.email AS 'email',
	saloes.sobre AS 'sobre',saloes.linkImagem AS 'linkImagem', saloes.agendamento  AS 'agendamento',
	saloes.latitude AS 'latitude', saloes.longitude AS 'longitude',

(6371 * acos(cos(radians(-30.053831)) * cos(radians(saloes.latitude))
 * cos(radians(saloes.longitude) - radians(-51.191810)) + sin(radians(-30.053831))
 * sin(radians(saloes.latitude)))) AS 'distancia',

	saloes.status AS 'status', avaliacao_salao.pontos AS 'pontos',
	avaliacao_salao.comentario AS 'comentario', avaliacao_salao.data AS 'data',  
	FROM 	saloes
INNER JOIN avaliacao_salao ON avaliacao_salao.idSalao = saloes.idSalao

HAVING distancia < 25
ORDER BY distancia ASC


WHERE
//-------------------------------------------------------------------------------------
	saloes.cidade = 'cidadedapessoa'

	saloes.nome LIKE '%pesquisa%'

	ORDER BY avaliacao_salao.pontos DESC

	







//----------------------------------------------------------

SELECT 
	saloes.idSalao AS 'idSalao', saloes.topicoNotificacao AS 'topicoNotificacao',
	saloes.nome AS 'nome', saloes.endereco AS 'endereco', saloes.numero AS 'numero',
	saloes.complemento AS 'complemento', saloes.cep AS 'cep',saloes.bairro AS 'bairro',
	saloes.cidade AS 'cidade', saloes.estado AS 'estado', saloes.telefone1 AS 'telefone1',
	saloes.telefone2 AS 'telefone2', saloes.cnpj AS 'cnpj', saloes.email AS 'email',
	saloes.sobre AS 'sobre',saloes.linkImagem AS 'linkImagem', saloes.agendamento  AS 'agendamento',
	saloes.latitude AS 'latitude', saloes.longitude AS 'longitude',

(6371 * acos(cos(radians(-20.52717426)) * cos(radians(saloes.latitude))
 * cos(radians(saloes.longitude) - radians(-47.42805847)) + sin(radians(-20.52717426))
 * sin(radians(saloes.latitude)))) AS 'distancia',

	saloes.status AS 'status', avaliacao_salao.pontos AS 'pontos',
	avaliacao_salao.comentario AS 'comentario', avaliacao_salao.data AS 'data' 
	FROM 	saloes
	LEFT JOIN avaliacao_salao ON avaliacao_salao.idSalao = saloes.idSalao
	HAVING distancia < 25
	ORDER BY distancia ASC, pontos DESC; 

	//-------------------------------------

	WHERE 

	saloes.nome LIKE '%pesquisa%'
	saloes.cidade = 'cidadedapessoa'







atualizado 24/04


	SELECT 
	saloes.idSalao AS 'idSalao', saloes.topicoNotificacao AS 'topicoNotificacao',
	saloes.nome AS 'nome', saloes.endereco AS 'endereco', saloes.numero AS 'numero',
	saloes.complemento AS 'complemento', saloes.cep AS 'cep',saloes.bairro AS 'bairro',
	saloes.cidade AS 'cidade', saloes.estado AS 'estado', saloes.telefone1 AS 'telefone1',
	saloes.telefone2 AS 'telefone2', saloes.cnpj AS 'cnpj', saloes.email AS 'email',
	saloes.sobre AS 'sobre',saloes.linkImagem AS 'linkImagem', saloes.agendamento  AS 'agendamento',
	saloes.latitude AS 'latitude', saloes.longitude AS 'longitude',saloes_favoritos.idFavorito AS 'idFavorito',

(6371 * acos(cos(radians(-20.52717426)) * cos(radians(saloes.latitude))
 * cos(radians(saloes.longitude) - radians(-47.42805847)) + sin(radians(-20.52717426))
 * sin(radians(saloes.latitude)))) AS 'distancia',

	saloes.status AS 'status', avaliacao_salao.totalpontos AS 'pontos'
	 
	FROM 	saloes
	(SELECT SUM(pontos) totalpontos FROM avaliacao_salao WHERE avaliacao_salao.idSalao = saloes.idSalao)
  LEFT JOIN saloes_favoritos ON saloes_favoritos.idSalao = saloes.idSalao
	HAVING distancia < 25
	ORDER BY distancia ASC, pontos DESC; 





	SELECT 
	saloes.idSalao AS 'idSalao', saloes.topicoNotificacao AS 'topicoNotificacao',
	saloes.nome AS 'nome', saloes.endereco AS 'endereco', saloes.numero AS 'numero',
	saloes.complemento AS 'complemento', saloes.cep AS 'cep',saloes.bairro AS 'bairro',
	saloes.cidade AS 'cidade', saloes.estado AS 'estado', saloes.telefone1 AS 'telefone1',
	saloes.telefone2 AS 'telefone2', saloes.cnpj AS 'cnpj', saloes.email AS 'email',
	saloes.sobre AS 'sobre',saloes.linkImagem AS 'linkImagem', saloes.agendamento  AS 'agendamento',
	saloes.latitude AS 'latitude', saloes.longitude AS 'longitude',saloes_favoritos.idFavorito AS 'idFavorito',

(6371 * acos(cos(radians(-20.52717426)) * cos(radians(saloes.latitude))
 * cos(radians(saloes.longitude) - radians(-47.42805847)) + sin(radians(-20.52717426))
 * sin(radians(saloes.latitude)))) AS 'distancia',

	saloes.status AS 'status', (SELECT SUM(pontos) totalpontos FROM avaliacao_salao WHERE avaliacao_salao.idSalao = saloes.idSalao) as 'pontos'
	 
	FROM 	saloes
 
  LEFT JOIN saloes_favoritos ON saloes_favoritos.idSalao = saloes.idSalao
	HAVING distancia < 25
	ORDER BY distancia ASC, pontos DESC





	SELECT 
	saloes.idSalao AS 'idSalao', saloes.topicoNotificacao AS 'topicoNotificacao',
	saloes.nome AS 'nome', saloes.endereco AS 'endereco', saloes.numero AS 'numero',
	saloes.complemento AS 'complemento', saloes.cep AS 'cep',saloes.bairro AS 'bairro',
	saloes.cidade AS 'cidade', saloes.estado AS 'estado', saloes.telefone1 AS 'telefone1',
	saloes.telefone2 AS 'telefone2', saloes.cnpj AS 'cnpj', saloes.email AS 'email',
	saloes.sobre AS 'sobre',saloes.linkImagem AS 'linkImagem', saloes.agendamento  AS 'agendamento',
	saloes.latitude AS 'latitude', saloes.longitude AS 'longitude',saloes_favoritos.idFavorito AS 'idFavorito',

(6371 * acos(cos(radians(-20.52717426)) * cos(radians(saloes.latitude))
 * cos(radians(saloes.longitude) - radians(-47.42805847)) + sin(radians(-20.52717426))
 * sin(radians(saloes.latitude)))) AS 'distancia',

	saloes.status AS 'status', (SELECT SUM(pontos) totalpontos FROM avaliacao_salao WHERE avaliacao_salao.idSalao = saloes.idSalao) as 'pontos'
	 
	FROM 	saloes
 
  LEFT JOIN saloes_favoritos ON saloes_favoritos.idSalao = saloes.idSalao
	HAVING distancia < 25
	ORDER BY distancia ASC, pontos DESC