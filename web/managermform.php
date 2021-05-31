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
              <input type="text" name="keywords"  placeholder="Input keywords" /><input type="submit" value="Search" />
            </form>
          </li>
          </li>
        </ul>
    </div>
  </div>
 
  <?php
    include 'inc/mysql.php';
    include 'inc/pages.php';
    if(!$_SESSION['uid']){
      echo '<script>window.location.href="manager.php"</script>'; 
      die;
    }
    if($_POST){
      $file = $_FILES["img"];
      $filepath = $_POST['image'];
      if($file['error']<=0){
        //获取文件名
        $filename = $_FILES["img"]["name"];
        //获取文件扩展名
        $ext = pathinfo($filename,PATHINFO_EXTENSION);
        //随机生成新的文件名
        $filepath = md5(uniqid(mt_rand())).".".$ext;
        //上传
        move_uploaded_file($_FILES["img"]["tmp_name"], "uploads/".$filepath);
      }
    }
    if($_POST && !$_POST['id']){
      $sql = "insert into card (cat_name,ch_title,jp_title,en_title,img,card_id,pwd,cat,price,attr,race,star,aggressivity,rarity,ocg,tcg,tcocg,ch_about,en_about,jp_about,date) 
      values
      ('{$_POST['cat_name']}','{$_POST['ch_title']}','{$_POST['jp_title']}','{$_POST['en_title']}',
      '{$filepath}','{$_POST['card_id']}','{$_POST['pwd']}','{$_POST['cat']}',
      '{$_POST['price']}','{$_POST['attr']}','{$_POST['race']}',
      '{$_POST['star']}','{$_POST['aggressivity']}','{$_POST['rarity']}',
      '{$_POST['ocg']}','{$_POST['tcg']}','{$_POST['tcocg']}','{$_POST['ch_about']}','{$_POST['en_about']}','{$_POST['jp_about']}',now())";//组装 insert添加语句
      query($sql);//执行添加操作
    }
    if($_POST['id']){

     $sql = "UPDATE `card` set  `ch_title` = '{$_POST['ch_title']}',
                                `jp_title` = '{$_POST['jp_title']}',
                                `en_title` = '{$_POST['en_title']}',
                                `cat_name` = '{$_POST['cat_name']}',
                                `img` = '{$filepath}',
                                `card_id` = '{$_POST['card_id']}',
                                `pwd` = '{$_POST['pwd']}',
                                `cat` = '{$_POST['cat']}',
                                `price` = '{$_POST['price']}',
                                `attr` = '{$_POST['attr']}',
                                `race` = '{$_POST['race']}',
                                `star` = '{$_POST['star']}',
                                `aggressivity` = '{$_POST['aggressivity']}',
                                `rarity` = '{$_POST['rarity']}',
                                `ocg` = '{$_POST['ocg']}',
                                `tcg` = '{$_POST['tcg']}',
                                `tcocg` = '{$_POST['tcocg']}',
                                `ch_about` = '{$_POST['ch_about']}',
                                `en_about` = '{$_POST['en_about']}',
                                `jp_about` = '{$_POST['jp_about']}' where id = '{$_POST['id']}'";//组装update更新语句
                                query($sql);//提交执行更新操作
    }

    $title = 'Upload';
    if($_GET['id']){
      $title = 'edit';


    $sql = "select * from card where id = {$_GET['id']}";
    $_query = query($sql);
    $_rows=mysqli_fetch_array($_query,MYSQLI_ASSOC);


    }
  ?>

  <div class="main">
    <div class="manager_home">
      <div class="manager_home_boxs">
        <h1><?php echo $title ?></h1>
        <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $_rows['id']; ?>"/>
          <table cellspacing="0" border="1">
            <tr>
              <td>Japenese Name</td>
              <td><input type="text" name="en_title" placeholder="change information"  value="<?php echo $_rows['ch_title']; ?>" /></td>
              <td>Price</td>
              <td><input type="text" name="price" placeholder="change information"  value="<?php echo $_rows['price']; ?>" /></td>
              <td rowspan="8">
                <img src="uploads/<?php echo $_rows['img']; ?>" width="220"/><br/>
                <input type="file" name="img"/>
                <input type="hidden" name="image" value="<?php echo $_rows['img']; ?>"/>
              </td>
            </tr>
            <tr>
              <td>English Name</td>
              <td><input type="text" name="jp_title" value="<?php echo $_rows['jp_title']; ?>" /></td>
              <td>Chinese Name</td>
              <td><input type="text" name="en_title" placeholder="change information"  value="<?php echo $_rows['ch_title']; ?>" /></td>
            </tr>
            <tr>
              <td>Card No.</td>
              <td><input type="text" name="card_id" value="<?php echo $_rows['card_id']; ?>" /></td>
              <td>Card Code</td>
              <td><input type="text" name="pwd" placeholder="change information"  value="<?php echo $_rows['pwd']; ?>" /></td>
            </tr>
            <tr>
              <td>Card tyoe</td>
              <td><input type="text" name="cat_name"  value="<?php echo $_rows['cat_name']; ?>" /></td>
              <td>Attribute</td>
              <td><input type="text" name="attr" placeholder="change information"  value="<?php echo $_rows['attr']; ?>" /></td>
            </tr>
            <tr>
              <td>Monster type</td>
              <td><input type="text" name="race" value="<?php echo $_rows['race']; ?>" /></td>
              <td>Level / Rank</td>
              <td><input type="text" name="star" placeholder="change information"  value="<?php echo $_rows['star']; ?>" /></td>
            </tr>
            <tr>
              <td>ATK</td>
              <td><input type="text" name="power" value="<?php echo $_rows['power']; ?>" /></td>
              <td>DEF</td>
              <td><input type="text" name="numVotes" placeholder="change information"  value="<?php echo $_rows['numVotes']; ?>" /></td>
            </tr>
            <tr>
              <td>Rarity</td>
              <td colspan="3">
                <input type="text" name="rarity" value="<?php echo $_rows['rarity']; ?>"/>
              </td>
            </tr>
            <tr>
              <td>Limitation</td>
              <td colspan="3">
                OCG:<input type="text" name="ocg" value="<?php echo $_rows['ocg']; ?>" style="width:80px"/>
                TCG:<input type="text" name="tcg" value="<?php echo $_rows['tcg']; ?>" style="width:80px"/>
                TCOCG:<input type="text" name="tcocg" value="<?php echo $_rows['tcocg']; ?>" style="width:80px"/>
              </td>
            </tr>
            <tr>
              <td>Chinese introduction</td>
              <td colspan="5">
                <textarea cols="90" rows="6" name="ch_about"><?php echo $_rows['ch_about']; ?></textarea>
              </td>
            </tr>
            <tr>
              <td>English introduction</td>
              <td colspan="5">
                <textarea cols="90" rows="6" name="en_about"><?php echo $_rows['en_about']; ?></textarea>
              </td>
            </tr>
            <tr>
              <td>Japenese introduction</td>
              <td colspan="5">
                <textarea cols="90" rows="6" name="jp_about"><?php echo $_rows['jp_about']; ?></textarea>
              </td>
            </tr>
            <tr>
              <td colspan="5"><button>Save</button></td>
            </tr>
          </table>
        </form>

        <div style="clear:both;width:100%" ></div>
      </div>
      <div style="clear:both;width:100%" ></div>
    </div>
    
    <div class="footer">
      <p> <?php if($_SESSION['username']){ ?>
              <?php echo $_SESSION['username']; ?><a href="logout.php">  log out</a>
            <?php } ?></p>
    </div>
  </div>

</body>
</html>
