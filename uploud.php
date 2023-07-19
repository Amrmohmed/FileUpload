<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploud</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <h1 class="col text-center bg-success p-2"> Uploud File Using by PHP</h1>


    <div class="container">
        <div class="row">
            <form class="col-ms-6" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">

                <div class="form-group">
                    <label> Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="form-group">
                    <hr>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <?php

            $error = '';
            $success = '';

            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $file = $_FILES['image'];

                $f_name = $file['name'];
                $f_type = $file['type'];
                $f_tmp_name = $file['tmp_name'];
                $f_error = $file['error'];
                $f_size = $file['size'];

                if ($f_name != '') {

                    $ext = pathinfo($f_name);

                    $orignal_name = $ext['filename'];
                    $orignal_ext = $ext['extension'];

                    $allowed = array("png", "jpg", "jpeg", "gif");
                    if (in_array($orignal_ext, $allowed)) {
                        if ($f_error === 0) {
                            if ($f_size < 50000) {

                                $new_name = uniqid('', true) . "." . $orignal_ext;
                                $destenition = 'image/' . $new_name;
                                move_uploaded_file($f_tmp_name, $destenition);
                                $success = 'Your File have be Uplouded';
                            } else {
                                $error = 'Your File is To Big';
                            }
                        } else {
                            $error = 'You Have an Error';
                        }
                    } else {
                        $error = 'Your File Not Allowed';
                    }
                } else {
                    $error = 'Please choose Image';
                }
            }




            ?>

            <?php if ($error != '') { ?>

                <h4 class="alert alert-danger col text-center"><?php echo $error; ?></h4>

            <?php } ?>

            <?php if ($success != '') { ?>

                <h4 class="alert alert-success col text-center"><?php echo $success; ?></h4>

            <?php } ?>
        </div>
    </div>

</body>

<script src="js/bootstrap.bundle.min.js"></script>

</html>