<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="/assets/css/newsfeed.css">
<?php
session_start();
require_once "Connector.php";
require_once "assets/js/newsfeed.js";

if (!isset($_SESSION['id']) && !$_SESSION['id']) {
    header("Location: login.php");
}

$query_db = new Connector;

$id = $_GET['id'];
if ($id) {
    $result = $query_db->db_query("DELETE FROM news WHERE id =" . $id);
    echo '<script type="text/javascript">this.location.href ="newsfeed.php"</script>';
}

$result = $query_db->db_query("SELECT * FROM news where is_active ='Y'");
$result = mysqli_fetch_all($result);
$count_results = count($result);
function editNews()
{
    $query_db = new Connector;
    if (isset($_POST['edit_submit'])) {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $id = $_POST["rId"];
        $query_db->db_query('UPDATE news SET name ="' . $title . '", description="' . $description . '" WHERE id="' . $id . '"');
        header("Location: newsfeed.php");
    }
}

function getCreatorName($creatorId)
{
    $query_db = new Connector;
    $result = $query_db->db_query('SELECT first_name FROM users where id=' . $creatorId . '');
    $result = mysqli_fetch_row($result);
    return $result[0];
}
function addNews()
{
    $query_db = new Connector;
    if (isset($_POST["add"])) {
        $title = $_POST["title"] ? $_POST["title"] : "No title";
        $description = $_POST["description"];
        $query_db->db_query('INSERT INTO news(name, description, is_active, author_id) VALUES("' . $title . '","' . $description . '","Y",' . $_SESSION['id'] . ')');
        header("Location: newsfeed.php");
    }
}
function logout()
{
    if (isset($_POST["logout"])) {
        session_destroy();
        header("Location: newsfeed.php");
    }
}
?>

<div class="container main-container">
    <form method="POST" id="logout-form" action=<?php logout() ?>>
        <button type="submit" class="btn btn-primary" name="logout">Logout</button>
    </form>
    <h2>News</h2>

    <button class="btn btn-primary" id="add-up" onclick="add()">Add news +</button>
    <form id="add-form" method="POST" action=<?php addNews($conn) ?>>
        <label for='title'>Title</label><input name="title" type="text" class="form-control title-add" placeholder="Title">
        <label for='description'>Description</label><input name="description" class="form-control description-add" type="description" placeholder="Description">
        <button type="submit" name="add" class="btn btn-primary add-bottom-btn">Add news</button>
        <button class="btn btn-danger add-bottom-btn" onclick="addHide()">X</button>
    </form>
    <?php for ($i = (int)$count_results - 1; $i >= 0; $i--) : ?>
        <div class="news">
            <div class="created-by">created_by <?php echo getCreatorName($result[$i][6]) ?></div>
            <div class="title"><?php echo $result[$i][1]; ?></div>
            <div class="description"><?php echo $result[$i][2]; ?></div>
            <?php if ($result[$i][4] == $result[$i][5]) : ?>
                <div class="created">created_at <?php echo $result[$i][4]; ?></div>
            <?php else : ?>
                <div class="updated">last_updated_at <?php echo $result[$i][5]; ?></div>
            <?php endif; ?>
            <button class="btn btn-primary" onclick="check(<?php echo $result[$i][0] ?>)">Delete</button>
            <button class="btn btn-primary" onclick="edit(<?php echo $result[$i][0] ?>)">Edit</button>
            <div class="edit" id="edit-container-<?php echo $result[$i][0] ?>">
                <form id="edit-form" method="POST" action=<?php editNews() ?>>
                    <input type="hidden" value=<?php echo $result[$i][0]; ?> name="rId">
                    <input type="text" class="form-control" id="edit-title" name="title" value="<?php echo $result[$i][1]; ?>">
                    <input type="text" class="form-control" id="edit-description" name="description" value="<?php echo $result[$i][2]; ?>">
                    <input type="submit" class="btn btn-primary" name="edit_submit">
                    <button type="button" class="edit-hide-<?php echo $result[$i][0] ?> btn btn-danger" onclick="editHide(<?php echo $result[$i][0] ?>)">X</button>
                </form>
            </div>
        </div>
    <?php endfor; ?>

</div>