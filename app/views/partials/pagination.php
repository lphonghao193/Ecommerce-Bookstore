<?php 
function changePageNumber($pageNumber) {
    $params = $_GET;
    $params['pgn'] = $pageNumber;
    return '?' . http_build_query($params);
}

function renderPageBtn($i, $currentPage) {
  $link = changePageNumber($i);
  if ($i == $currentPage) {
      return '<button class="pgn-btn active">' . $i . '</button>';
  } else {
      return '<button class="pgn-btn" onclick="window.location.href=\'' . $link . '\'">' . $i . '</button>';
  }
}

function renderPagination($total_pages) {

    $page = isset($_GET['pgn']) ? (int)$_GET['pgn'] : 1;
    $page = max(1, min($page, $total_pages));

    echo '<div class="pagination">';

    // Back Button
    if ($page > 1) {
        echo '<button class="pgn-btn" onclick="window.location.href=\'' . changePageNumber($page - 1) . '\'">&lt; Back</button>';
    } else {
        echo '<button class="pgn-btn disabled" disabled>&lt; Back</button>';
    }

    // Page Numbers
    if ($total_pages <= 10) {
        for ($i = 1; $i <= $total_pages; $i++) {
            echo renderPageBtn($i, $page);
        }
    } else {
        echo renderPageBtn(1, $page);

        if ($page > 4) {
            echo '<button class="pgn-btn dots" disabled>...</button>';
        }

        for ($i = max(2, $page - 2); $i <= min($total_pages - 1, $page + 2); $i++) {
            echo renderPageBtn($i, $page);
        }

        if ($page < $total_pages - 3) {
            echo '<button class="pgn-btn dots" disabled>...</button>';
        }

        echo renderPageBtn($total_pages, $page);
    }

    // Next Button
    if ($page < $total_pages) {
        echo '<button class="pgn-btn" onclick="window.location.href=\'' . changePageNumber($page + 1) . '\'">Next &gt;</button>';
    } else {
        echo '<button class="pgn-btn disabled" disabled>Next &gt;</button>';
    }

    echo '</div>';
}
?>