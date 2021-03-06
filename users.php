<?php // include db connect class
require_once __DIR__ . '/header.php'; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Utilisateurs</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="well">
                                <a href="add_user" class="btn btn-primary btn-lg btn-block">Ajouter utilisateur</a>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Liste des utilisateurs
                        </div>
                        <!-- /.panel-heading -->
                        
                                <div class="panel-body">

                                <?php if (isset($_SESSION['success'])){ 

                                    ?>
                                   
                                   <?php if ($_SESSION['success']==1){ ?>
                                         <div class="alert alert-success  alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><?php echo($_SESSION['message']); ?></div>                                              
                                   <?php }elseif($_SESSION['success']==0){ ?>
                                         <div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><?php echo($_SESSION['message']); ?></div>                                              
                                   <?php } ?>
                                   
                                <?php  
                                unset($_SESSION['success']);
                                unset($_SESSION['message']);} ?>
                                
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Prenom</th>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Etat</th>
                                            <th>Key</th>
                                            <th>Edit</th>
                                            <th>Trash</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            
                                            $result = mysql_query("SELECT * FROM bigdig_users") or die(mysql_error());
                                            $token=generer_token('user');
                                            
                                            if (mysql_num_rows($result) > 0) {
                                                while ($row = mysql_fetch_array($result)) {
                                                  $id=$row["id"];
                                                  $username=$row["username"];
                                                  $nom=$row["nom"];
                                                  $prenom=$row["prenom"];
                                                  $email=$row["email"];
                                                  $etat=$row["etat"];
                                                  $cle=$row["cle"];
                                                  ?>

                                                <tr class="gradeA">
                                                      <td><?php echo($id); ?></td>
                                                      <td><?php echo($username); ?></td>
                                                      <td><?php echo($nom); ?></td>
                                                      <td><?php echo($prenom); ?></td>
                                                      <td><?php echo($email); ?></td>
                                                      <td class="center">
                                                      <?php if ($etat==1): ?>
                                                          <button type="button" class="btn btn-info btn-circle stat" id="u<?php echo($id); ?>"><i class="fa fa-check"></i></button>
                                                      <?php else: ?>
                                                          <button type="button" class="btn btn-warning btn-circle stat" id="d<?php echo($id); ?>"><i class="fa fa-times"></i></button>
                                                      <?php endif ?>
                                                      

                                                      </td>
                                                      <td class="center">
                                                      <button class="btn btn-success btn-circle refresh" id="r<?php echo($id); ?>"><i class="fa fa-refresh"></i></button> | 
                                                      <button type="button" class="btn btn-default btn-circle" data-container="body" data-toggle="popover" data-placement="top" data-content="<?php echo($cle); ?>" data-original-title="" title=""><i class="fa fa-eye"></i></button>
                                                      </td>              
                                                      <td class="center"><a class="btn btn-primary btn-circle" href="edit_user.php?token=<?php echo $token;?>&id=<?php echo($id); ?>"><i class="fa fa-edit"></i></a></td>
                                                      <td class="center"><button class="btn btn-danger  btn-circle sup" type="button"  id="<?php echo($id); ?>"  data-toggle="modal" data-target="#myModal"><i class="fa fa-trash-o"></i></button></td>
                                                </tr>
                                            <?php }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Suppression</h4>
                                        </div>
                                        <div class="modal-body">
                                            voulez vous vraiment supprimer ce utilisateur ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <a id="delete" class="btn btn-primary" href="#">Delete</a>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                              

                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
           
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php // include db connect class
require_once __DIR__ . '/footer.php'; ?>