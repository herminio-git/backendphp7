<?php
include('conexao.php');
?>

<!DOCTYPE html>
<html>
<head>

    <title>Clientes</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/button-icons.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
 
        <a class="navbar-brand" href="painel_funcionario.php"><big><big><i class="fa fa-arrow-left"></i></big></big></a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">

            <ul class="navbar-nav mr-auto"></ul>

            <form class="form-inline my-2 my-lg-0 mr-5">
                <input name="txtCpfPesquisar" id="txtCpfPesquisar" class="form-control mr-sm-2" type="search" placeholder="Buscar pelo CPF" aria-label="Pesquisar">
                <button name="buttonCpfPesquisar" class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
            </form>

            <form class="form-inline my-2 my-lg-0">

                <input name="txtpesquisar" class="form-control mr-sm-2" type="search" placeholder="Buscar pelo Nome" aria-label="Pesquisar">

                <button name="buttonPesquisar" class="btn btn-outline-success my-2 my-sm-0" type="submit">
                    <i class="fa fa-search"></i>
                </button>

            </form>

        </div>
    </nav>





    <div class="container"><br>

    <div class="row">
        <div class="col-sm-12">

            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalCadastrar">
                Inserir Novo 
            </button>

        </div>

          
    </div>

          <div class="content">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title"> Tabela de Clientes</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">

                    <!-- LISTAR - PESQUISAR - MÉTODO -->

                    <?php

                        if(isset($_GET['buttonPesquisar']) and $_GET['txtpesquisar'] != ''){
                            $nome = $_GET['txtpesquisar'] . '%';
                            $query = "SELECT * FROM tb_clientes WHERE db_nome LIKE '$nome'  ORDER BY db_nome ASC"; 
                        
                        }else if(isset($_GET['buttonCpfPesquisar']) and $_GET['txtCpfPesquisar'] != ''){
                            $nome = $_GET['txtCpfPesquisar'];
                            $query = "SELECT * FROM tb_clientes WHERE db_cpf = '$nome' ORDER BY db_nome ASC"; 
                        
                        }else{ 
                            $query = "SELECT * FROM tb_clientes ORDER BY db_nome ASC";

                        }

                        $result = mysqli_query($conexao, $query);
                        //$dado = mysqli_fetch_array($result);
                        $row = mysqli_num_rows($result);

                        if($row == ''){

                            echo "<h4> Não existem registros cadastrados ! </h4>"; 
                            echo "<script language='javascript'> window.location='clientes.php'; </script>";
                        }else{  ?>

                                    <table class="table">
                                        <thead class=" text-primary">

                                            <th>Nome</th>
                                            <th>Telefone</th>
                                            <th>Endereço</th>
                                            <th>Email</th>
                                            <th>CPF</th>
                                            <th>Data</th>
                                            <th>Ações</th>

                                        </thead>
                                        <tbody>
                                        
                                        <?php 

                                            while($res_1 = mysqli_fetch_array($result)){
                                                
                                                $nome = $res_1["db_nome"];
                                                $telefone = $res_1["db_telefone"];
                                                $endereco = $res_1["db_endereco"];
                                                $email = $res_1["db_email"];
                                                $cpf = $res_1["db_cpf"];
                                                $data = $res_1["db_data"];
                                                $id = $res_1["db_id"];
                                                
                                                // Colocando a amostragem da data no padrão pt-br
                                                // "implode" para substituir '/' por '-' 
                                                $data2 = implode('/', array_reverse(explode('-', $data)));

                                                ?>

                                                <tr>
                                                    <td><?php echo $nome; ?></td> 
                                                    <td><?php echo $telefone; ?></td>
                                                    <td><?php echo $endereco; ?></td>
                                                    <td><?php echo $email; ?></td>
                                                    <td><?php echo $cpf; ?></td>
                                                    <td><?php echo $data2; ?></td>

                                                    <td>
                                                        <!-- <a class="btn btn-info" href="clientes.php?func=edita&id=<?php echo $id; ?>"><i class="fa fa-pencil-square-o"></i></a> -->
                                                        <!-- <a class="btn btn-danger" href="clientes.php?func=deleta&id=<?php echo $id; ?>"><i class="fa fa-minus-square"></i></a> -->

                                                        <a href="#" rel="tooltip" title="Visualizar Perfil" class="btn btn-link btn-xs">
                                                            <i class="fa fa-user"></i>
                                                        </a>

                                                        <a href="clientes.php?func=edita&db_id=<?php echo $id; ?>" rel="tooltip" title="Editar Perfil" class="btn btn-link btn-xs">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <a href="clientes.php?func=deleta&db_id=<?php echo $id; ?>" rel="tooltip" title="Remover" class="btn btn-link btn-xs">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                        
                                                    </td>

                                                </tr>

                                            <?php 
                                            }                        
                                            ?>
                                                

                                        </tbody>
                                    </table>
                            <?php }  ?>

                    </div>
                  </div>
                </div>
              </div>

    </div>




    <!-- Modal - CADASTRAR -->
    <div id="modalCadastrar" class="modal fade" role="dialog">
        <div class="modal-dialog">
             <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
              
                    <h4 class="modal-title">Clientes</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <div class="modal-body">
                    <form method="POST" action="">

                        <div class="form-group">
                            <label for="nomeCadastrar">Nome</label>
                            <input type="text" class="form-control mr-2" name="txtNomeCadastrar" placeholder="Nome..." required>
                        </div>

                        <div class="form-group">
                            <label for="sobrenomeCadastrar">Sobrenome</label>
                            <input type="text" class="form-control mr-2" name="txtSobrenomeCadastrar" placeholder="Sobrenome..." required>
                        </div>

                        <div class="form-group">
                            <label for="telefoneCadastrar">Telefone</label>
                            <input type="text" class="form-control mr-2" name="txtTelefoneCadastrar" id="telefoneCadastrar" placeholder="Telefone..." required>
                        </div>

                        <div class="form-group">
                            <label for="enderecoCadastrar">Endereço</label>
                            <input type="text" class="form-control mr-2" name="txtEnderecoCadastrar" placeholder="Endereço..." required>
                        </div>

                        <div class="form-group">
                            <label for="emailCadastrar">Email</label>
                            <input type="email" class="form-control mr-2" name="txtEmailCadastrar" placeholder="Email..." required>
                        </div>

                        <div class="form-group">
                            <label for="cpfCadastrar">CPF</label>
                            <input type="text" class="form-control mr-2" name="txtCpfCadastrar" id="cpfCadastrar" placeholder="CPF..." required>
                        </div>

                        <!-- </div> -->
                            
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-success mb-3" name="buttonCadastrar" id="buttonCadastrar">Salvar </button>
                            <button type="button" class="btn btn-danger mb-3" data-dismiss="modal">Cancelar </button>

                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>    
    <!-- End - Modal - CADASTRAR-->


