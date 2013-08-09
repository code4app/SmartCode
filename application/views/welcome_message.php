<!DOCTYPE html>
<html lang="en">
    <?php include 'header.php'; ?>
    <body>
        <?php include 'nav.php'; ?>
        <div class ="container">
            <ul class="nav nav-tabs" id = 'myTab'>
                <li class="active"><a href="#php" data-toggle="tab">php</a></li>
                <li><a href="#obj-c" data-toggle="tab">Objective-C</a></li>
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
                        <button type="submit" class="btn btn-success">generate</button>
                    </form>
                </div>

                <div class="tab-pane" id="obj-c">
                    <select name="plan_id" id="selectPlanId2">  
                        <option value="2">健身</option>   
                        <option value="1">英语</option>
                        <option value="3">测试3</option>  
                    </select>
                </div>
            </div>
        </div>
    </body>
</html>