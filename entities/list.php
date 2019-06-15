<?php
require_once __DIR__ . "/../lib/common.php";
?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Thumbnail</th>
      <th scope="col">Publish Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
<?php
$result = getListEntity();
if ($result !== false) {
    foreach ($result as $var) {
        echo "<tr>
                  <th scope=\"row\">{$var['name']}</th>
                  <td><img src=\"{$var['thumbnail']}\" width=\"auto\" height=\"40\"></td>
                  <td>" . getStatusHtml($var['publishToCdn']) . "</td>
                  <td><a href=\"?page=uiza-entities&id={$var['id']}\">View</a></td>
              </tr>";
    }
} else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Wrong Authorization or Api Domain!</strong> You should check Uiza setting.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>
  </tbody>
</table>
