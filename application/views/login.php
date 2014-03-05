<html>
<head>
    <title>Login with Facebook</title>
</head>
<body>
    <?php if (@$user_profile): ?>
        <pre>
            <?php echo print_r($user_profile, TRUE) ?>
        </pre>
        <a href="<?= $logout_url ?>">Logout</a>
    <?php else: ?>
        <a href="<?= $login_url ?>">Login</a>
    <?php endif; ?>

</body>

</html>