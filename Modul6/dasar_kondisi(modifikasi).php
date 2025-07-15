<!DOCTYPE html> 
<html>   
<head>      
    <title>Latihan Kondisi PHP</title> 
</head> 
<body> 
    <h1>Cek Nilai</h1> 
    <?php 
    $nilai = 95; 
    echo "<p>Nilai Anda: $nilai</p>"; 

    if ($nilai > 90) {
        echo "<p style='color:blue;'>Kategori: Sangat Baik</p>";
        echo "<p style='color:green;'>Selamat, Anda Lulus!</p>"; 
    } elseif ($nilai > 80) {
        echo "<p style='color:darkgreen;'>Kategori: Baik</p>";
        echo "<p style='color:green;'>Selamat, Anda Lulus!</p>"; 
    } elseif ($nilai > 70) {
        echo "<p style='color:orange;'>Kategori: Cukup</p>";
        echo "<p style='color:green;'>Selamat, Anda Lulus!</p>"; 
    } else {
        echo "<p style='color:red;'>Maaf, Anda Belum Lulus</p>";
    }
    ?> 
</body> 
</html>
