<?php

	// estabelece conexão com o banco de dados
	$servername = "localhost";
	$username = "root";
	$password = "naousosenha";
	$dbname = "contratos";
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	// verifica se a conexão foi estabelecida corretamente
	if ($conn->connect_error) {
		die("Erro de conexão: " . $conn->connect_error);
	}

	// constrói a consulta SQL
	$sql = "SELECT Tb_banco.nome AS nome_banco, Tb_convenio.verba, Tb_contrato.codigo AS codigo_contrato, Tb_contrato.data_inclusao, Tb_contrato.valor, Tb_contrato.prazo
        FROM Tb_contrato
        INNER JOIN Tb_convenio_servico ON Tb_contrato.convenio_servico = Tb_convenio_servico.codigo
        INNER JOIN Tb_convenio ON Tb_convenio_servico.convenio = Tb_convenio.codigo
        INNER JOIN Tb_banco ON Tb_convenio.banco = Tb_banco.codigo
        ORDER BY Tb_contrato.codigo DESC";

	// executa a consulta e armazena o resultado em $result
	$result = $conn->query($sql);

	// verifica se a consulta retornou algum resultado
	if ($result->num_rows > 0) {
		// percorre cada linha do resultado e exibe os dados na tela
		while($row = $result->fetch_assoc()) {
			echo "Nome do banco: " . $row["nome_banco"] . "<br>";
			echo "Verba: " . $row["verba"] . "<br>";
			echo "Código do contrato: " . $row["codigo_contrato"] . "<br>";
			echo "Data de inclusão: " . $row["data_inclusao"] . "<br>";
			echo "Valor: " . $row["valor"] . "<br>";
			echo "Prazo: " . $row["prazo"] . "<br><br>";
			echo "<hr>";
		}
	} else {
		echo "Não foi encontrado nenhum resultado.";
	}

	// fecha a conexão com o banco de dados
	$conn->close();