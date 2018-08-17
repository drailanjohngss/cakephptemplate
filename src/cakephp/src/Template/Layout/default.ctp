<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html lang="en">
    <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CAKEPHP</title>

    <!-- Bootstrap core CSS -->
    <?= $this->Html->css('/landing/vendor/bootstrap/css/bootstrap.min.css'); ?>
    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <?= $this->Html->css('/landing/css/one-page-wonder.min.css'); ?>
    <?= $this->Html->css('style.css'); ?>
    </head>

    <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">CAKEPHP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php if(empty($getUser)) : ?>
                        <?= $this->Html->link('Sign Up', '/users/add', ['class' => 'nav-link']) ?>
                        <?php else : ?>
                        <?= $this->Html->link($getUser['username'], '/', ['class' => 'nav-link']) ?>
                    <?php endif ?>
                </li>
                <li class="nav-item">
                    <?php if(empty($getUser)) : ?>
                        <?= $this->Html->link('Sign in', '/users/login', ['class' => 'nav-link']) ?>
                        <?php else : ?>
                        <?= $this->Html->link('Logout', '/users/logout', ['class' => 'nav-link']) ?>
                    <?php endif ?>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    <?= $this->fetch('content') ?>

    <!-- Footer -->
    <footer class="py-5 bg-black">
        <div class="container">
            <p class="m-0 text-center text-white small">Copyright &copy; Your Website 2018</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <?= $this->Html->script('/landing/vendor/jquery/jquery.min.js') ?>
    <?= $this->Html->script('/landing/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>

    </body>

</html>
