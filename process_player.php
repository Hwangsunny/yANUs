<?php
require 'db_connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['player_id'])) {
    // 선수 ID로 게시판 데이터 가져오기
    $player_id = intval($_GET['player_id']); // 선수 ID를 안전하게 처리

    $stmt = $conn->prepare("SELECT id, title, author, created_at FROM player_analysis WHERE player_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['post_id'])) {
    $post_id = intval($_GET['post_id']); // 게시글 ID를 안전하게 처리

    $stmt = $conn->prepare("SELECT id, title, content, author, created_at FROM player_analysis WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode($row); // 게시글 데이터 반환
    } else {
        echo json_encode(["error" => "게시글을 찾을 수 없습니다."]);
    }

    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : null;

    if ($post_id) {
        $stmt = $conn->prepare("DELETE FROM player_analysis WHERE id = ?");
        $stmt->bind_param("i", $post_id);

        if ($stmt->execute()) {
            echo "success"; // 정확히 "success" 반환
        } else {
            echo json_encode(["error" => $stmt->error]);
        }

        $stmt->close();
        $conn->close();
        exit;
    }

    echo json_encode(["error" => "missing_post_id"]);
    exit;
}
// 유효하지 않은 요청 처리
echo json_encode(["error" => "Invalid request"]);
exit;
