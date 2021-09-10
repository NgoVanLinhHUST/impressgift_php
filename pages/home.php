<?php
    $connect = connect_db();
    $categoriesQuery = mysqli_query($connect, "SELECT * FROM categories ORDER BY id DESC");
    $categories = [];
    if ($categoriesQuery->num_rows > 0) {
        while ($category = mysqli_fetch_array($categoriesQuery)) {
            $categories[] = $category;
        }
    }

    $featureProductsQuery = mysqli_query($connect, "SELECT p.id, p.name, p.price, product_images.image, product_images.id as image_id FROM products AS p LEFT JOIN product_images ON product_images.id = (SELECT product_images.id FROM product_images WHERE p.id = product_images.product_id ORDER BY product_images.id ASC LIMIT 1)  WHERE p.is_feature=1 ORDER BY p.id DESC LIMIT 8");
    $featureProducts = [];
    if ($featureProductsQuery->num_rows > 0) {
        while ($featureProduct = mysqli_fetch_array($featureProductsQuery)) {
            $featureProducts[] = $featureProduct;
        }
    }

    $newProductsQuery = mysqli_query($connect, "SELECT p.id, p.name, p.price, product_images.image, product_images.id as image_id FROM products AS p LEFT JOIN product_images ON product_images.id = (SELECT product_images.id FROM product_images WHERE p.id = product_images.product_id ORDER BY product_images.id ASC LIMIT 1) ORDER BY p.id DESC LIMIT 4");
    close_db_connect($connect);

    $newProducts = [];
    if ($newProductsQuery->num_rows > 0) {
        while ($newProduct = mysqli_fetch_array($newProductsQuery)) {
            $newProducts[] = $newProduct;
        }
    }
?>

<div class="content mt-5">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="content-menu">
                    <ul>
                        <?php
                            foreach ($categories as $category) {
                        ?>
                                <li>
                                    <a href="#"><?php echo $category['name']; ?></a>
                                </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
                <div class="mt-4">
                    <div class="content-images position-relative">
                        <img src="http://localhost/impressgift/public/imgs/content-left.png" alt="">
                        <div class="content-view">
                            <a href="#" class="view-all text-uppercase">view now <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="product-list">
                    <h2 class="text-uppercase text-center">feature product</h2>
                    <div class="row">
                        <?php
                            foreach ($featureProducts as $featureProduct) {
                        ?>
                                <div class="col-3">
                                    <div class="mt-4 product-list-item">
                                        <a href="<?php echo getUrl('product', $featureProduct['id']); ?>" class="image">
                                            <img src="<?php echo $featureProduct['image']; ?>" alt="">
                                        </a>
                                        <h4 class="title text-center">
                                            <a href="<?php echo getUrl('product', $featureProduct['id']); ?>"><?php echo $featureProduct['name']; ?></a>
                                        </h4>
                                        <div class="price text-center">$ <?php echo $featureProduct['price'] ?></div>
                                        <div class="button pt-3 text-center">
                                            <a href="" class="btn btn-secondary">Add to Enquiry</a>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        ?>

                    </div>
                    <div class="mt-5 text-center">
                        <a href="#" class="view-all text-uppercase">view all <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="mt-4 container-right-image">
                    <div class="row">
                        <div class="col-4">
                            <div class="content-left position-relative">
                                <img src="http://localhost/impressgift/public/imgs/content-right1.png" alt="">
                                <div class="content-left-child">
                                    <img src="http://localhost/impressgift/public/imgs/word-1.png" alt="">
                                    <div class="text-center view">
                                        <a href="#" class="view-all text-uppercase">view now <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="content-right position-relative">
                                <img src="http://localhost/impressgift/public/imgs/content-right4.PNG" alt="">
                                <div class="content-right-child">
                                    <img src="http://localhost/impressgift/public/imgs/word-2.png" alt="">
                                    <div class="view">
                                        <a href="#" class="view-all text-uppercase">view now <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 product-list">
                    <h2 class="text-uppercase text-center">new products</h2>
                    <div class="row">
                        <div class="col-3">
                            <div class="mt-4 product-list-item">
                                <a href="#" class="image">
                                    <img src="http://localhost/impressgift/public/imgs/product_5.png" alt="">
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
                                    <img src="http://localhost/impressgift/public/imgs/product_6.png" alt="">
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
                                    <img src="http://localhost/impressgift/public/imgs/product_7.png" alt="">
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
                                    <img src="http://localhost/impressgift/public/imgs/product_8.png" alt="">
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
                    <div class="mt-5 text-center">
                        <a href="#" class="view-all text-uppercase">view all <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="mt-5 product-list">
                    <h2 class="text-uppercase text-center">gift sets & baskets</h2>
                    <div class="row">
                        <div class="col-3">
                            <div class="mt-4 product-list-item">
                                <a href="#" class="image">
                                    <img src="http://localhost/impressgift/public/imgs/product_11.png" alt="">
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
                                    <img src="http://localhost/impressgift/public/imgs/product_12.png" alt="">
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
                                    <img src="http://localhost/impressgift/public/imgs/product_11.png" alt="">
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
                                    <img src="http://localhost/impressgift/public/imgs/product_12.png" alt="">
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
                    <div class="mt-5 text-center">
                        <a href="#" class="view-all text-uppercase">view all <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php
