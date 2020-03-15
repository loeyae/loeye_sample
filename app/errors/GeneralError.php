<?php
/**
 * GeneralError.php
 *
 * @author  Zhang Yi <loeyae@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License
 * @version GIT: $id $
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>出错了</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="/css/bootstrap.css" />
    </head>
    <body>
        <header id="header" class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar">
            <a class="navbar-brand mr-0 mr-md-2" href="/"></a>
            <div class=""></div>
        </header>
        <div class="container-fluid min-vh-100">
            <nav id="nav" class="nav clearfix col-12 text-center row-cols-1 my-2">
                <a href="/" class="float-left col-auto">首页</a><?php if (!empty($_SERVER['HTTP_REFERER'])) { ?><a href="<?= $_SERVER['HTTP_REFERER']; ?>" class="float-right col-auto">返回前页</a><?php } ?>
            </nav>
            <section id="content" class="text-center mh-100">
                    <?php
                    $appConfig = $context->getAppConfig();
                    $debug = $appConfig ? $appConfig->getSetting('debug', false) : false;
                    if ($debug) {
                        ?>
                <p class="text-danger text-left ml-lg-5">
                <?php
                        print_r(nl2br($e->getMessage()));
                        echo '<br /><br />';
                        print_r(nl2br($e->getTraceAsString()));
                    } else {
                        ?>
                <p class="text-danger">
                <?php
                        if ($e instanceof \loeye\error\ResourceException) {
                            $message = '找不到了';
                        } else {
                            $message = '出错了，请稍候再试～';
                        }
                        echo $message;
                    }
                    ?>
                </p>
            </section>
        </div>
        <footer id="footer" class="text-black-50 col-12 text-center mt-1 mb-4">
            <div id="copyright"><span>©<?= date('Y'); ?>&nbsp;</span><span>Loeyae.com&nbsp;</span><span>ICP证：蜀ICP备14020223号-1</span></div>
        </footer>
        <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
