<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Acervo</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">
    

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

 <ul class="titulo"> 
    <li><div class="brand">Acervo Pessoal</div></li>
    <li><img class="livro" src="img/livro.png"></li>
 </ul>  

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">Acervo</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Ver Livros</a>
                    </li>
                    <li>
                        <a href="cadastro.php">Cadastrar Livros</a>
                    </li>
                    <li>
                        <a href="emprestimos.php">Empréstimos</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
 
    <div class="container">

        <div class="row">

            <div class="box">

                <div class="col-lg-12 text-center">
                <h1 class="brand-name">Seu Acervo</h1>

                <h2 class="brand-before">
                        <small><form class="pesquisar" name="mostrar" method="POST" action= "upload.php">
                            <table ">
                            <!--pesquisa por preço-->
                                <tr><label> 
                                    <td class="pesquisapreco"><select name="pesqp"> 
                                        <option value="30"> Menores de 30 </option>
                                        <option value="30_50"> Entre 30 e 50 </option>
                                        <option value="50"> Maiores de 50 </option>
                                    </select></td>
                                    <td class="pesquisapreco"> <input class="preco" type="submit" value="Mostrar por preço" name="funcao"/></td>
                                </label>
                                <!--pesquisa por categoria-->
                                <label>
                                    <td class="pesquisacateg"><select name="pesqcat">
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
                                    </select></td>
                                    <td class="pesquisacateg"><input class="categoria" type="submit" value="Mostrar por categoria" name="funcao"/></td>
                                    </label></tr>
                            </table>
                            </form></small>
                    </h2>
                     
                    <div id="carousel-example-generic" class="carousel slide">
                                            
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="wall">
							<?php
							$xml = simplexml_load_file('acervo.xml');
							for($i=0; $i<$xml->count(); $i++){
								echo "<fieldset><div class=\"item\"><p class=\"titulo\"> Título: </p><p>".strval($xml->livro[$i]->titulo)."</br></p>";
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
                            </div>
                        </div>
                        
                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="icon-next"></span>
                        </a>
                    </div>
                    
                   
                    <hr class="tagline-divider">
                    
                </div>
            </div>
        </div>


    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>
</html>
