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
    $sql = "select * from card where id = {$_GET['id']}";
    $_query = query($sql);
    $_rows=mysqli_fetch_array($_query,MYSQLI_ASSOC);


  ?>
  <div class="main">
    <div class="manager_home">
      <div class="manager_home_boxs">
      <table cellspacing="0" border="1">
            <tr>
              <td rowspan="8">
                <img src="uploads/<?php echo $_rows['img']; ?>" width="220"/>
              </td>
              <td>Chinese Name</td>
              <td><?php echo $_rows['ch_title']; ?></td>
              <td>Price</td>
              <td><?php echo $_rows['price']; ?></td>
            </tr>
            <tr>
              <td>English</td>
              <td><?php echo $_rows['jp_title']; ?></td>
              <td>Japnese Name</td>
              <td><?php echo $_rows['en_title']; ?></td>
            </tr>
            <tr>
              <td>Card No.</td>
              <td><?php echo $_rows['card_id']; ?></td>
              <td>Card Code</td>
              <td><?php echo $_rows['pwd']; ?></td>
            </tr>
            <tr>
              <td>Card Type</td>
              <td><?php echo $_rows['cat_name']; ?></td>
              <td>Attribute</td>
              <td><?php echo $_rows['attr']; ?></td>
            </tr>
            <tr>
              <td>Monster type</td>
              <td><?php echo $_rows['race']; ?></td>
              <td>Level / Rank </td>
              <td><?php echo $_rows['star']; ?></td>
            </tr>
            <tr>
              <td>ATK</td>
              <td><?php echo $_rows['power']; ?></td>
              <td>DEF</td>
              <td><?php echo $_rows['numVotes']; ?></td>
            </tr>
            <tr>
              <td>Rarity</td>
              <td colspan="3">
                <?php echo $_rows['rarity']; ?>
              </td>
            </tr>
            <tr>
              <td>Limitation</td>
              <td colspan="3">
                OCG:<?php echo $_rows['ocg']; ?>
                TCG:<?php echo $_rows['tcg']; ?>
                TCOCG:<?php echo $_rows['tcocg']; ?>
              </td>
            </tr>
            <tr>
              <td>Chinese Introduction</td>
              <td colspan="5">
                <?php echo $_rows['ch_about']; ?>
              </td>
            </tr>
            <tr>
              <td>English introduction</td>
              <td colspan="5">
                <?php echo $_rows['en_about']; ?>
              </td>
            </tr>
            <tr>
              <td>Japenese introduction</td>
              <td colspan="5">
                <?php echo $_rows['jp_about']; ?>
              </td>
            </tr>
          </table>

        <div style="clear:both;width:100%" ></div>
      </div>
      <div style="clear:both;width:100%" ></div>
    </div>
    
    <div class="footer">
      <p><a href="manager.php">Management</a></p>
    </div>
  </div>

</body>
</html>
