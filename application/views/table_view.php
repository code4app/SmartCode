<!DOCTYPE html>
<html lang="en">
    <?php include 'header.php'; ?>
    <body>
        <?php include 'nav.php'; ?>
        <div class ="container">
            <div>
                <textarea id="p_table_view_content" class="span12" rows="40">
                    <?php
                    include 'generate_php.php';
                    gen_gets($data);
                    ?>
                </textarea>
            </div>

            <div><button id ="btn_table_view_content" type="button" class="btn btn-default">Copy to Clip board</button></div>
        </div>
    </body>
</html>