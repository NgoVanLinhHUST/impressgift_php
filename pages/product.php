<?php
    $productId = !empty($_GET['param']) ? $_GET['param'] : null;
    if (!$productId) {
        redirectUrl(BASE_URL);
    }
    $connect = connect_db();
    $productQuery = mysqli_query($connect, "SELECT * FROM products WHERE id=$productId");
    if ($productQuery->num_rows == 0) {
        redirectUrl(BASE_URL);
    }
    $product = mysqli_fetch_array($productQuery);
    $productImageQuery = mysqli_query($connect, "SELECT * FROM product_images WHERE product_id=$productId");
    close_db_connect($connect);
    $productImages = [];
    if ($productImageQuery->num_rows > 0) {
        while ($image = mysqli_fetch_array($productImageQuery)) {
            $productImages[] = $image;
        }
    }
?>

<div class="content">
    <div class="container">
        <p class="mt-3 container-about-us"><i class="fa fa-home" aria-hidden="true"></i> <i class="fa fa-angle-right" aria-hidden="true"></i> Our Products <i class="fa fa-angle-right" aria-hidden="true"></i> Lorem ipsum dolor</p>
        <div class="row">
            <div class="col-3">
                <div class="content-menu">
                    <ul>
                        <li>
                            <a href="">New Arrivals</a>
                        </li>
                        <li class="active">
                            <a href="">Promotions</a>
                        </li>
                        <li>
                            <a href="">Apparel</a>
                        </li>
                        <li>
                            <a href="">Accessories</a>
                        </li>
                        <li>
                            <a href="">Carrier</a>
                        </li>
                        <li>
                            <a href="">Drinkware</a>
                        </li>
                        <li>
                            <a href="">Eco Series</a>
                        </li>
                        <li>
                            <a href="">Excutive</a>
                        </li>
                        <li>
                            <a href="">Gift Sets</a>
                        </li>
                        <li>
                            <a href="">Impressive Umbrellas</a>
                        </li>
                        <li>
                            <a href="">Life Style</a>
                        </li>
                        <li>
                            <a href="">Office</a>
                        </li>
                        <li>
                            <a href="">Outdoor</a>
                        </li>
                        <li>
                            <a href="">Stationeries</a>
                        </li>
                        <li>
                            <a href="">Travel</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-9">
                <div class="product-item">
                    <div class="row">
                        <div class="col-5">
                            <div class="product-list-item">
                                <a href="#" class="image">
                                    <?php
                                        if (!empty($productImages)) {
                                    ?>
                                            <img src="<?php echo $productImages[0]['image']; ?>" alt="">
                                    <?php
                                        }
                                    ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="inform-item mb-3">
                                <h3 class="name pb-3">
                                    <a href=""><?php echo $product['name']; ?></a>
                                </h3>
                                <p class="title"><?php echo $product['short_description']; ?></p>
                                <div class="price pb-4">$ <?php echo $product['price']; ?></div>
                                <a href="" class="enquiry">
                                    <button type="submit">Enquiry Now</button>
                                </a>
                                <div class="link-special">
                                    <a href="" class="btn btn-success link-special-face"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
                                    <a href="" class="btn btn-success link-special-twitter"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>
                                    <a href="" class="btn btn-success link-special-google"><i class="fa fa-google-plus" aria-hidden="true"></i> Google+</a>
                                    <a href="" class="btn btn-success link-special-pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i> Pinterest</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="description">
                    <h3 class="name-description text-center">Description</h3>
                    <p class="description-title"><?php echo $product['description']; ?></p>
                </div>
                <div class="product-list mt-5">
                    <h2 class="text-uppercase text-center">related products</h2>
                    <div class="row">
                        <div class="col-3">
                            <div class="mt-4 product-list-item">
                                <a href="#" class="image">
                                    <img src="images/product_1.png" alt="">
                                </a>
                                <h4 class="title text-center">
                                    <a href="">iMP4102 - Memo Desk Set</a>
                                </h4>
                                <div class="price text-center">$10</div>
                                <div class="button pt-3 text-center">
                                    <a href="" class="btn btn-secondary">Add to Enquiry</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mt-4 product-list-item">
                                <a href="#" class="image">
                                    <img src="images/product_2.png" alt="">
                                </a>
                                <h4 class="title text-center">
                                    <a href="">iMP4102 - Memo Desk Set</a>
                                </h4>
                                <div class="price text-center">$10</div>
                                <div class="button pt-3 text-center">
                                    <a href="" class="btn btn-secondary">Add to Enquiry</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mt-4 product-list-item">
                                <a href="#" class="image">
                                    <img src="images/product_3.png" alt="">
                                </a>
                                <h4 class="title text-center">
                                    <a href="">iMP4102 - Memo Desk Set</a>
                                </h4>
                                <div class="price text-center">$10</div>
                                <div class="button pt-3 text-center">
                                    <a href="" class="btn btn-secondary">Add to Enquiry</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mt-4 product-list-item">
                                <a href="#" class="image">
                                    <img src="images/product_4.png" alt="">
                                </a>
                                <h4 class="title text-center">
                                    <a href="">iMP4102 - Memo Desk Set</a>
                                </h4>
                                <div class="price text-center">$10</div>
                                <div class="button pt-3 text-center">
                                    <a href="" class="btn btn-secondary">Add to Enquiry</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="mt-4 product-list-item">
                                <a href="#" class="image">
                                    <img src="images/product_5.png" alt="">
                                </a>
                                <h4 class="title text-center">
                                    <a href="">iMP4102 - Memo Desk Set</a>
                                </h4>
                                <div class="price text-center">$10</div>
                                <div class="button pt-3 text-center">
                                    <a href="" class="btn btn-secondary">Add to Enquiry</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mt-4 product-list-item">
                                <a href="#" class="image">
                                    <img src="images/product_6.png" alt="">
                                </a>
                                <h4 class="title text-center">
                                    <a href="">iMP4102 - Memo Desk Set</a>
                                </h4>
                                <div class="price text-center">$10</div>
                                <div class="button pt-3 text-center">
                                    <a href="" class="btn btn-secondary">Add to Enquiry</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mt-4 product-list-item">
                                <a href="#" class="image">
                                    <img src="images/product_7.png" alt="">
                                </a>
                                <h4 class="title text-center">
                                    <a href="">iMP4102 - Memo Desk Set</a>
                                </h4>
                                <div class="price text-center">$10</div>
                                <div class="button pt-3 text-center">
                                    <a href="" class="btn btn-secondary">Add to Enquiry</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mt-4 product-list-item">
                                <a href="#" class="image">
                                    <img src="images/product_8.png" alt="">
                                </a>
                                <h4 class="title text-center">
                                    <a href="">iMP4102 - Memo Desk Set</a>
                                </h4>
                                <div class="price text-center">$10</div>
                                <div class="button pt-3 text-center">
                                    <a href="" class="btn btn-secondary">Add to Enquiry</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>