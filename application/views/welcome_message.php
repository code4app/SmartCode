<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to Smart Code</title>
        <script type="text/javascript" src="<?php echo site_url('web/js/jquery.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('web/js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('web/js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('web/js/smart_code.js'); ?>"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="<?php echo site_url('web/css/bootstrap-responsive.min.css'); ?>" rel="stylesheet" media="screen">
        <link href="<?php echo site_url('web/css/bootstrap.css'); ?>" rel="stylesheet" media="screen">
        <style>
            body {
                padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
            }
        </style>
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="#">Welcome to Smart Code beta 1.0</a>
                </div>
            </div>
        </div>
        <div class ="container">
            <ul class="nav nav-tabs" id = 'myTab'>
                <li class="active"><a href="#php" data-toggle="tab">php</a></li>
                <li><a href="#obj-c" data-toggle="tab">Objective-C</a></li>
            </ul>

            <div class ="tab-content">
                <div class="tab-pane active" id="php">
                    <h3>database</h3>
                    <select name="" id="php_select_database">
                        <?php foreach ($database_list as $item): ?>
                            <option value="<?php echo $item['Database']; ?>"><?php echo $item['Database']; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <p></p>
                    <h3>table</h3>
                    <select name="" id="php_select_table">
                    </select>
                    <p></p>
                    <a class="btn btn-success" id ="php_button">generate</a>
                </div>

                <div class="tab-pane" id="obj-c">
                    <select name="plan_id" id="selectPlanId2" onchange="evaluation_change()">  
                        <option value="2">健身</option>   
                        <option value="1">英语</option>
                        <option value="3">测试3</option>  
                    </select>
                    <div id ="evaluation_box">

                    </div>
                </div>

                <div class="tab-pane" id="chart">
                    <p><font style="color:rgb(220,220,220)">健身(分钟)</font></p>
                    <p><font style="color:rgb(151,187,205)">听写(分钟)</font></p>
                    <canvas id="canvas" height="450" width="2000"></canvas>
                </div>
            </div>
        </div>
    </body>
</html>