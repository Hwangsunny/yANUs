<?php
$host = 'localhost'; // XAMPP 기본 호스트
$dbname = 'user_database'; // 데이터베이스 이름
$username = 'root'; // 기본 사용자 이름
$password = ''; // 기본 비밀번호 없음

$conn = new mysqli($host, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}
?>