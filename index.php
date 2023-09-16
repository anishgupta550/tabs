<?php
include_once("db_connect.php");
$category_sql = "SELECT id, name FROM categories LIMIT 10";
$resultset = mysqli_query($conn, $category_sql) or die("database error:" . mysqli_error($conn));
$active_class = 0;
$category_html = '';
$product_html = '';
while ($category = mysqli_fetch_assoc($resultset)) {
	$current_tab = "";
	$current_content = "";
	if (!$active_class) {
		$active_class = 1;
		$current_tab = 'active';
		$current_content = 'in active';
	}
	$category_html .= '<li class="' . $current_tab . '"><a href="#' . $category['id'] . '" data-toggle="tab">' .
		$category['name'] . '</a></li>';
	$product_html .= '<div id="' . $category["id"] . '" class="tab-pane fade ' . $current_content . '">';
	$product_sql = "SELECT cat_id, p_name, p_image, price FROM category_products WHERE cat_id = " . $category["id"];
	$product_results = mysqli_query($conn, $product_sql) or die("database error:" . mysqli_error($conn));
	if (!mysqli_num_rows($product_results)) {
		$product_html .=  '<h1>No product !!!</h1>';
	}
	while ($product = mysqli_fetch_assoc($product_results)) {
		$product_html .= '<div class="col-md-3 product">';
		$product_html .= '<img src="images/' . $product["p_image"] . '" class="img-responsive img-thumbnail product_image" />';
		$product_html .=  '<h4>' . $product["p_name"] . '</h4>';
		$product_html .=  '<h4>Price: $' . $product["price"] . '</h4>';
		$product_html .=  '</div>';
	}
	$product_html .=  '<div class="clear_both"></div></div>';
}
?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<title>Nav tabs</title>
	<style>
		.product {
			width: 150px;
			padding: 0px 10px 0px 0px;
			margin-top: 10px;
		}

		.product_image {
			width: 200px;
			height: 200px;
		}

		.clear_both {
			clear: both;
		}
	</style>
</head>

<body class="">
	<div class="container" style="min-height:500px;">
		<div class=''>
		</div>
		<div class="container">
			<ul class="nav nav-tabs">
				<?php echo $category_html; ?>
			</ul>
			<div class="tab-content">
				<?php echo $product_html; ?>
			</div>
		</div>
		<div class="insert-post-ads1" style="margin-top:20px;">

		</div>
</body>

</html>