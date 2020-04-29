<?php
$page =  $this->data['page'];
$limit =  $this->data['limit'];
$total_pages = $this->data['count'];
$stages = 1;
if ($page) {
    $start = ($page - 1) * $limit;
} else {
    $start = 0;
}
if ($page == 0) {
    $page = 1;
}
$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($total_pages / $limit);
$LastPagem1 = $lastpage - 1;
$paginate = '';
?>    
<?php if($lastpage > 1): ?>
    <ul id="paginationTasksID" class="pagination justify-content-center">
    <?php if ($page > 1): ?>
        <li class="page-item"><a class="page-link" href="#" onclick="paginationClick(event,<?php echo $prev;?>)">«</a></li>
    <?php else: ?>
        <li class='page-item disabled'><a class='page-link' href='#'>«</a></li>
    <?php endif; ?>
    <?php if($lastpage <= 5 + ($stages * 2)): ?>
        <?php for ($counter = 1; $counter <= $lastpage; $counter++): ?>
            <?php if ($counter == $page): ?>
                <li class='page-item active'><a class='page-link' href='#'><?php echo $counter; ?></a></li>
            <?php else: ?>
                <li class='page-item'><a class='page-link' href='#' onclick='paginationClick(event,<?php echo $counter; ?>)'><?php echo $counter; ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>
    <?php elseif ($lastpage > 5 + ($stages * 2)): ?>
        <?php if ($page <= 1 + ($stages * 2)): ?>
            <?php for ($counter = 1; $counter < 4 + ($stages * 2); $counter++): ?>
                <?php if ($counter == $page): ?>
                    <li class='page-item active'><a class='page-link' href='#'><?php echo $counter; ?></a></li>
                <?php else: ?>
                    <li class='page-item'><a class='page-link' href='#' onclick='paginationClick(event,<?php echo $counter; ?>)'><?php echo $counter; ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>
            <li class='page-item disabled'><a class='page-link' href='#'>...</a></li>
            <li class='page-item'><a class='page-link' href='#' onclick='paginationClick(event,<?php echo $LastPagem1; ?>)'><?php echo $LastPagem1; ?></a></li>
            <li class='page-item'><a class='page-link' href='#' onclick='paginationClick(event,<?php echo $lastpage; ?>)'><?php echo $lastpage; ?></a></li>
        <?php elseif ($lastpage - ($stages * 2) > $page && $page > ($stages * 2)): ?>
            <li class='page-item'><a class='page-link' href='#' onclick=' paginationClick(event,1)'>1</a></li>
            <li class='page-item'><a class='page-link' href='#' onclick=' paginationClick(event,2)'>2</a></li>
            <li class='page-item disabled'><a class='page-link' href='#'>...</a></li>
            <?php for ($counter = $page - $stages; $counter <= $page + $stages; $counter++): ?>
                <?php if ($counter == $page): ?>
                    <li class='page-item active'><a class='page-link' href='#'><?php echo $counter; ?></a></li>
                <?php else: ?>
                    <li class='page-item'><a class='page-link' href='#' onclick='paginationClick(event,<?php echo $counter; ?>)'><?php echo $counter; ?></a><li>
                <?php endif; ?>
            <?php endfor; ?>
            <li class='page-item disabled'><a class='page-link' href='#'>...</a></li>
            <li class='page-item'><a class='page-link' href='#' onclick='paginationClick(event,<?php echo $LastPagem1; ?>)'><?php echo $LastPagem1; ?></a></li>
            <li class='page-item'><a class='page-link' href='#' onclick='paginationClick(event,<?php echo $lastpage; ?>)'><?php echo $lastpage; ?></a></li>
        <?php else: ?>
            <li class='page-item'><a class='page-link' href='#' onclick=' paginationClick(event,1)'>1</a></li>
            <li class='page-item'><a class='page-link' href='#' onclick=' paginationClick(event,1)'>2</a></li>
            <li class='page-item disabled'><a class='page-link' href='#'>...</a></li>
            <?php for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++): ?>
                <?php if ($counter == $page): ?>
                    <li class='page-item active'><a class='page-link' href='#'><?php echo $counter; ?></a></li>
                <?php else: ?>
                    <li class='page-item'><a class='page-link' href='#' onclick=' paginationClick(event,<?php echo $counter; ?>)'><?php echo $counter; ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php if ($page < $counter - 1): ?>
        <li class='page-item'><a class='page-link' href='#' onclick='paginationClick(event,<?php echo $next; ?>)'>»</a></li>
    <?php else: ?>
        <li class='disabled'><a class='page-link' href='#'>»</a></li>
    <?php endif; ?>
    </ul>
<?php endif; ?>