</body>
</html>




<!-- CADASTRAR - MÉTODO -->
<?php
    if(isset($_POST['buttonCadastrar'])){
        $nome = $_POST['txtNomeCadastrar'];
        $sobrenome = $_POST['txtSobrenomeCadastrar'];
        $telefone = $_POST['txtTelefoneCadastrar'];
        $endereco = $_POST['txtEnderecoCadastrar'];
        $email = $_POST['txtEmailCadastrar'];
        $cpf = $_POST['txtCpfCadastrar'];


        /*** VERIFICANDO SE O CPF JÁ ESTÁ CADASTRADO ***/
        $query_verificar = "SELECT * FROM tb_clientes WHERE db_cpf = '$cpf' ";

        $result_verificar = mysqli_query($conexao, $query_verificar);
        $row_verificar = mysqli_num_rows($result_verificar);

        if($row_verificar > 0){
        echo "<script language='javascript'> window.alert('CPF já Cadastrado!'); </script>";
        echo "<script language='javascript'> window.location='clientes.php'; </script>";
        exit();
        }
        /*** End - VERIFICANDO SE O CPF JÁ ESTÁ CADASTRADO ***/

        $query = "INSERT INTO tb_clientes (db_nome, db_sobrenome, db_telefone, db_endereco, db_email, db_cpf, db_data) VALUES ('$nome', '$sobrenome', '$telefone', '$endereco', '$email', '$cpf', curDate() )";

        $result = mysqli_query($conexao, $query); 

            if($result == ''){ 
                echo "<script language='javascript'> window.alert('Ocorreu um erro ao Cadastrar! '); </script>";
                var_dump($result); exit();
            }else{
                echo "<script language='javascript'> window.alert('Salvo com Sucesso!'); </script>";
                echo "<script language='javascript'> window.location='clientes.php'; </script>";
        }

    }
?>
<!-- End - CADASTRAR - MÉTODO -->

<!-- ******************************************************** -->
<!-- ******************************************************** -->

<!-- EXCLUIR - MÉTODO -->
<?php

    if(@$_GET['func'] == 'deleta'){
    $id = $_GET['db_id'];
        // echo "<script language='javascript'> window.alert('Deseja Excluir!!'); </script>";
    $query = "DELETE FROM tb_clientes WHERE db_id = '$id'";

    mysqli_query($conexao, $query);
        echo "<script language='javascript'> window.location='clientes.php'; </script>";
    }
?>
<!-- End - EXCLUIR - MÉTODO -->

<!-- ******************************************************** -->
<!-- ******************************************************** -->


