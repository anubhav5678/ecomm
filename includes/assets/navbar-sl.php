<?php
function nav ($n)
{
    echo <<<DELIMETER
    <header class="summary-nav" id="nav-sl">
        <i class="fa-solid fa-arrow-left" id="back-btn"></i>
        <h3>{$n}</h3>
    </header>
    DELIMETER;
}
?>