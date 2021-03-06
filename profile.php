<?php
session_start();
if(isset($_SESSION['user']))
{

}  
else{
  header ("location: index.php");
}
$user_id = $_SESSION['id'];
include 'deposit_nxt.php';
include_once 'lib/safemysql.class.php';
$db = new SafeMySQL();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>NextCoin.me | Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript">
	<!--	
  function deposit_alert()
  {
    document.getElementById('deposit_nxt_alert').style.display = 'block';
  }
	//-->
	</script>
    </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <ul class="nav navbar-nav navbar-right">
            <?php
            include 'include/balance.php';        
            ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>
                <?php
                    echo $users['name'];
                ?>
                <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                <?php
                echo("<li><a href='history.php?id=".$users['id']."'><span class='glyphicon glyphicon-list'></span> ");
                    echo "History";
                echo("</a></li>"); 
                  if($users['group'] == Administrator)
                  {
                  echo("<li><a href='/control'><span class='glyphicon glyphicon-warning-sign'></span> ");
                    echo "Control Panel";
                  }
                echo("</a></li>"); 
                ?>                             
                        </span></a></li>
                        <li><a href="chpass.php"><span class="glyphicon glyphicon-pencil"></span> Change password</a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Exit</a></li>
                    </ul>
            </li>
        </ul>
        <div class="navbar-header">
          <a class="navbar-brand" href="main.php">NextCoin.me</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="#about" data-toggle="modal" data-target="#about">About</a></li>         
            <li><a href="#faq" data-toggle="modal" data-target="#faq">FAQ</a></li>
            <li><a href="#contact" data-toggle="modal" data-target="#contact">Contact</a></li>
          </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    <div class="container" style="padding-top: 70px">
      <div class="row">
      		<div class="col-md-6">
				<form class="form-horizontal" role="form">
  					<div class="form-group">
  					  <label for="inputEmail3" class="col-sm-2 control-label">Username:</label>
  					  <div class="col-sm-10">
  					    <p class="form-control-static">
                			<?php
                			  echo $users['name'];
                			?>  					    	
  					    </p>
  					  </div>
  					</div>
  					<div class="form-group">
  					  <label for="inputPassword3" class="col-sm-2 control-label">E-mail:</label>
  					  <div class="col-sm-10">
  					    <p class="form-control-static">
                			<?php
                			  echo $users['email'];
                			?>  		  					    	
  					    </p>
  					  </div>
 					 </div>
  					<div class="form-group">
  					  <label for="inputEmail3" class="col-sm-2 control-label">Group:</label>
  					  <div class="col-sm-10">
  					    <p class="form-control-static">
                			<?php
                			  echo $users['group'];
                			?>  					    	
  					    </p>
  					  </div>
  					</div>
  					<div class="form-group">
  					  <label for="inputEmail3" class="col-sm-2 control-label">NXT Wallet:</label>
  					  <div class="col-sm-10">
  					    <p class="form-control-static">
                			<?php
                			  echo $users['wallet_nxt'];
                			?>  					    	
  					    </p>
  					  </div>
  					</div>
              			<div class="form-group">
              			  <div class="col-sm-offset-2 col-sm-10">
              			    <button type="submit" class="btn btn-danger" disabled="disabled">Change</button>
              			  </div>
              			</div>
				</form>
      		</div>
        <div class="col-md-6">
          <form class="form-horizontal" role="form" action=""> 
            <div class="form-group">
              <label class="col-sm-2 control-label">Holdings Balance</label>
              <div class="col-sm-10">
                <p class="form-control-static">
                <?php
                  echo $users['holdings'];
                ?>
                </p>
              </div>
            </div>
          </form>  
          <form class="form-horizontal" role="form" method="POST" action="deposit_usd.php">
            <div class="form-group">
              <label class="col-sm-2 control-label">Balance BTC</label>
              <div class="col-sm-10">
                <p class="form-control-static">
                <?php
                  echo round($balance_btc,4);
                ?>
                </p>
              </div>
            </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <a href="deposit_btc.php" class="btn btn-primary">Deposit BTC</a>
                  <a href="withdraw_btc.php" class="btn btn-danger">Withdraw BTC</a>
                </div>
              </div>
          </form>
          <br>
          <form class="form-horizontal" role="form" action=""> 
            <div class="form-group">
              <label class="col-sm-2 control-label">Balance NXT</label>
              <div class="col-sm-10">
                <p class="form-control-static">
                <?php
                  echo $balance_nxt;
                ?>
                </p>
              </div>
            </div>
                    <div id ="deposit_nxt_alert" style="display: none;" class="alert alert-info">
                		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                		For deposit to your balance pls send your NXT to wallet <b>13909801773525658690</b>
                	</div> 
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="button" class="btn btn-primary" onclick="deposit_alert();">Deposit NXT</button>
                  <a href="withdraw_nxt.php" class="btn btn-danger">Withdraw NXT</a>
                </div>
              </div>
          </form>               
        </div>
      </div>
    </div>
  <!-- Modal -->
  <div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">About</h4>
        </div>
        <div class="modal-body">
          ...
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- Modal -->
  <div class="modal fade" id="faq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">FAQ</h4>
        </div>
        <div class="modal-body">
          ...
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- Modal -->
  <div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Contact</h4>
        </div>
        <div class="modal-body">
          ...
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  </body>
</html>
