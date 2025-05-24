<?php

require_once __DIR__ . '/vendor/autoload.php';

// DAOs
require_once __DIR__ . '/dao/BaseDao.php';
require_once __DIR__ . '/dao/CategoryDao.php';
require_once __DIR__ . '/dao/ProductDao.php';
require_once __DIR__ . '/dao/OrderDao.php';
require_once __DIR__ . '/dao/ReviewDao.php';
require_once __DIR__ . '/dao/UserDao.php';

// Services
require_once __DIR__ . '/services/CategoryService.php';
require_once __DIR__ . '/services/ProductService.php';
require_once __DIR__ . '/services/OrderService.php';
require_once __DIR__ . '/services/ReviewService.php';
require_once __DIR__ . '/services/UserService.php';

// Register services to Flight
Flight::register('categoryService', 'CategoryService');
Flight::register('productService', 'ProductService');
Flight::register('orderService', 'OrderService');
Flight::register('reviewService', 'ReviewService');
Flight::register('userService', 'UserService');

// Routes
require_once __DIR__ . '/routes/categoryRoutes.php';
require_once __DIR__ . '/routes/productRoutes.php';
require_once __DIR__ . '/routes/orderRoutes.php';
require_once __DIR__ . '/routes/reviewRoutes.php';
require_once __DIR__ . '/routes/userRoutes.php';

// Swagger Docs 
require_once __DIR__ . '/swagger/index.php';

Flight::route('GET /docs', function () {
    require __DIR__ . '/swagger/index.php';
});

Flight::start();

require_once __DIR__ . '/middleware/AuthMiddleware.php';
require_once __DIR__ . '/middleware/RoleMiddleware.php';
require_once __DIR__ . '/routes/AuthRoutes.php';

require_once __DIR__ . '/middleware/RequestValidationMiddleware.php';
require_once __DIR__ . '/middleware/ErrorHandlerMiddleware.php';
require_once __DIR__ . '/middleware/LoggingMiddleware.php';