<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Registration</title>
   
</head>
<body>

<?= form_open('login/register')?>
    <?= validation_errors('<p style="color:red">', ''); ?>
    <label>Username:
        <?= form_input('username')?>
    </label><br>
    <label>Email:
        <?= form_input('email')?>
    </label><br>
    <label>Password:
        <?= form_password('password')?>
    </label><br>
    <label>Confirm Password:
        <?= form_password('password_conf')?>
    </label><br>

    <input type="submit" value="Continue &rarr;">
</form>
Page rendered in {elapsed_time} seconds

</body>
</html>
