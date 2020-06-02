<?php
include("../configs/configs.php");
include("../configs/config.php");


$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if ($action == 'ajax') {
	$tables = "productos";
	$sWhere = " ";
	$sWhere .= " ";
	$sWhere .= " order by id";
	include 'pagination.php'; //include pagination file

	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
	$per_page = 8; //how much records you want to show
	$adjacents  = 7; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;

	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $tables  $sWhere ");
	if ($row = mysqli_fetch_array($count_query)) {
		$numrows = $row['numrows'];
	} else {
		echo mysqli_error($con);
	}
	$total_pages = ceil($numrows / $per_page);
	$reload = '../modulos/?p=productos';
	//main query to fetch the data
	$query = mysqli_query($con, "SELECT * FROM  $tables  $sWhere LIMIT $offset,$per_page");
?>
	<div class="buscar">
		<form method="post" action="" class="">
			<div class="row">
				<div class="col-md-11">
					<div class="form-group">
						<input type="text" class="form-control" name="busq" placeholder="Buscar..." autocomplete="off" />
					</div>
				</div>
				<div class="col-md-1">
					<button type="submit" class="btn btn-prmiary" name="buscar">Buscar</button>
				</div>
			</div>
		</form>
	</div>
	<?php
	//loop through fetched data
	if ($numrows > 0) {
	?>
		<div class="row" style="overflow: hidden">
			<?php
			while ($row = mysqli_fetch_array($query)) {
				$preciototal = 0;
				if ($row['oferta'] > 0) {
					if (strlen($r['oferta']) == 1) {
						$desc = "0.0" . $row['oferta'];
					} else {
						$desc = "0." . $row['oferta'];
					}
					$preciototal = $row['price'] - ($row['price'] * $desc);
				} else {
					$preciototal = $row['price'];
				}
			?>
				<div class="productos">
					<div class="producto">
						<div class="contenedor_img"><img class="img_producto" src="productos/<?= $row['imagen'] ?>" /></div>
						<br>
						<div class="name_producto"><?= $row['name'] ?></div>
						<?php
						if ($row['oferta'] > 0) {
						?>
							<br>
							<del><?= $row['price'] ?> <?= $divisa ?></del> <span class="precio"> <?= $preciototal ?> <?= $divisa ?> </span>
						<?php
						} else {
						?>
							<span class="precio"><br><?= $row['price'] ?> <?= $divisa ?></span>
						<?php
						}
						?>
						<a href="?p=ver_producto&id=<?= $row['id'] ?>">
							<button name="enviar" class="btn btn-warning pull-right"><i class="fa fa-shopping-cart"></i></button>
						</a>
					</div>
				</div>
			<?php
			}
			?>
		</div>

		<div class="table-pagination text-right">
			<?php echo paginate($reload, $page, $total_pages, $adjacents); ?>
		</div>
<?php
	}
}
?>