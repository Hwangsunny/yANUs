<!DOCTYPE HTML>
<html>
<head>
    <title>Cityzens</title>
    <meta charset="utf-8">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']); // 로그인 상태 확인
?>

    <!-- Header -->
    <header id="header" class="alt">
        <div class="logo">
        <a href="index.php">
    <img src="images/logo.png" alt="Cityzens Logo" style="width: 50px; height: auto;" />
</a>

        </div>
        <a href="#menu">Menu</a>
    </header>

    <!-- Nav -->
    <nav id="menu">
    <ul class="links">
        <li><a href="index.php">Home</a></li>
        <?php if ($isLoggedIn): ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="Login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>

    <!-- Banner -->
    <section id="banner">
        <div class="inner">
            <header>
                <h1>The Cityzens</h1>
                <?php if ($isLoggedIn): ?>
                <p>환영합니다</p>
                <?php else: ?>
                <p>커뮤니티</p>
            <?php endif; ?>
            </header>
            <a href="#main" class="button big scrolly">Learn More</a>
        </div>
    </section>

    <!-- Main -->
    <div id="main">


        <!-- Section -->
<section class="wrapper style1">
    <div class="inner">
        <header class="align-center">
            <h2>MANCITY</h2>
            <p>선수분석</p>
        </header>
        <div class="flex flex-3">
            <!-- 첫 번째 선수 -->
            <div class="col align-center">
            <div class="image round fit">
            <img src="images/pic03.jpg" alt="47.Phil Poden" width="320" height="320">
            </div>
            <p>47. Phil Poden</p>
            <?php if ($isLoggedIn): ?>
                <button class="button open-modal" data-player-id="1">Learn More</button>
            <?php else: ?>
                <button class="button" onclick="alert('로그인 후 이용 가능합니다.');">Learn More</button>
            <?php endif; ?>

        </div>
            <!-- 두 번째 선수 -->
            <div class="col align-center">
                <div class="image round fit">
                    <img src="images/pic05.jpg" alt="48.Player Two" width="320" height="320" id="openModal2">
                </div>
                <p>9. Elling Halland</p>
                <?php if ($isLoggedIn): ?>
                <button class="button open-modal" data-player-id="1">Learn More</button>
            <?php else: ?>
                <button class="button" onclick="alert('로그인 후 이용 가능합니다.');">Learn More</button>
            <?php endif; ?>
            </div>

            <!-- 세 번째 선수 -->
            <div class="col align-center">
                <div class="image round fit">
                    <img src="images/pic04.jpg" alt="49.Player Three" width="320" height="320" id="openModal3">
                </div>
                <p>16. Rodrigo</p>
                <?php if ($isLoggedIn): ?>
                <button class="button open-modal" data-player-id="1">Learn More</button>
            <?php else: ?>
                <button class="button" onclick="alert('로그인 후 이용 가능합니다.');">Learn More</button>
            <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- 모달 (첫 번째 선수) -->
<div id="playerModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        
        <!-- 상단 배너 -->
        <div class="player-header" style="background-color: #6aa9e6; color: white; text-align: center; padding: 20px;">
            <img src="images/pic03.jpg" alt="Phil Foden" class="player-image" style="width: 80px; height: 80px; border-radius: 50%;">
            <h2>Phil Foden</h2>
            <p id="support-index">응원지수: 0</p>
            <p>Manchester City</p>
        </div>

        <!-- 기본 정보 -->
        <div class="player-info">
            <div class="info-section">
                <h4>171cm</h4>
                <p>키</p>
            </div>
            <div class="info-section">
                <h4>47</h4>
                <p>셔츠</p>
            </div>
            <div class="info-section">
                <h4>24년</h4>
                <p>2000. 5. 28</p>
            </div>
            <div class="info-section">
                <h4>왼발</h4>
                <p>주로 사용하는 발</p>
            </div>
            <div class="info-section">
                <h4>🇬🇧 영국</h4>
                <p>국가</p>
            </div>
            <div class="info-section">
                <h4>€1.4억</h4>
                <p>시장 가치</p>
            </div>
        </div>

        <!-- 포지션 정보 -->
        <div class="player-position" style="text-align: center; margin-top: 20px;">
            <h4>포지션</h4>
            <div>
                <p><strong>기본:</strong> 중앙 공격형 미드필더</p>
                <p><strong>기타:</strong> 오른쪽 윙어, 왼쪽 윙어, 스트라이커</p>
            </div>
            <!-- 포지션 그림 -->
            <div class="position-diagram" style="display: flex; justify-content: center; gap: 10px; margin-top: 10px;">
                <div class="position" style="width: 40px; height: 40px; background-color: gray; color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%;">LW</div>
                <div class="position" style="width: 40px; height: 40px; background-color: #6aa9e6; color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%;">AM</div>
                <div class="position" style="width: 40px; height: 40px; background-color: gray; color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%;">RW</div>
            </div>
        </div>

        <!-- 게시판 -->
<div class="board" style="margin-top: 20px;">
    <table>
        <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>날짜</th>
            </tr>
        </thead>
        <tbody>
            <!-- 게시글 목록은 JS에서 동적으로 삽입 -->
        </tbody>
    </table>
</div>


<!-- 글 작성 폼 -->
<form class="board-form" style="margin-top: 20px;">
    <h3>평가</h3>
    
    <input type="text" placeholder="제목을 입력하세요" id="title" />
    <textarea placeholder="내용을 입력하세요" id="content"></textarea>

    <!-- 긍정적/부정적 선택 (드롭다운) -->
    <select id="rating" name="rating">
        <option value="">선택하세요</option>
        <option value="positive">긍정적</option>
        <option value="negative">부정적</option>
    </select>

    <button type="submit" class="button">게시하기</button>
</form>


<script>
// 초기 응원지수 값
let supportIndex = 0;

// 드롭다운에서 평가가 선택될 때마다 응원지수 업데이트
document.querySelector('.board-form').addEventListener('submit', function(event) {
    event.preventDefault();  // 폼 제출 기본 동작 막기

    const rating = document.getElementById('rating').value;  // 선택된 평가 가져오기
    
    if (rating === 'positive') {
        supportIndex += 1;  // 긍정적 선택 시 응원지수 증가
    } else if (rating === 'negative') {
        supportIndex -= 1;  // 부정적 선택 시 응원지수 감소
    }

    // 응원지수 표시
    document.getElementById('support-index').textContent = '응원지수: ' + supportIndex;
});

</script>




<!-- 본문 표시 모달 -->
<div id="contentModal" class="modal">
    <div class="modal-content">
        <span class="close-content-modal">&times;</span>
        <h2 class="modal-title">제목</h2>
        <p class="modal-body">본문 내용</p>
        

        <button id="deletePost" class="button">게시글 삭제</button>
    </div>
</div>



<!-- 추가 모달은 필요에 따라 두 번째, 세 번째 선수에 대해 동일한 형식으로 작성 -->

   

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/jquery.scrollex.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/modal.js"></script>
</body>

</html>