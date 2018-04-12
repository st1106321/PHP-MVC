<!-- kind of home page displaying table and values -->

<?php $title = 'Home'; ?>
<?php ob_start(); ?>

<h1>Food energy</h1>
<p>For every 100g of an aliment you can get:</p>
<div class="text-right">
    <a class="btn btn-outline-primary" href="index.php?action=accessFoodForm">Add</a>
</div><span></span>
<div class="table-responsive">
    <table class="table table-hover">
    <?php
        
        function sortItems($opt, $way) {
            $ret = 'desc';
            if (isset($_GET['opt']) && isset($_GET['way']) &&
                $_GET['opt'] == $opt && $_GET['way'] == $way) {
                $ret = ($way == 'asc') ? 'desc' : 'asc';
            }
            return $ret;
        }

        /* show full star if in favourites empty one if not */
        function is_fav($favs, $itemId) {
            for ($i = 0, $len = sizeof($favs); $i < $len; $i++) {
                if ($itemId == $favs[$i]) {
                    return 1;
                }
            }
            return 0;
        }

        echo "<thead class=\"thead-light\"> <tr>";
        foreach ( $data as $key => $value ) {
            if ($key == "id") continue;
            /* enables the sorting process */
            echo "<th><a href=\"index.php?action=sortByOption&amp;opt={$key}&amp;way=".sortItems($key ,'desc')."\">".ucfirst($key).
                    "<a hidden href=\"index.php?action=accessFoodForm\">&#x2605;</a>
                </a></th>";
        }
        echo "  <th>Fav</th>
                <th>Actions</th>";
        echo "  </tr> </thead><tbody>";
        /* loop through every row */
        do {
            foreach ( $data as $key => $value ) {
                if ($key == "id") continue;
                if ($key == "name") $value = "<b>".ucfirst($value)."</b>";
                echo "<td>{$value}</td>";
            }
            /* add favorite and actions controllers */
            $fav = is_fav($favs, $data['id']);
            echo "<td><a href=\"index.php?action=editFav&amp;favId={$data['id']}&amp;isFav={$fav}\">"
                    . ( ($fav) ? "&#x2605;" : "&#x2606;" ) ."</a></td>
                    <td><a class=\"btn btn-outline-info\" href=\"index.php?action=accessFoodForm&amp;id={$data['id']}\">Edit</a>
                    <a class=\"btn btn-outline-danger\" href=\"index.php?action=deleteFoodById&amp;foodId={$data['id']}\">Delete</a></td>
                </tr>";
        
        } while ($data = $food->fetch_assoc());
        $food->close();
        echo "</tbody> </table>"
    ?>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>