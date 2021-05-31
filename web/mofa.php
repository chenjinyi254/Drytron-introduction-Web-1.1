<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Yo-Gi-Oh!</title>
<link href="css/css.css" rel="stylesheet" type="text/css" /> 
</head>

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

    <div class="find_cards">
      <div class="cards">

      <?php
          include 'inc/mysql.php';//引用数据库连接
          include 'inc/pages.php';//加载分页类
          

            $pageSize = 8;
            $page = isset($_GET['p'])?$_GET['p']:1;//接收页码
            $where = " and cat_name like '%魔法%'";//通过 like 查找卡片分类名包含怪兽的
            $count = mysqli_fetch_array(query("select count(*) as c from card where id > 0 {$where} "));//统计数据总各数
            $now = ($page-1)*$pageSize;
            $sql = "select * from card where id > 0 {$where}  limit ".$now.",".$pageSize;//查询相应页面的数据
            $_query = query($sql);
            while ($_rows=mysqli_fetch_array($_query,MYSQLI_ASSOC)){//循环显示出查询数据
          ?>
          <div class="box">
            <img src="uploads/<?php echo $_rows['img']; ?>" />
            <div class="summary">
              <a href="detail.php?id=<?php echo $_rows['id']; ?>"><?php echo $_rows['en_title']; ?></a>
            </div>
          </div>
          <?php } ?>
          
         
        <div style="clear:both;width:100%" ></div>
        
      <?php
          $params = array(
            'total_rows'=>$count['c'], #(必须)
            'method'    =>'default', #(必须)
            'parameter' =>'index.php?',  #(必须)
            'now_page'  =>$_GET['p'],  #(必须)
            'list_rows' =>$pageSize, #(可选) 默认为15
          );
          $page = new Core_Lib_Page($params);
          echo  '<div id="pageList">'.$page->show(1).'</div>';//显示分页内容 
        ?>
        

      </div>
      
      <div style="clear:both;width:100%" ></div>


    </div>
    

    <div class="footer">
      <p><a href="manager.php">Management</a></p>
    </div>
  </div>

</body>
</html>
