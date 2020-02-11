<!DOCTYPE html>
<!--
Licensed under the Apache License, Version 2.0 (the "License"),
see LICENSE for more details: http://www.apache.org/licenses/LICENSE-2.0.
-->
<html>
    <head>
        <title><{block name="title"}>Default Title<{/block}></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="/static/css/bootstrap.css" />
        <{block name="head"}><{/block}>
    </head>
    <body>
        <header id="header" class="navbar navbar-expand navbar-fixed-top navbar-dark flex-column flex-md-row bd-navbar">
            <{block name="header"}><{/block}>
        </header>
        <section id="content" class="container-fluid">
            <div class="row flex-xl-nowrap">
                <div id="nav" class="col-md-3 col-xl-2 bd-sidebar">
                    <{block name="nav"}><{/block}>
                </div>
                <main class='col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content'role='main'>
                    <div id="content" class="min-vh-100">
                        <{block name="body"}><{/block}>
                    </div>
                    <footer id="footer" class="col-md-12">
                        <{block name="footer"}><{/block}>
                    </footer>
                </main>
            </div>
        </section>
    </body>
    <script type="text/javascript" src="/static/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/bootstrap/site/docs/4.4/assets/js/docs.min.js"></script>
    <script type="text/javascript" src="/static/js/bootstrap.js"></script>
</html>
