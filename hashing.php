<?php
$password = "goat";

?>
<html>
<body>
<p>Here</p>
<p>
<?php
echo password_hash($password, PASSWORD_DEFAULT);

echo "\n----------";
$password_enc = password_hash("goat", PASSWORD_DEFAULT);
echo "encode: ";
echo $password_enc;

echo password_verify('fg', $password_enc); // TRUE
echo "\n----------";
echo password_verify('fish', $password_enc); // FALSE
?>
</p>
</body>
</html>