<!-- EDITAR - MÉTODO -->
<?php

    if(@$_GET['func'] == 'edita'){  
    $id = $_GET['db_id'];
    $query = "SELECT * FROM tb_clientes WHERE db_id = '$id'";
    $result = mysqli_query($conexao, $query);

    while($res_1 = mysqli_fetch_array($result)){

?>
<!-- End - EDITAR - MÉTODO -->

    <!-- Modal EDITAR -->
    <div id="modalEditar" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Clientes</h4>

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>

                <div class="modal-body">
                    <form method="POST" action="">

                        <div class="form-group">
                            <label for="nomeEditar">Nome</label>
                                <input type="text" class="form-control mr-2" name="txtNomeEditar" placeholder="Nome" 
                                    value="<?php echo $res_1['db_nome']; ?>" 
                                required>
                        </div>

                        <div class="form-group">
                            <label for="sobrenomeEditar">Sobrenome</label>
                                <input type="text" class="form-control mr-2" name="txtSobrenomeEditar" placeholder="Sobrenome..." 
                                    value="<?php echo $res_1['db_sobrenome']; ?>" 
                                required>
                        </div>


                        <div class="form-group">
                            <label for="telefoneEditar">Telefone</label>
                                <input type="text" class="form-control mr-2" name="txtTelefoneEditar" id="telefoneEditar" placeholder="Telefone" 
                                    value="<?php echo $res_1['db_telefone']; ?>" 
                                required>
                        </div>

                        <div class="form-group">
                            <label for="enderecoEditar">Endereço</label>
                                <input type="text" class="form-control mr-2" name="txtEnderecoEditar" placeholder="Endereço" 
                                    value="<?php echo $res_1['db_endereco']; ?>" 
                                required>
                        </div>

                        <div class="form-group">
                            <label for="emailEditar">Email</label>
                                <input type="email" class="form-control mr-2" name="txtEmailEditar" placeholder="Email" 
                                    value="<?php echo $res_1['db_email']; ?>" 
                                required>
                        </div>

                        <div class="form-group">
                            <label for="cpfEditar">CPF</label>
                                <input type="text" class="form-control mr-2" name="txtCpfEditar" id="cpfEditar" placeholder="CPF" 
                                    value="<?php echo $res_1['db_cpf']; ?>" 
                                required>
                        </div>

                     <!-- </div> -->
                   
                        <div class="modal-footer">

                        <button type="submit" class="btn btn-success mb-3" name="buttonEditar">Salvar </button>

                        <button type="button" class="btn btn-danger mb-3" data-dismiss="modal">Cancelar </button>

                    </form>
                </div>
            </div>
        </div>
    </div>    
    <!-- End - Modal EDITAR -->    
 
<!-- Chamando modal via script do jquery -->
<script> $("#modalEditar").modal("show"); </script> 
<!-- End - Chamando modal via script do jquery -->

<!-- ******************************************************** -->
<!-- ******************************************************** -->


<!-- UPDATE - MÉTODO -->
<!-- Comando para editar os dados -->
<?php
    if(isset($_POST['buttonEditar'])){
        $nome = $_POST['txtNomeEditar'];
        $sobrenome = $_POST['txtSobrenomeEditar'];
        $telefone = $_POST['txtTelefoneEditar'];
        $endereco = $_POST['txtEnderecoEditar'];
        $email = $_POST['txtEmailEditar'];
        $cpf = $_POST['txtCpfEditar'];

        // MÉTODO - VERIFICANDO SE O CPF JÁ ESTÁ CADASTRADO PARA UPDDATE
        if ($res_1['db_cpf'] != $cpf){
   
            $query_verificar = "SELECT * FROM tb_clientes WHERE db_cpf = '$cpf' ";

            $result_verificar = mysqli_query($conexao, $query_verificar);
            $row_verificar = mysqli_num_rows($result_verificar);

            if($row_verificar > 0){
            echo "<script language='javascript'> window.alert('CPF já Cadastrado!'); </script>";
            exit();
            }

        }// End - MÉTODO - VERIFICANDO SE O CPF JÁ ESTÁ CADASTRADO PARA UPDDATE

        $query_editar = "UPDATE tb_clientes SET db_nome = '$nome', db_sobrenome = '$sobrenome', db_telefone = '$telefone', db_endereco = '$endereco', db_email = '$email', db_cpf = '$cpf' WHERE db_id = '$id' ";

        $result_editar = mysqli_query($conexao, $query_editar);

        if($result_editar == ''){
            echo "<script language='javascript'> window.alert('Ocorreu um erro ao Editar!'); </script>";
            }else{
                echo "<script language='javascript'> window.alert('Editado com Sucesso!'); </script>";
                echo "<script language='javascript'> window.location='clientes.php'; </script>";
            }

    }
?>


<?php } }  ?>
<!-- End - UPDATE - MÉTODO -->

<!-- ******************************************************** -->
<!-- ******************************************************** -->


<!-- MASCARAS -->
<!-- JQUERY --> 

<script type="text/javascript">
    $(document).ready(function(){

      $('#txtCpfPesquisar').mask('000.000.000-00');  

      $('#telefoneCadastrar').mask('(00) 00000-0000');
      $('#cpfCadastrar').mask('000.000.000-00');

      $('#telefoneEditar').mask('(00) 00000-0000');
      $('#cpfEditar').mask('000.000.000-00');
      });
</script>

<!-- End - MASCARAS -->
