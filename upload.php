<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title></title>
    </head>
<?php
if(isset($_POST['funcao']) && $_POST['funcao']=="Cadastrar"){

        echo cadastra();
        }

        if(isset($_POST['funcao'])&& $_POST['funcao']=="Mostrar todos"){

        mostra();
        }
        if(isset($_POST['funcao'])&& $_POST['funcao']=="Mostrar por preço"){

        mostrapreco();
        }
        if(isset($_POST['funcao'])&& $_POST['funcao']=="Mostrar por categoria"){

        mostracateg();
        }



 function cadastra(){
			
$xml = simplexml_load_file("acervo.xml");
$livro = $xml->addChild('livro');
	if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {
 
    $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
    $nome = $_FILES[ 'arquivo' ][ 'name' ];
 
    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
 
    // Converte a extensão para minúsculo
    $extensao = strtolower ( $extensao );
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) . '.' . $extensao;
 
        // Concatena a pasta com o nome
        $destino = 'C:\\xampp\\htdocs\\Acervo\\Imagens\\'. $novoNome;
 
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
           $livro->addChild('imagem', $novoNome);
		   echo 'Arquivo salvo com sucesso!.<br />';
		   
        }
        else
            echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
    }
    else
        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
}
else
    echo 'Você não enviou nenhum arquivo!';

			
			$livro->addAttribute('ISBN', $_POST['ISBN']);
			$livro->addChild('titulo', $_POST['titulo']);
			$livro->titulo->addAttribute('edicao', $_POST['edicao']);
			$livro->addChild('categoria', $_POST['categoria']);
			$livro->addChild('autores', "");
			$livro->autores->addChild('autor', $_POST['nome']);
			$livro->autores->autor->addAttribute('nacionalidade', $_POST['nacionalidade']);
			$livro->addChild('preco', $_POST['preco']);
			$livro->addChild('anopub', $_POST['pub']);
			$livro->addChild('editora', $_POST['editora']);
			

			
	
			file_put_contents("acervo.xml", $xml->asXML());
			?> 
	<a href= "index.php"> Voltar </a>
	<?php
        
 }
 
        //função para mostrar
        function mostra(){
			$xml = simplexml_load_file('acervo.xml');
			for($i=0; $i<$xml->count(); $i++){
				echo "<fieldset><div class=\"livros\"><p class=\"titulo\"> Título: </p><p>".strval($xml->livro[$i]->titulo)."</br></p>";
						echo "<p class=\"isbn\"> ISBN: ".strval($xml->livro[$i]['ISBN'])."</br></p>";
						echo "<p class=\"edicao\"> Edição: ".strval($xml->livro[$i]->titulo['edicao'])."</br></p>";
						echo "<p class=\"categ\"> Categoria: ".strval($xml->livro[$i]->categoria)."</br></p>";
						echo "<p class=\"autor\"> Autores: ";
					for($j=0; $j<$xml->livro[$i]->autores->count(); $j++){
						echo strval($xml->livro[$i]->autores[$j]->autor);
						echo "(".$xml->livro[$i]->autores[$j]->autor['nacionalidade'].")";           
					}
						echo "<p class=\"valor\"> Preço: ".strval($xml->livro[$i]->preco)."</br></p>";
						echo "<p class=\"publ\"> Ano de Publicação: ".strval($xml->livro[$i]->anopub)."</br></p>";
						echo "<p class=\"editora\"> Editora: ".strval($xml->livro[$i]->editora)."</br></p>";
						echo"</div> <div class=\"foto\"><img src='Imagens\\".strval($xml->livro[$i]->imagem)."'></td>";
						echo "<hr/></div></fieldset>";
						
			}  
			?> 
	<a href= "index.php"> Voltar </a>
	<?php
        }   

        //função para mostrar por preço
        function mostrapreco(){
			$xml = simplexml_load_file('acervo.xml');
			if (isset ($_POST['pesqp'])){
				$valor= $_POST['pesqp'];
			}
			for($i=0; $i<$xml->count(); $i++){
				$preco=floatval($xml->livro[$i]->preco->__toString());
				if ($valor == '30'){
					if($preco < 30){
						echo "<fieldset><div class=\"livros\"><p class=\"titulo\"> Título: ".strval($xml->livro[$i]->titulo)."</br></p>";
						echo "<p class=\"isbn\"> ISBN: ".strval($xml->livro[$i]['ISBN'])."</br></p>";
						echo "<p class=\"edicao\"> Edição: ".strval($xml->livro[$i]->titulo['edicao'])."</br></p>";
						echo "<p class=\"categ\"> Categoria: ".strval($xml->livro[$i]->categoria)."</br></p>";
						echo "<p class=\"autor\"> Autores: ";
					for($j=0; $j<$xml->livro[$i]->autores->count(); $j++){
						echo strval($xml->livro[$i]->autores[$j]->autor);
						echo "(".$xml->livro[$i]->autores[$j]->autor['nacionalidade'].")";           
					}
						echo "<p class=\"valor\"> Preço: ".strval($xml->livro[$i]->preco)."</br></p>";
						echo "<p class=\"publ\"> Ano de Publicação: ".strval($xml->livro[$i]->anopub)."</br></p>";
						echo "<p class=\"editora\"> Editora: ".strval($xml->livro[$i]->editora)."</br></p>";
						echo"</div> <div class=\"foto\"><img src='Imagens\\".strval($xml->livro[$i]->imagem)."'></td>";
						echo "<hr/></div></fieldset>";
						
					}
				}
				if ($valor == '30_50'){
					if($preco >= 30 && $preco <=50){
						echo "<fieldset><div class=\"livros\"><p class=\"titulo\"> Título: ".strval($xml->livro[$i]->titulo)."</br></p>";
						echo "<p class=\"isbn\"> ISBN: ".strval($xml->livro[$i]['ISBN'])."</br></p>";
						echo "<p class=\"edicao\"> Edição: ".strval($xml->livro[$i]->titulo['edicao'])."</br></p>";
						echo "<p class=\"categ\"> Categoria: ".strval($xml->livro[$i]->categoria)."</br></p>";
						echo "<p class=\"autor\"> Autores: ";
					for($j=0; $j<$xml->livro[$i]->autores->count(); $j++){
						echo strval($xml->livro[$i]->autores[$j]->autor);
						echo "(".$xml->livro[$i]->autores[$j]->autor['nacionalidade'].")";           
					}
						echo "<p class=\"valor\"> Preço: ".strval($xml->livro[$i]->preco)."</br></p>";
						echo "<p class=\"publ\"> Ano de Publicação: ".strval($xml->livro[$i]->anopub)."</br></p>";
						echo "<p class=\"editora\"> Editora: ".strval($xml->livro[$i]->editora)."</br></p>";
						echo"</div> <div class=\"foto\"><img src='Imagens\\".strval($xml->livro[$i]->imagem)."'></td>";
						echo "<hr/></div></fieldset>";
					}
				}
				else{
					if($preco >= 51){
						echo "<fieldset><div class=\"livros\"><p class=\"titulo\"> Título: ".strval($xml->livro[$i]->titulo)."</br></p>";
						echo "<p class=\"isbn\"> ISBN: ".strval($xml->livro[$i]['ISBN'])."</br></p>";
						echo "<p class=\"edicao\"> Edição: ".strval($xml->livro[$i]->titulo['edicao'])."</br></p>";
						echo "<p class=\"categ\"> Categoria: ".strval($xml->livro[$i]->categoria)."</br></p>";
						echo "<p class=\"autor\"> Autores: ";
					for($j=0; $j<$xml->livro[$i]->autores->count(); $j++){
						echo strval($xml->livro[$i]->autores[$j]->autor);
						echo "(".$xml->livro[$i]->autores[$j]->autor['nacionalidade'].")";           
					}
						echo "<p class=\"valor\"> Preço: ".strval($xml->livro[$i]->preco)."</br></p>";
						echo "<p class=\"publ\"> Ano de Publicação: ".strval($xml->livro[$i]->anopub)."</br></p>";
						echo "<p class=\"editora\"> Editora: ".strval($xml->livro[$i]->editora)."</br></p>";
						echo"</div> <div class=\"foto\"><img src='Imagens\\".strval($xml->livro[$i]->imagem)."'></td>";
						echo "<hr/></div></fieldset>";

					}
				}
			}
			?> 
	<a href= "index.php"> Voltar </a>
	<?php
        }   

        //função para mostrar por categoria
        function mostracateg(){
			$xml = simplexml_load_file('acervo.xml');
			if (isset ($_POST['pesqcat'])){
				$categ= $_POST['pesqcat'];

				for($i=0; $i<$xml->count(); $i++){
					$categoria=($xml->livro[$i]->categoria);
					if ($categ == $categoria){
						echo "<fieldset><div class=\"livros\"><p class=\"titulo\"> Título: ".strval($xml->livro[$i]->titulo)."</br></p>";
						echo "<p class=\"isbn\"> ISBN: ".strval($xml->livro[$i]['ISBN'])."</br></p>";
						echo "<p class=\"edicao\"> Edição: ".strval($xml->livro[$i]->titulo['edicao'])."</br></p>";
						echo "<p class=\"categ\"> Categoria: ".strval($xml->livro[$i]->categoria)."</br></p>";
						echo "<p class=\"autor\"> Autores: ";
					for($j=0; $j<$xml->livro[$i]->autores->count(); $j++){
						echo strval($xml->livro[$i]->autores[$j]->autor);
						echo "(".$xml->livro[$i]->autores[$j]->autor['nacionalidade'].")";           
					}
						echo "<p class=\"valor\"> Preço: ".strval($xml->livro[$i]->preco)."</br></p>";
						echo "<p class=\"publ\"> Ano de Publicação: ".strval($xml->livro[$i]->anopub)."</br></p>";
						echo "<p class=\"editora\"> Editora: ".strval($xml->livro[$i]->editora)."</br></p>";
						echo"</div> <div class=\"foto\"><img src='Imagens\\".strval($xml->livro[$i]->imagem)."'></td>";
						echo "<hr/></div></fieldset>";
						
					}  
				} 
?> 
						<a href= "index.php"> Voltar </a>
						<?php				
			}
        }
       
?>
<html>