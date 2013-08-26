<!DOCTYPE html>
<html lang="en">
    <?php include 'header.php'; ?>
    <body>
        <?php include 'nav.php'; ?>
        <div class ="container">
            <ul class="nav nav-tabs" id = 'myTab'>
                <li class="active"><a href="#php" data-toggle="tab">PHP数据库自动生成参数类</a></li>
                <li><a href="#php_param" data-toggle="tab">PHP 函数参数</a></li>
            </ul>

            <div class ="tab-content">
                <div class="tab-pane active" id="php">
                    <form action="api/table" method ="GET">
                        <div class="form-group">
                            <label class="control-label">database</label>
                            <select name="database_name" id="php_select_database" class="form-control">
                                <?php foreach ($database_list as $item): ?>
                                    <option value="<?php echo $item['Database']; ?>"><?php echo $item['Database']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">table</label>
                            <select name="database_table" id="php_select_table" class="form-control"></select>
                        </div>
                        <div><button type="submit" class="btn btn-success">generate</button></div>
                    </form>
                </div>

                <div class="tab-pane" id="php_param">
                    <form action="api/table/param" method ="POST">
                        <div class="form-group">
                            <select name="php_param_method" id="php_param_select" class="form-control">
                                <option value="get">GET</option>
                                <option value="post">POST</option>
                            </select>
                            <label class="control-label">输入参数，分号分割</label>
                            <textarea class="span12" name="params"></textarea>
                        </div>
                        <div><button class="btn btn-success">generate</button></div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>