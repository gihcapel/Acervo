<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Business Casual - Start Bootstrap Theme</title>

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

    <div class="brand">Acervo Pessoal</div>

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
                <a class="navbar-brand" href="index.html">Business Casual</a>
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
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">
                        <strong>Cadastrar livros no acervo</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-md-6">
                   <form class= "formulario" method="post" enctype="multipart/form-data" action="upload.php">
        
        <table>

            <tr><td><label>ISBN:<br><input type="text" name="ISBN" value="" /></label><br><br></td>
            <td><label>Título:<br><input type="text" name="titulo" value="" /></label><br><br></td></tr> 
            <tr><td><label>Edição:<br><input type="text" name="edicao" value="" /></label><br><br></td>     
            <td><label>Categoria:<br>
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
            </label><br><br></td></tr>
            <tr><td><label>Nome do autor:<br><input type="text" name="nome" value="" /></label><br><br></td>
            <td><label>Nacionalidade:<br>
            		<select name="nacionalidade">
                    <option value="brasileiro"> Brasileiro </option>
                    <option value= "estrangeiro"> Estrangeiro </option>
                </select></td>
              </label><br><br></tr>    
            <tr><td><label>Preço:<br><input type="text" name="preco" value="" /></label><br><br></td>
            <td><label>Ano Publicação:<br><input type="text" name="pub" value="" /></label><br><br></td></tr>
            <tr><td><label>Editora:<br><input type="text" name="editora" value="" /></label><br><br></td></tr>
			<tr><td><label>Imagem da capa:</label><br/> <input name="arquivo" type="file" />
   <br /><br/></td></tr>
        </table>
            <div class="botoes1">
            	<input class="cadastrar" type="submit" value="Cadastrar" name="funcao"/>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

     
    <!-- /.container -->

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

</body>

</html>
