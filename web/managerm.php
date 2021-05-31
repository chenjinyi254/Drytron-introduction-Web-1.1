<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Yo-Gi-Oh!</title>
<link href="css/css.css" rel="stylesheet" type="text/css" /> 
</head>
<?php
  include 'inc/mysql.php';
  include 'inc/pages.php';
  if(!$_SESSION['uid']){
    echo '<script>window.location.href="manager.php"</script>'; 
    die;
  }
  ?>
<body>
  
<div id="header">
  <div class="menu">
        <ul>
          <li id="menu_title"><a href="index.php">Home</li>
          <li><a href="guaishou.php">Monster</a></li>
          <li><a href="mofa.php">Magic</a></li>
          <li><a href="xianjing.php">Trap</a></li>
          <li align="center">
            <form method="get" id="search_form" action="find.php">
              <input type="text" name="keywords"  placeholder="Input Keywords" /><input type="submit" value="Search" />
            </form>
          </li>
          </li>
        </ul>
    </div>
  </div>


  <div class="main">
    <p align="right" class="btn_group"><a href="managermform.php"><img src="img/add.png" width="30" />Upload</a></p>
    <div class="manager_home">
      <div class="manager_home_boxs">
        <div class="tool">
          <form method="get" id="search_form">
            <input type="text" name="keywords"  placeholder="Input Keywords" /><input type="submit" value="Research" />
          </form>
        </div>

        <table cellspacing="0" border="1">
          <tr>
            <td>Name</td>
            <td>Card Code</td>
            <td>Price</td>
            <td>Card type</td>
            <td>Function</td>
          </tr>

          <?php

            if($_GET['act'] == 'del'){
              query("delete FROM  card where id = '{$_GET['id']}'");//删除 id值为 $_GET['id']的数据
            }

            if($_GET['keywords']){
              $where = " and (ch_title like '%{$_GET['keywords']}%' or en_title like '%{$_GET['keywords']}%' or jp_title like '%{$_GET['keywords']}%')";//通过 like 包含关键词的数据
            }

            $pageSize = 8;
            $page = isset($_GET['p'])?$_GET['p']:1;
            $count = mysqli_fetch_array(query("select count(*) as c from card where id > 0 {$where}"));//统计数据总数
            $now = ($page-1)*$pageSize;
            $sql = "select * from card where id > 0 {$where} order by id desc limit ".$now.",".$pageSize;//循环显示出查询数据
            $_query = query($sql);
            while ($_rows=mysqli_fetch_array($_query,MYSQLI_ASSOC)){

            ?>
            <tr>
            <td><?php echo $_rows['en_title']?></td>
            <td><?php echo $_rows['card_id']?></td>
            <td><?php echo $_rows['price']?></td>
            <td><?php echo $_rows['cat_name']?></td>
            <td><a href="managermform.php?id=<?php echo $_rows['id']?>">edit</a> <a href="?act=del&id=<?php echo $_rows['id'];?>">delete</a></td>
            </tr>
            <?php } ?>
            
        </table>
        <?php
            $params = array(
              'total_rows'=>$count['c'], #(必须)
              'method'    =>'default', #(必须)
              'parameter' =>'index.php?',  #(必须)
              'now_page'  =>$_GET['p'],  #(必须)
              'list_rows' =>$pageSize, #(可选) 默认为15
            );
            $page = new Core_Lib_Page($params);
            echo  '<div id="pageList">'.$page->show(1).'</div>';
          ?>

        <div style="clear:both;width:100%" ></div>
      </div>
      <div style="clear:both;width:100%" ></div>
    </div>
    <div class="footer">
      <p> <?php if($_SESSION['username']){ ?>
              <?php echo $_SESSION['username']; ?><a href="logout.php"> Log Out!</a>
            <?php } ?></p>
    </div>
  </div>

</body>
</html>
