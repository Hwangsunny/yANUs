<?php
// 데이터베이스 연결 파일 포함
require_once 'db_connection.php';

// 폼 데이터 받기
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// 비밀번호 확인
if ($password !== $confirm_password) {
    echo "<script>alert('Passwords do not match!'); window.location.href='register.php';</script>";
    exit();
}

// 비밀번호 해싱
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// 데이터베이스에 사용자 저장
$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param('ss', $username, $hashed_password);
    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='Login.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='register.php';</script>";
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

// 연결 종료
$conn->close();
?>
