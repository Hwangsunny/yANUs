// 모든 모달 열기 버튼에 이벤트 추가
document.querySelectorAll(".open-modal").forEach(button => {
    button.addEventListener("click", function () {
        const playerId = this.dataset.playerId; // 버튼의 data-player-id 값
        const modal = document.getElementById("playerModal");
        
        // 모달 열기
        modal.style.display = "block";

        // 현재 playerId를 폼에 저장 (글 저장 시 사용)
        document.querySelector(".board-form").dataset.playerId = playerId;

        // 데이터 로드
        loadBoard(playerId); // playerId를 전달하여 해당 선수의 게시판 데이터 로드
    });
});

// 모달 닫기
document.querySelector(".close").addEventListener("click", function () {
    document.getElementById("playerModal").style.display = "none";
});

// 모달 외부 클릭 시 닫기
window.onclick = function (event) {
    const modal = document.getElementById("playerModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

function loadBoard(playerId) {
    fetch(`process_player.php?player_id=${playerId}`)
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector(".board table tbody");
            tableBody.innerHTML = ""; // 기존 내용 초기화

            data.forEach((row, index) => {
                const newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td>${index + 1}</td>
                    <td><a href="#" class="view-content" data-id="${row.id}">${row.title}</a></td>
                    <td>${row.author}</td>
                    <td>${new Date(row.created_at).toLocaleDateString()}</td>
                `;
                tableBody.appendChild(newRow);
            });

            // 제목 클릭 이벤트 추가
            addContentClickEvent();
        })
        .catch(error => {
            console.error("데이터 로드 중 오류:", error);
            alert("게시판 데이터를 불러오는 데 실패했습니다.");
        });
}


// 새 글 저장
document.querySelector(".board-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const playerId = this.dataset.playerId; // 폼에 저장된 playerId
    const title = document.querySelector("#title").value.trim(); // 제목
    const content = document.querySelector("#content").value.trim(); // 내용

    if (title && content) {
        fetch("save_analysis.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `player_id=${playerId}&title=${encodeURIComponent(title)}&content=${encodeURIComponent(content)}`
        })
            .then(response => response.text())
            .then(data => {
                if (data === "success") {
                    loadBoard(playerId); // 새 글 저장 후 게시판 갱신
                    document.querySelector("#title").value = ""; // 제목 입력창 초기화
                    document.querySelector("#content").value = ""; // 내용 입력창 초기화
                } else {
                    alert("글 저장 중 오류가 발생했습니다.");
                }
            })
            .catch(error => {
                console.error("글 저장 중 오류:", error);
                alert("글 저장 중 문제가 발생했습니다. 다시 시도해주세요.");
            });
    } else {
        alert("제목과 내용을 입력하세요.");
    }
});

// 제목 클릭 이벤트 처리
function addContentClickEvent() {
    document.querySelectorAll(".board table tbody tr td a").forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault(); // 기본 동작 방지

            const postId = this.dataset.id; // 게시글 ID 가져오기
            fetch(`process_player.php?post_id=${postId}`) // 서버 요청
                .then(response => response.json())
                .then(data => {
                    // 본문 내용 표시
                    displayContent(data);
                })
                .catch(error => {
                    console.error("본문 로드 중 오류:", error);
                    alert("본문을 불러오는 데 실패했습니다.");
                });
        });
    });
}

function displayContent(data) {
    console.log("서버 응답 데이터:", data); // 디버깅용

    const contentModal = document.getElementById("contentModal");
    if (!contentModal) {
        console.error("contentModal 요소를 찾을 수 없습니다.");
        return;
    }

    const titleElement = contentModal.querySelector(".modal-title");
    const bodyElement = contentModal.querySelector(".modal-body");
    const deleteButton = document.getElementById("deletePost");

    if (titleElement && bodyElement) {
        titleElement.innerText = data.title || "제목 없음"; // 제목 설정
        bodyElement.innerText = data.content || "내용 없음"; // 본문 설정
        contentModal.style.display = "block"; // 모달 열기

        // 삭제 버튼에 올바른 게시글 ID 저장
        if (data.id) {
            deleteButton.dataset.postId = data.id; // 데이터 설정
            deleteButton.onclick = function () {
                deletePost(data.id);
            };
        } else {
            console.error("게시글 ID가 없습니다."); // 로그 출력
        }
    } else {
        console.error("모달 내부 요소(.modal-title 또는 .modal-body)를 찾을 수 없습니다.");
    }
}


function deletePost(postId) {
    console.log("삭제 요청 ID:", postId); // ID 값 확인

    if (!postId) {
        alert("삭제할 게시글 ID가 없습니다.");
        return;
    }

    if (confirm("이 게시글을 삭제하시겠습니까?")) {
        fetch(`process_player.php?post_id=${postId}`, {
            method: "DELETE"
        })
        .then(response => response.text())
        .then(data => {
            if (data === "success") {
                alert("게시글이 삭제되었습니다.");
                document.getElementById("contentModal").style.display = "none"; // 모달 닫기
                const playerId = document.querySelector(".board-form").dataset.playerId; // 현재 선수 ID
                loadBoard(playerId); // 게시판 갱신
            } else {
                alert("게시글 삭제 중 오류가 발생했습니다.");
            }
        })
        .catch(error => {
            console.error("게시글 삭제 중 오류:", error);
            alert("게시글 삭제에 실패했습니다.");
        });
    }
}


// 본문 모달 닫기
document.querySelector(".close-content-modal").addEventListener("click", function () {
    document.getElementById("contentModal").style.display = "none";
});

