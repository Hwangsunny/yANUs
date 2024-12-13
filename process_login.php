<?php
// 데이터베이스 연결 파일 포함
require 'db_connection.php';

// 폼에서 받은 데이터 가져오기
$username = $_POST['username'];
$password = $_POST['password'];

// SQL 쿼리 준비
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // 사용자 존재 확인
    $user = $result->fetch_assoc();
    // 비밀번호 검증
    if (password_verify($password, $user['password'])) {
        // 세션 시작 및 로그인 처리
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        echo "<script>alert('로그인 성공!'); window.location.href='index.php';</script>";
    } else {
        // 비밀번호 불일치
        echo "<script>alert('잘못된 비밀번호입니다.'); window.location.href='Login.php';</script>";
    }
} else {
    // 사용자 이름 없음
    echo "<script>alert('사용자가 존재하지 않습니다.'); window.location.href='Login.php';</script>";
}

$stmt->close();
$conn->close();
?>
