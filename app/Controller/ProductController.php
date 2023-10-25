<?php

namespace LOGINMANAGEMENT4\PhpLoginManagemen;

class ProductController
{

    function categories(string $productId, string $categoryId): void
    {
        echo "PRODUCT $productId, CATEGORY $categoryId";
    }

}