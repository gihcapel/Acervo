<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <form name="registro" method="GET">

            <label>ISBN:<input type="text" name="ISBN" value="" /></label><br><br>
            <label>Título:<input type="text" name="titulo" value="" /></label><br><br>
            <label>Edicao:<input type="text" name="edicao" value="" /></label><br><br>
            <label>Categoria:
                <select name="categoria">
                    <option value="romance">Romance </option>
                    <option value="ficcao">Ficção </option>
                    <option value="fantasia">Fantasia </option>
                    <option value="terror">Terror </option>
                    <option value="suspense">Suspense </option>
                    <option value="infatil">Infantil </option>
                    <option value="didatico">Didático</option>
                    <option value="autoajuda">Auto Ajuda </option>
                    <option value="biografia">Biografia </option>
                    <option value="religiao">Religião </option>
                </select>
            </label><br><br>
            <label>Nome do autor:<input type="text" name="nome" value="" /></label><br><br>
            <label>Nacionalidade:
                <select name="nacionalidade">
                    <option value="brasileiro"> Brasileiro </option>
                    <option value= "estrangeiro"> Estrangeiro </option>
                </select>
            </label><br><br>
            <label>Preço:<input type="text" name="preco" value="" /></label><br><br>
            <label>Ano Publicação:<input type="text" name="pub" value="" /></label><br><br>
            <label>Editora:<input type="text" name="editora" value="" /></label><br><br>
            <form name="usr" enctype="multipart/form-data" method="post" action="upload.php">
                <table border="0" cellpadding="5" cellspacing="5">
                    <tr>
                        <td height="30"><b>Arquivo:</b></td>
                        <td height="30" >
                            <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                            <input type="FILE" name="ARQUIVO" size="50">
                            <input type="submit"  value=" Enviar">
                        </td>
                    </tr>
                </table>
            </form>

            <input type="submit" value="Cadastrar" name="funcao"/>
            <input type="submit" value="Mostrar" name="funcao"/>
        </form>

        <form name="mostrar" method="GET">
            <label> 
                <select name="pesqp"> 
                    <option value="30"> Menores de 30 </option>
                    <option value="30_50"> Entre 30 e 50 </option>
                    <option value="50"> Maiores de 50 </option>
                </select>
                <input type="submit" value="Mostrar por preço" name="funcao"/>
            </label>
            <label>
                <select name="pesqcat">
                    <option value="romance">Romance </option>
                    <option value="ficcao">Ficção </option>
                    <option value="fantasia">Fantasia </option>
                    <option value="terror">Terror </option>
                    <option value="suspense">Suspense </option>
                    <option value="infatil">Infantil </option>
                    <option value="didatico">Didático</option>
                    <option value="autoajuda">Auto Ajuda </option>
                    <option value="biografia">Biografia </option>
                    <option value="religiao">Religião </option>
                </select>
                <input type="submit" value="Mostrar por categoria" name="funcao"/>
        </form>



        <?php


        if(isset($_GET['funcao']) && $_GET['funcao']=="Cadastrar"){

        echo cadastra();
        }

        if(isset($_GET['funcao'])&& $_GET['funcao']=="Mostrar"){

        mostra();
        }
        if(isset($_GET['funcao'])&& $_GET['funcao']=="Mostrar por preço"){

        mostrapreco();
        }
        if(isset($_GET['funcao'])&& $_GET['funcao']=="Mostrar por categoria"){

        mostracateg();
        }

        $tamanho_maximo = 100000; // em bytes
        $tipos_aceitos = array("image/gif","image/jpeg","image/png","image/bmp");
        // Valida o arquivo enviado
        if (isset($_FILES['ARQUIVO'])){
			$arquivo = $_FILES['ARQUIVO'];

        if($arquivo['error'] != 0) {
        echo '<p><b><font color="red">Erro no Upload do arquivo<br>';
        switch($arquivo['erro']) {
        case  UPLOAD_ERR_INI_SIZE:
        echo 'O Arquivo excede o tamanho máximo permitido';
        break;
        case UPLOAD_ERR_FORM_SIZE:
        echo 'O Arquivo enviado é muito grande';
        break;
        case  UPLOAD_ERR_PARTIAL:
        echo 'O upload não foi completo';
        break;
        case UPLOAD_ERR_NO_FILE:
        echo 'Nenhum arquivo foi informado para upload';	
        break;
        }
        echo	'</font></b></p>';
        exit;
        }
        if($arquivo['size']==0 OR $arquivo['tmp_name']==NULL) {
        echo '<p><b><font color="red">Nenhum arquivo enviado
        </font></b></p>';
        exit;
        }
        if($arquivo['size']>$tamanho_maximo) {
        echo '<p><b><font color="red">O Arquivo enviado é muito grande
        (Tamanho Máximo = ' . $tamaho_maximo .	'</font></b></p>';
        exit;
        }
        if(array_search($arquivo['type'],$tipos_aceitos)===FALSE) {
        echo '<p><b><font color="red">O Arquivo enviado não é do tipo (' . 
        $arquivo['type'] . ') aceito para upload. 
        Os Tipos Aceitos São:	</font></b></p>';
        echo '<pre>';
        print_r($tipos_aceitos);
        echo '</pre>';
        exit;
        }
        // Copia o arquivo enviado
        $destino = 'C:\\xampp\\htdocs\\Acervo\\Imagens\\'.$arquivo['name'];
        if(move_uploaded_file($arquivo['tmp_name'],$destino)) {
        // Mostramos  
        echo  '<p><font color="navy"><b>';
        echo 'O Arquivo foi carregado com sucesso!</b></font></p>';
        echo '<img src= "Imagens\\'.$arquivo['name']. '" border=0>';
        }
        else {
        echo '<p><b><font color="red">Ocorreu um erro durante o upload </font></b></p>';
        }
        }

        function cadastra(){
			$xml = simplexml_load_file("acervo.xml");

			$livro = $xml->addChild('livro');
			$livro->addAttribute('ISBN', $_GET['ISBN']);
			$livro->addChild('titulo', $_GET['titulo']);
			$livro->titulo->addAttribute('edicao', $_GET['edicao']);
			$livro->addChild('categoria', $_GET['categoria']);
			$livro->addChild('autores', "");
			$livro->autores->addChild('autor', $_GET['nome']);
			$livro->autores->autor->addAttribute('nacionalidade', $_GET['nacionalidade']);
			$livro->addChild('preco', $_GET['preco']);
			$livro->addChild('anopub', $_GET['pub']);
			$livro->addChild('editora', $_GET['editora']);


			file_put_contents("acervo.xml", $xml->asXML());
        }


        function mostra(){
			$xml = simplexml_load_file('acervo.xml');
			for($i=0; $i<$xml->count(); $i++){
				echo "<p> Título: ".strval($xml->livro[$i]->titulo)."</br></p>";
				echo "<p> ISBN: ".strval($xml->livro[$i]['ISBN'])."</br></p>";
				echo "<p> Edição: ".strval($xml->livro[$i]->titulo['edicao'])."</br></p>";
				echo "<p> Categoria: ".strval($xml->livro[$i]->categoria)."</br></p>";
				echo "<p> Autores: ";
					for($j=0; $j<$xml->livro[$i]->autores->count(); $j++){
						echo strval($xml->livro[$i]->autores[$j]->autor);
						echo "(".$xml->livro[$i]->autores[$j]->autor['nacionalidade'].")";           
					}
				echo "<p> Preço: ".strval($xml->livro[$i]->preco)."</br></p>";
				echo "<p> Ano de Publicação: ".strval($xml->livro[$i]->anopub)."</br></p>";
				echo "<p> Editora: ".strval($xml->livro[$i]->editora)."</br></p>";
				echo "<hr/>";
			}  
        }   

        function mostrapreco(){
			$xml = simplexml_load_file('acervo.xml');
			if (isset ($_GET['pesqp'])){
				$valor= $_GET['pesqp'];
			}
			for($i=0; $i<$xml->count(); $i++){
				$preco=floatval($xml->livro[$i]->preco->__toString());
				if ($valor == '30'){
					if($preco <= 30){
						echo "<p> Título: ".strval($xml->livro[$i]->titulo)."</br></p>";
						echo "<p> ISBN: ".strval($xml->livro[$i]['ISBN'])."</br></p>";
						echo "<p> Edição: ".strval($xml->livro[$i]->titulo['edicao'])."</br></p>";
						echo "<p> Categoria: ".strval($xml->livro[$i]->categoria)."</br></p>";
						echo "<p> Autores: ";
						for($j=0; $j<$xml->livro[$i]->autores->count(); $j++){
							echo strval($xml->livro[$i]->autores[$j]->autor);
							echo "(".$xml->livro[$i]->autores[$j]->autor['nacionalidade'].")";           
						}
						echo "<p> Preço: ".strval($xml->livro[$i]->preco)."</br></p>";
						echo "<p> Ano de Publicação: ".strval($xml->livro[$i]->anopub)."</br></p>";
						echo "<p> Editora: ".strval($xml->livro[$i]->editora)."</br></p>";
						echo "<hr/>";
					}
				}
				if ($valor == '30_50'){
					if($preco >= 31 && $preco <=50){
							echo "<p> Título: ".strval($xml->livro[$i]->titulo)."</br></p>";
							echo "<p> ISBN: ".strval($xml->livro[$i]['ISBN'])."</br></p>";
							echo "<p> Edição: ".strval($xml->livro[$i]->titulo['edicao'])."</br></p>";
							echo "<p> Categoria: ".strval($xml->livro[$i]->categoria)."</br></p>";
							echo "<p> Autores: ";
							for($j=0; $j<$xml->livro[$i]->autores->count(); $j++){
								echo strval($xml->livro[$i]->autores[$j]->autor);
								echo "(".$xml->livro[$i]->autores[$j]->autor['nacionalidade'].")";           
							}
							echo "<p> Preço: ".strval($xml->livro[$i]->preco)."</br></p>";
							echo "<p> Ano de Publicação: ".strval($xml->livro[$i]->anopub)."</br></p>";
							echo "<p> Editora: ".strval($xml->livro[$i]->editora)."</br></p>";
							echo "<hr/>";

					}
				}
				else{
					if($preco >= 51){
						echo "<p> Título: ".strval($xml->livro[$i]->titulo)."</br></p>";
						echo "<p> ISBN: ".strval($xml->livro[$i]['ISBN'])."</br></p>";
						echo "<p> Edição: ".strval($xml->livro[$i]->titulo['edicao'])."</br></p>";
						echo "<p> Categoria: ".strval($xml->livro[$i]->categoria)."</br></p>";
						echo "<p> Autores: ";
						for($j=0; $j<$xml->livro[$i]->autores->count(); $j++){
							echo strval($xml->livro[$i]->autores[$j]->autor);
							echo "(".$xml->livro[$i]->autores[$j]->autor['nacionalidade'].")";           
						}
						echo "<p> Preço: ".strval($xml->livro[$i]->preco)."</br></p>";
						echo "<p> Ano de Publicação: ".strval($xml->livro[$i]->anopub)."</br></p>";
						echo "<p> Editora: ".strval($xml->livro[$i]->editora)."</br></p>";
						echo "<hr/>";

					}
				}
			}
        }   

        function mostracateg(){
			$xml = simplexml_load_file('acervo.xml');
			if (isset ($_GET['pesqcat'])){
				$categ= $_GET['pesqcat'];

				for($i=0; $i<$xml->count(); $i++){
					$categoria=($xml->livro[$i]->categoria);
					if ($categ == $categoria){
						echo "<p> Título: ".strval($xml->livro[$i]->titulo)."</br></p>";
						echo "<p> ISBN: ".strval($xml->livro[$i]['ISBN'])."</br></p>";
						echo "<p> Edição: ".strval($xml->livro[$i]->titulo['edicao'])."</br></p>";
						echo "<p> Categoria: ".strval($xml->livro[$i]->categoria)."</br></p>";
						echo "<p> Autores: ";
						for($j=0; $j<$xml->livro[$i]->autores->count(); $j++){
							echo strval($xml->livro[$i]->autores[$j]->autor);
							echo "(".$xml->livro[$i]->autores[$j]->autor['nacionalidade'].")";           
						}
						echo "<p> Preço: ".strval($xml->livro[$i]->preco)."</br></p>";
						echo "<p> Ano de Publicação: ".strval($xml->livro[$i]->anopub)."</br></p>";
						echo "<p> Editora: ".strval($xml->livro[$i]->editora)."</br></p>";
						echo "<hr/>";
					}  
				}  
			}
        }
        ?>
    </body>
</html>