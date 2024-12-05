<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="number">Nhập số</label>
        <input type="number"  name="number" required>
        <button type="submit">gửi</button>
    </form>

    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $number = $_POST['number'];
        
        if(!is_numeric($number) || $number < 0) {
            echo "<p style='color:red;'>Vui lòng nhập một số nguyên dương!</p>";
        } else {
            $sum=0;
            for($i=1; $i<=$number; $i++) {
                $sum += $i;
            }
            echo "Tong cua $number la: $sum";
        }
    }
    ?>
</body>
</html>