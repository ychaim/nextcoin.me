<?php
session_start();
if(isset($_SESSION['user']))
{

}  
else{
  header ("location: index.php");
}
$user_id = $_SESSION['id'];
include 'functions.php';
include 'deposit_nxt.php';
$balance = getBalance($user_id);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>NextCoin.me | Withdraw NXT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript">
  <!--  
  function withdraw()
  {
    valid = true;
    var a = <?php echo $balance; ?>;

          if(document.withdraw_form.amount.value > a)
          {
              //alert ( "Amount can't be less 100 and empty." );
                  document.getElementById('withdraw_alert').style.display = 'block';
                  document.withdraw_form.amount.focus();
                  valid = false;
          }

      return valid;
  }
  //-->
  </script>
    </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <ul class="nav navbar-nav navbar-right">
        <?php
              $link = mysql_connect('localhost','root','0rSo%232fzq12');
                if (!$link) $loginerr .="Не удалось соединиться с БД";
                mysql_select_db('nxt', $link);
                $result = mysql_query("SELECT * FROM users WHERE id=$user_id",$link);
                while($row = mysql_fetch_assoc($result)) {
                echo("<li><a href='profile.php?id=".$row['id']."'><span class='glyphicon glyphicon-usd'></span> <span class='label label-default'>");
                /*
                  Получаем баланс пользователя с кошелька USD
                */
                    echo $row['balance_usd'];
                }
                echo("</span></a></li>");

                if (!$link) $loginerr .="Не удалось соединиться с БД";
                mysql_select_db('nxt', $link);
                $result = mysql_query("SELECT * FROM users WHERE id=$user_id",$link);
                while($row = mysql_fetch_assoc($result)) {
                echo("<li><a href='profile.php?id=".$row['id']."'><span class='glyphicon glyphicon-globe'></span> <span class='label label-default'>");
                //$balance = getBalance($user_id);
                /*
                  Получаем баланс пользователя в NXT
                */
                echo $balance;        
                } 
                echo("</span></a></li>");         
        ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>
                <?php
                /*
                  Получаем имя пользователя
                */
                $link = mysql_connect('localhost','root','0rSo%232fzq12');
                if (!$link) $loginerr .="Не удалось соединиться с БД";
                mysql_select_db('nxt', $link);
                $result = mysql_query("SELECT * FROM users WHERE id=$user_id",$link);
                while($row = mysql_fetch_assoc($result)) {
                    echo $row['name'];
                }
                ?>
                <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                <?php
                if (!$link) $loginerr .="Не удалось соединиться с БД";
                mysql_select_db('nxt', $link);
                $result = mysql_query("SELECT * FROM users WHERE id=$user_id",$link);
                while($row = mysql_fetch_assoc($result)) {
                echo("<li><a href='history.php?id=".$row['id']."'><span class='glyphicon glyphicon-list'></span> ");
                /*
                  Получаем баланс пользователя с кошелька USD
                */
                    echo "History";
                }
                echo("</a></li>"); 
                ?>                             
                        </span></a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-pencil"></span> Change password</a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Exit</a></li>
                    </ul>
            </li>
        </ul>
        <div class="navbar-header">
          <a class="navbar-brand" href="#">NextCoin.me</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="main.php">Home</a></li>
            <li><a href="#about" data-toggle="modal" data-target="#about">About</a></li>         
            <li><a href="#faq" data-toggle="modal" data-target="#faq">FAQ</a></li>
            <li><a href="#contact" data-toggle="modal" data-target="#contact">Contact</a></li>
          </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    <div class="container" style="padding-top: 70px">
      <div class="row">
        <div class="col-md-8">
          <form name="withdraw_form" class="form-horizontal" role="form" method="POST" onsubmit="return withdraw();" action="funct_withdraw_nxt.php">
          <div class="alert alert-info">Wait please few minutes for procces ended and <b>don't close this page!</b></div>
              <div id ="withdraw_alert" class="alert alert-danger" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Can't be more then your balance. Your balance is <b><?php echo $balance; ?></b>
              </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Amount</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Amount" name="amount">
              </div>
            </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Send</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>


    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
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
