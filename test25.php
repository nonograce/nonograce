 <?php
// var_dump($_POST)
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xm1ns="http://www.w3.org/1999/xhtml">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Script-Type" content="text/javascript">


	<title>敬語学習ノート</title>
	<style type="text/css">
<!--
BODY {
	background-image: url(kokuban1.jpg);
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-position: right top;
}

-->
.font1 {
	font-family: "あずきフォント";
}

.font2 {
	font-family: "あずきフォント";
	font-size: 160%;
	color: "#e4b9f9";
}

.font3 {
/* 	padding: 4px; */
/* 	font-family: "あずきフォント"; */
}

.font {
	font-family: "あずきフォント";
	font-size: 160%;
	color: "white";
}

.body {
	cursor: url(hosi5.ani);
}

@font-face {
	font-family: 'あずきフォント'; /* お好きな名前に */
	src: url('azuki.eot'); /* IE9以上用 */
	src: url('azuki.eot?#iefix') format('embedded-opentype'), /* IE8以前用 */
        url('azuki.woff') format('woff'), /* モダンブラウザ用 */
        url('azuki.ttf') format('truetype'); /* iOS, Android用 */
}

html,body {
	scrollbar-base-color: #c3d7e0;
	scrollbar-track-color: #c3d7e0;
	scrollbar-face-color: #c3d7e0;
	scrollbar-shadow-color: #c3d7e0;
	scrollbar-darkshadow-color: #c3d7e0;
	scrollbar-highlight-color: #c3d7e0;
	scrollbar-3dlight-color: #c3d7e0;
	scrollbar-arrow-color: #ffffff;
	filter: chroma(color = #c3d7e0);
}
/* .absolute{ */
/* 	position:absolute; */
/* 	right:50px; */
/* } */
</style>

</head>
<body>
	<table cellspacing="0" width="300" cellpadding="4"
		style="border: 5px black solid;">
		<tr>
			<td style="border: 5px brown inset; color: white;" bgcolor="green">
				<p class="font1">検索したい文字を入力してください</p>
				<form action="" method="post">
					<input type="text" name="keyword"> <input type="submit"
						name="button1" value="検索"
						style="border: 1px solid #ff44ff; color: #ee00ff; background-color: #eeccff;">
							</br> <img src="u09.gif" align="right">
								</p>

			</td>
		</tr>
	</table>
	<table cellspacing="0" width="600" cellpadding="4"
		style="border: 5px black solid;">
		<tr>
			<td style="border: 5px brown inset; color: white;" bgcolor="green">
				<p>
					<img src="res-19.gif"><font class="font1">ノートに書く</font>

				</p> <font class="font1">タメ語<input type="text" name="tamego"> 正しい敬語<input
						type="text" name="keigo"> </br> 例文 <input type="text"
							name="reibun" style="width: 405px;"> <input type="submit"
								name="button2" value="書く"
								style="border: 1px solid #ff44ff; color: #ee00ff; background-color: #eeccff;">
									<!-- </form> --> <img src="res-19.gif"> </br> <!--<img src="u07.gif"  style="position:absolute;right:255px"> -->
										<img src="u09.gif" align="right">
											</p>

			</td>
		</tr>
	</table>
	<button type="submit" name='button3' value='button3'
		style="border: 1px solid #ff44ff; color: #ee00ff; background-color: #eeccff;">修正する</button>
	<button type="submit" name='button5' value='button5'
		style="border: 1px solid #ff44ff; color: #ee00ff; background-color: #eeccff;">一覧表示</button>
	</form>

	<!-- <img src="hooter.png"> -->
	<table cellpading="0" border="1" width="80%">
		<caption class="font2">敬語学習ノート</caption>
		</br>
		</p>
		</br>
		<!--	<tr style="background: #ccccff">-->
		<tr style="background: #cc528b">
			<th width="30"  height="35" class="font1"><font color="white">番号</font></th>
			<th width="110"  height="35"class="font1"><font color="white">タメ語</font></th>
			<th width="110" class="font1"><font color="white">正しい敬語</font></th>
			<th width="160" class="font1"><font color="white">例文</font></th>
			<?php
			if(isset($_POST ['button3'])) {
				echo '<th class="font1"><font color="white">更新</font></th><th class="font1"><font color="white">削除</font></th>';
			 }
			 ?>
		</tr>
<?php
// $pdo = new PDO ( 'mysql:host=localhost;dbname=honorific;charset=utf8', 'staff', 'password' );
$pdo = new PDO ( 'mysql:host=localhost;dbname=takahashi1;charset=utf8', 'takahashi', 'takahashi' );
// $pdo = new PDO ( 'mysql:host=192.168.1.30;dbname=honorific;charset=utf8', 'staff1', 'password' );
function h($str) {
	return htmlspecialchars ( $str);
}
// もし何かしらPOSTされたら
if ($_SERVER ['REQUEST_METHOD'] === 'POST') {
// 検索ボタンが押されて、空じゃなかったら
	if ($_POST ['button1'] && ! empty ( $_POST ['keyword'] )) {
		$vKeyword = isset ( $_POST ['keyword'] ) ? $_POST ['keyword'] : '';

		$sql = $pdo->prepare ( 'select * from honorifics where wrongHonorific like ? or rightHonorific like ? or example like ?' );
		$sql->execute ( array (
				'%' . $vKeyword . '%',
				'%' . $vKeyword . '%',
				'%' . $vKeyword . '%'
		) );
	}
// もし書くボタンが押されたら
	if ($_POST ['button2']) {
		$vTamego = isset ( $_POST ['tamego'] ) ? $_POST ['tamego'] : '';
		$vKeigo = isset ( $_POST ['keigo'] ) ? $_POST ['keigo'] : '';
		$vReibun = isset ( $_POST ['reibun'] ) ? $_POST ['reibun'] : '';
		$sql = $pdo->prepare ( 'insert into honorifics values(null, ?, ?, ?)' );
		$sql->execute ( array (
				$vTamego,
				$vKeigo,
				$vReibun
		) );
		header('Location:'.$_SERVER['PHP_SELF']);
	}
// もし検索ボタンが押されて、空じゃなかったら
	if (! empty ( $_POST ['keyword'] ) && $_POST['button1']) {
		foreach ( $sql->fetchAll () as $row ) {
			echo '<tr>';
			echo '<td>' . h ( $row ['id'] ), '</td>';
			echo '<td><font class="font3">', h ( $row ['wrongHonorific'] ), '</font></td>';
			echo '<td>', h ( $row ['rightHonorific'] ), '</td>';
			echo '<td>', h ( $row ['example'] ), '</td>';
			echo '</tr>';
			echo "\n";
		}
		echo '<button onclick="history.back()"style="border: 1px solid #ff44ff; color: #ee00ff; background-color: #eeccff;">戻る</button>';
	}
	//もし空欄で検索ボタンが押されたらor一覧表示ボタンが押されたら
	if ((empty ( $_POST ['keyword'] ) && $_POST['button1'])||$_POST['button5']) {
		foreach ( $pdo->query ( 'select * from honorifics order by id desc' ) as $row ) {
			echo '<tr>';
			echo '<td width="30"  height="35" align="center" width="110" height="35">' . h ( $row ['id'] ), '</td>';
			echo '<td class="font3">', h ( $row ['wrongHonorific'] ), '</td>';
			echo '<td cellpadding="15">', h ( $row ['rightHonorific'] ), '</td>';
			echo '<td>', h ( $row ['example'] ), '</td>';
			echo '</tr>';
			echo "\n";
		}
	}
}
// 直リンク時
if (! $_POST) {
	foreach ( $pdo->query ( 'select * from honorifics order by id desc' ) as $row ) {
		echo '<tr>';
		echo '<td>' . h ( $row ['id'] ), '</td>';
		echo '<td class="font3">', h ( $row ['wrongHonorific'] ), '</td>';
		echo '<td cellpadding="15">', h ( $row ['rightHonorific'] ), '</td>';
		echo '<td>', h ( $row ['example'] ), '</td>';
		echo '</tr>';
		echo "\n";
	}
}
// 修正するボタンが押されたら
if ($_POST ['button3']) {
// query→引数に指定したSQL文をデータベースに対して実行する
	foreach ( $pdo->query ( 'select * from honorifics order by id desc' ) as $row ) {
		echo '<tr><form action="" method="post">';
		// type属性をhiddenにすることでフォームに商品番号を含めつつも編集できないようにしている
		echo '<input type="hidden" name="id" value="', $row ['id'], '">';
		echo '<td width="110" height="35">' . h ( $row ['id'] ), '</td>';
		echo '<td class="font3">', '<input type="text"name="upTamego" value="', $row ['wrongHonorific'], '">', '</td>';
// 		echo '<td class="font3">', '<textarea rows="1" cols="20" maxlength="20" width="13" name="upTamego">',$row['wrongHonorific'],'</textarea></td>';
		echo '<td cellpadding="15">', '<input type="text" name="upKeigo" value="', $row ['rightHonorific'], '">', '</td>';
		echo '<td>', '<input type="text" size="40" name="upReibun" value="', $row ['example'], '">', '</td>';
		echo '<td><input type="submit" name="button4" value="更新" style="border: 1px solid #ff44ff; color: #ee00ff; background-color: #eeccff;"></td>';
		echo '<td><input type="submit" name="delete" value="削除" style="border: 1px solid #ff44ff; color: #ee00ff; background-color: #eeccff;"></td>';
		echo '</form></tr>';
		echo "\n";
	}
}
// 更新ボタンが押されたら
if ($_POST ['button4']) {
	$vId = isset ( $_POST ['id'] ) ? $_POST ['id'] : '';
	$vUpTamego = isset ( $_POST ['upTamego'] ) ? $_POST ['upTamego'] : '';
	$vUpKeigo = isset ( $_POST ['upKeigo'] ) ? $_POST ['upKeigo'] : '';
	$vUpReibun = isset ( $_POST ['upReibun'] ) ? $_POST ['upReibun'] : '';
	$sql = $pdo->prepare('update honorifics set wrongHonorific=?, rightHonorific=?, example=? where id=?');
	$sql->execute(array(h($vUpTamego),h($vUpKeigo),h($vUpReibun),h($vId)));
// 	$_SERVER['PHP_SELF']→自ページから自ページへ移動
	header('Location:'.$_SERVER['PHP_SELF']);
}
if($_POST['delete']){
	$sql=$pdo->prepare('delete from honorifics where id=?');
	$sql->execute(array(h($_POST['id'])));
// 	echo '<button onclick="history.back()"style="border: 1px solid #ff44ff; color: #ee00ff; background-color: #eeccff;">戻る</button>';
	header('Location:'.$_SERVER['PHP_SELF']);
}
?>
</table>
</body>
</html>

