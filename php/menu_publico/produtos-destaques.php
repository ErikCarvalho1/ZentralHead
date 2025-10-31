<?php 
include "../class/produtos.php";
$produto = new Produtos();
$produtos = $produto->listar(1); 


$linha = count($produtos);

?>
<section>
<!-- mostra se a consulta retornar vazio  -->
 <?php 
 if($linha == 0){ ?>
<h2 class="alert alert-danger
                ">Não há produtos em destaques</h2>
 <?php } ?>

<?php if($linha > 0 ){?>
<h2 >Produtos Em Destaques</h2>
                <div class="row">
                    <?php  foreach($produtos as $prod):?>
                    <!-- começa o card produto -->
          
                            <!-- começa o card produto -->
                 <div class="col-sm-6 col-md-4 mb-4">
                        <div class="card">
                            <img src="../../images/<?=$prod['imagem_principal'] ?>" style="width:410px; height:400px"
                             alt = "<?=$prod['nome'] ?>"
                              class="card-img-top">
                            <div class="card-body  text-whith">
                                <h3 class="card-title text-danger">
                                    <strong><i><?=$prod['nome']?></i></strong>
                                </h3>
                                
                                <p class="card-text text-start">
                                    <?=mb_strimwidth($prod['descricao_curta'],0,42,'...') ?>
                                </p>
                                </p>
                                <button class="btn btn-default disabled" role="button" style="cursor: default;">
                                    <?="R$ ".number_format($prod['valor_base'],2,',','.')?>

                                </button>
                               
                                <a href="../clientes/pagina_produto.php?id=<?= $prod['id']?>" class="btn btn-primary float-end">
                                    <span class="d-nome d-sm-inline"  >Saiba mais</span>
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                        </div>
                        </div>
                    </div><!-- termina o card produto --> 
                 
                  
                    <?php endforeach;?>
                </div>
                <?php }?>
            </section>