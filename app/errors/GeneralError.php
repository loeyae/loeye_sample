<?php
/**
 * GeneralError.php
 *
 * @author  Zhang Yi <loeyae@gmail.com>
 * @version SVN: $Id: Zhang Yi $
 */
?>
<!DOCTYPE html>
<!--
Licensed under the Apache License, Version 2.0 (the "License"),
see LICENSE for more details: http://www.apache.org/licenses/LICENSE-2.0.
-->
<html>
    <head>
        <title>出错了</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="/static/css/bootstrap.css" />
    </head>
    <body>
        <header id="header" class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar">
            <a class="navbar-brand mr-0 mr-md-2" href="/"><img class="logo" src="/static/images/favicon.png"></a>
            <div class=""></div>
        </header>
        <div class="container-fluid">
            <nav id="nav" class="nav col-12 text-center row-cols-1 my-2">
                <a href="/" class="float-lg-left">首页</a><?php if (!empty($_SERVER['HTTP_REFERER'])) { ?>返回<a href="<?= $_SERVER['HTTP_REFERER']; ?>" class="float-lg-right">前页</a><?php } ?>
            </nav>
            <section id="content" class="min-vh-100 text-center">
                <p class="text-danger">
                <?php
                if ($exc instanceof \loeye\error\ResourceException) {
                    $message = '找不到了';
                } else {
                    $message = '内部错误';
                }
                echo $message;
                ?>
                </p>
            </section>
        </div>
        <footer id="footer" class="footer col-12 text-center">
            <div id="copyright"><span>©2020&nbsp;</span><span>Loeyae.com&nbsp;</span><span>ICP证：蜀ICP备14020223号-1</span></div>
        </footer>
        <script type="text/javascript" src="/static/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
